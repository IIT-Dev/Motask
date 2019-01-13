<?php

namespace App\Http\Controllers;

use App\User;
use App\Project;
use App\Applicant;
use Auth;
use Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $requester_id = Auth::user()->id;
        $requester = User::find($requester_id);
        if ($requester == null) {
            abort(404);
        }

        //deny access on others profile except for admin
        if (Auth::user()->id != $id && $requester->role != 'admin') {
            abort(403);
        }

        //retrieve user
        $user = User::find($id);
        if ($user == null) {
            abort(404);
        }

        $projects = array();
        $applied = array();
        //retrieve projects based on role
        if ($user->role == 'programmer') {
            //if user is a programmer, have a list of projects taken and applied
            $table_title = 'Projects Taken';
            $projects = $user->projects;
        } elseif ($user->role == 'project_manager') {
            $table_title = 'Projects Created';
            $projects = Project::where('created_by', $user->email)->get();
        } elseif ($user->role == 'admin') {
            $table_title = 'All Projects';
            $projects = Project::all();
        } elseif ($user->role == 'marketing') {
            $table_title = 'Projects Created';
            $projects = Project::where('created_by', $user->email)->get();
        }

        if ($user->role != 'programmer') {
            foreach ($projects as $project) {
                $project->applicants = Applicant::where('project_id', $project->id)->count();
            }
        }

        $applications = array();
        $applications = Applicant::where('applicant_id', Auth::user()->id)->get();
        if ($applications->isEmpty()) {
            $applications = 'None';
        } else {
            foreach ($applications as $ap) {
                $project = Project::find($ap->project_id);
                $ap->project_title = $project->title;
                $ap->status = $project->status;
                $ap->deadline = $project->deadline;
                if ($project->manpro_id == null){
                    $ap->manpro = 'None';
                } else {
                    $ap->manpro = User::find($project->manpro_id)->name;
                }
            }
        }

        return view('user', [
            'user' => $user,
            'table_title' => $table_title,
            'projects' => $projects,
            'applied' => $applications,
            ]);
    }

    public function update(Request $request, $id)
    {
        $requester_id = Auth::user()->id;
        $requester = User::find($requester_id);
        if ($requester == null) {
            abort(404);
        }

        //deny edit other's profile
        if (Auth::user()->id != $id) {
            abort(403);
        }

        //retrieve user
        $user = User::find($id);
        if ($user == null) {
            abort(404);
        }

        $validator = Validator::make($request->all(), [
            'line' => 'required|max:255',
            'phone' => 'required|max:255',
            'linkedin' => 'required|max:255',
            'git' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        // $this->authorize('update', $requester);

        $requester->phone = $request->phone;
        $requester->linkedin = $request->linkedin;
        $requester->git = $request->git;
        if ($requester->line != null) {
            $requester->line = $request->line;
        } else {
            $requester->line = '-';
        }
        if ($requester->phone != null) {
            $requester->phone = $request->phone;
        } else {
            $requester->phone = '-';
        }
        if ($requester->linkedin != null) {
            $requester->linkedin = $request->linkedin;
        } else {
            $requester->linkedin = '-';
        }
        if ($requester->git != null) {
            $requester->git = $request->git;
        } else {
            $requester->git = '-';
        }
        $requester->save();

        return redirect('/user/'.$requester_id);
    }

    public function edit($id)
    {
        $requester_id = Auth::user()->id;
        $requester = User::find($requester_id);
        if ($requester == null) {
            abort(404);
        }

        //deny edit other's profile
        if (Auth::user()->id != $id) {
            abort(403);
        }

        //retrieve user
        $user = User::find($id);
        if ($user == null) {
            abort(404);
        }

        return view('user.edit', [
            'user' => $user,
            ]);
    }
}
