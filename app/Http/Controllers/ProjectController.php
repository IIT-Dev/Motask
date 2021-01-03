<?php

namespace App\Http\Controllers;

use Validator;
use Auth;
use DateTime;
use App\Project;
use App\User;
use App\Applicant;
use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Gmail;
use Google_Service_Gmail_Message;
use PHPMailer\PHPMailer\PHPMailer;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getById(Request $request, $id)
    {
        $project = Project::find($id);
        if ($project == null) {
            abort(404);
        }

        $manpro = User::find($project->manpro_id);
        $creator = User::where('email', $project->created_by)->first();

        $requester_id = Auth::user()->id;
        $requester = User::find($requester_id);
        if ($requester == null) {
            abort(404);
        }

        //If the requester is an admin or the project's Project Manager (manpro), show applicants
        $applicants = array();
        if ($requester->role == 'admin' || $requester->id == $project->manpro_id) {
            $applicants = Applicant::where('project_id', $project->id)->get();
            if ($applicants->isEmpty()) {
                $applicants = 'None';
            } else {
                foreach ($applicants as &$ap) {
                    $ap->applicant_name = User::find($ap->applicant_id)->name;
                }
            }
        }

        return view('project.index', [
            'requester_id' => $requester_id,
            'project' => $project,
            'manpro' => $manpro,
            'creator' => $creator,
            'applicants' => $applicants,
        ]);
    }

    public function showCreateForm()
    {
        //authorize user based on role
        $this->authorize('create', Project::class);

        return view('project.create', [
            'action' => 'create',
        ]);
    }

    public function create(Request $request)
    {
        //authorize user based on role
        $this->authorize('create', Project::class);

        //validate input
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:300',
            'category' => 'required',
            'deadline' => 'required',
            'number_of_programmers' => 'required',
            'budget' => 'numeric',
            'specification_desc' => 'required|max:300',
            'notes' => 'max:300',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $project = new Project();
        $project->title = $request->title;
        $project->category = $request->category;
        $project->deadline = $request->deadline;
        $project->total_programmer = $request->number_of_programmers;
        if ($request->budget != null) {
            $project->budget = $request->budget;
        }
        $project->project_owner = $request->project_owner;
        $project->status = 'Open';
        $project->specification_desc = $request->specification_desc;
        $project->notes = $request->notes;
        $project->created_by = Auth::user()->email;
        $project->save();

        return redirect('/home');
    }

    public function showEditForm(Request $request)
    {
        $project = Project::find($request->query('id'));
        $this->authorize('update', $project);

        $deadline = new DateTime($project->deadline);
        $project->deadline = $deadline->format('Y-m-d');

        return view('project.edit', [
            'action' => 'edit',
            'project' => $project,
        ]);
    }

    public function edit(Request $request)
    {
        //validate input
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:300',
            'category' => 'required',
            'deadline' => 'required',
            'number_of_programmers' => 'required',
            'budget' => 'numeric',
            'specification_desc' => 'required|max:300',
            'notes' => 'max:300',
            'programmers' => 'max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $project = Project::find($request->id);
        $this->authorize('update', $project);

        $project->title = $request->title;
        $project->category = $request->category;
        $project->deadline = $request->deadline;
        $project->total_programmer = $request->number_of_programmers;
        if ($request->budget != null) {
            $project->budget = $request->budget;
        } else {
            $project->budget = null;
        }
        $project->project_owner = $request->project_owner;
        $project->specification_desc = $request->specification_desc;
        $project->programmers = $request->programmers;
        $project->notes = $request->notes;
        $project->created_by = Auth::user()->email;
        $project->save();

        return redirect('/project/' . $project->id);
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        $project = Project::find($id);
        $this->authorize('delete', $project);

        //delete by id
        $project->delete();

        return response('OK', 200);
    }

    public function manageStatus(Request $request)
    {
        $project = Project::find($request->input('project_id'));
        if ($project == null) {
            return response()->json([
                'status' => 'error',
                'message' => 'Project not found',
            ], 200);
        }
        $this->authorize('update', $project);
        $project->status = $request->input('status');
        $project->save();
        $status = 'unknown.';
        if ($project->status == 'Open') {
            $status = 'Open.';
        } elseif ($project->status == 'In Progress') {
            $status = 'In Progress.';
        } elseif ($project->status == 'Done') {
            $status = 'Done.';
        } elseif ($project->status == 'Canceled') {
            $status = 'Canceled.';
        }

        return response()->json([
            'status' => 'success',
            'message' => $project->title . ' status changed to ' . $status,
        ], 200);
    }

    public function showApplyForm(Request $request)
    {
        // if the user does not have `Line ID`, redirect to profile
        if (Auth::user()->line == '-') {
            return redirect('/user/' . Auth::user()->id)->with('redirect', true);
        }
        $project = Project::find($request->input('project_id'));

        return view('project.apply')->with('project_id', $project);
    }

    public function apply(Request $request)
    {
        //validate input
        $validator = Validator::make($request->all(), [
            'motive' => 'required|max:1024',
            'questions' => 'required|max:1024',
        ]);

        if ($validator->fails()) {
            return redirect('project.apply')
                ->withInput()
                ->withErrors($validator);
        }

        $applicant = new applicant();
        $project = Project::find($request->id);
        $applicant->project_id = $project->id;
        $applicant->applicant_id = Auth::user()->id;
        $applicant->motive = $request->motive;
        $applicant->questions = $request->questions;

        $this->notifyProjectManager($project, $applicant);

        $applicant->save();

        return redirect('/home');
    }

    public function createNotifyMessage(Project $project, Applicant $applicant)
    {
        $email_subject = '[Motask] Ada Pendaftar Baru di Proyek Kamu!';
        $email_body_template =
            'Halo $nama_manpro. Ada pendaftar baru nih di proyek kamu.

Berikut detailnya:
Judul proyek: $project_title
Nama pendaftar: $applicant_name
Motivasi:
$motive
Pertanyaan:
$questions
Detail pendaftar: $url_profil_pendaftar
Detail proyek: $url_proyek

Jangan lupa diproses ya! Semangat!';

        $project_manager = User::where('email', $project->created_by)->first();
        $applicant_user = User::where('id', $applicant->applicant_id)->first();
        $data = array(
            '$project_title' => $project->title,
            '$nama_manpro' => $project_manager->name,
            '$url_profil_pendaftar' =>  url('/user/' . $applicant->applicant_id),
            '$url_proyek' =>  url('/project/' . $project->id),
            '$applicant_name' => $applicant_user->name,
            '$motive' => $applicant->motive,
            '$questions' => $applicant->questions
        );
        $body = strtr($email_body_template, $data);

        $mail = new PHPMailer();
        $mail->CharSet = "UTF-8";
        $mail->Encoding = "base64";
        $mail->setFrom("inkubatorit.hmif.itb@gmail.com", "Motask");
        $mail->addAddress($project_manager->email);
        $mail->Subject = $email_subject;
        $mail->Body = $body;
        $mail->preSend();

        $mime = $mail->getSentMIMEMessage();
        $mime = rtrim(strtr(base64_encode($mime), '+/', '-_'), '=');

        $message = new Google_Service_Gmail_Message();
        $message->setRaw($mime);
        return $message;
    }

    public function notifyProjectManager(Project $project, Applicant $applicant)
    {
        $googleClient = new Google_Client();
        $googleClient->setClientId(env('GMAIL_CLIENT_ID'));
        $googleClient->setClientSecret(env('GMAIL_CLIENT_SECRET'));

        $googleClient->addScope(Google_Service_Gmail::GMAIL_SEND);
        $googleClient->fetchAccessTokenWithRefreshToken(env('GMAIL_REFRESH_TOKEN'));

        $message = $this->createNotifyMessage($project, $applicant);
        $gmail = new Google_Service_Gmail($googleClient);

        $gmail->users_messages->send('me', $message);
    }

    public function take(Request $request)
    {
        $project = Project::find($request->input('project_id'));
        if ($project == null) {
            return response()->json([
                'status' => 'error',
                'message' => 'Project not found',
            ], 200);
        }
        $this->authorize('takeAsPM', $project);

        $project->manpro_id = $request->input('manpro_id');
        $project->save();

        return response('OK', 200);
    }

    public function cancelAsPM(Request $request)
    {
        $project = Project::find($request->input('project_id'));
        if ($project == null) {
            return response()->json([
                'status' => 'error',
                'message' => 'Project not found',
            ], 200);
        }
        $this->authorize('cancelAsPM', $project);

        $project->manpro_id = null;
        $project->save();

        return response('OK', 200);
    }
}
