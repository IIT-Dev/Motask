<?php

namespace App\Http\Controllers;

use Validator;
use Auth;
use DateTime;
use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getById(Request $request, $id)
    {
        $project = Project::find($id);
        if($project == null)
            abort(404);
        return view('project.index', [
            'project' => $project
            ]);   
    }

    public function showCreateForm()
    {
        //authorize user based on role
        $this->authorize('create', Project::class);

        return view('project.create', [
            'action' => 'create'
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
            'status' => 'required',
            'specification_url' => 'required|max:300',
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
        if($request->budget != null) {
            $project->budget = $request->budget;
        }
        $project->project_owner = $request->project_owner;
        $project->status = $request->status;
        $project->specification_url = $request->specification_url;
        $project->created_by = Auth::user()->email;
        $project->save();

        return redirect('/home');
    }

    public function showEditForm(Request $request)
    {  
        $project = Project::find($request->query('id'));
        $this->authorize('update', $project);

        $deadline = new DateTime($project->deadline);
        $project->deadline =  $deadline->format('Y-m-d');

        return view('project.edit', [
            'action'    => 'edit', 
            'project'   => $project
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
            'status' => 'required',
            'specification_url' => 'required|max:300',
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
        if($request->budget != null) {
            $project->budget = $request->budget;
        } else {
            $project->budget = null;
        }
        $project->project_owner = $request->project_owner;
        $project->status = $request->status;
        $project->specification_url = $request->specification_url;
        $project->created_by = Auth::user()->email;
        $project->save();

        return redirect('/project/'.$project->id);
    }    

    public function delete(Request $request){
        $id = $request->input('id');
        $project = Project::find($id);
        $this->authorize('delete', $project);
        
        //delete by id
        $project->delete();
        return response('OK', 200);
    }
}
