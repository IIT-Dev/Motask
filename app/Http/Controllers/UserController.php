<?php

namespace App\Http\Controllers;

use App\User;
use App\Project;

use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
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
        if($requester == null) {
            abort(404);
        }

        //deny access on others profile except for admin
        if(Auth::user()->id != $id && $requester->role != 'admin')
            abort(403);

        //retrieve user
        $user = User::find($id);
        if($user == null)
            abort(404);

        $projects = array();
        //retrieve projects based on role
        if($user->role == 'programmer') {
            $table_title = 'Projects Taken';
            $projects = $user->projects;
        } 
        else if($user->role == 'project_manager') {
            $table_title = 'Projects Created';
            $projects = Project::where('created_by', $user->email)->get();
        }
        else if($user->role == 'admin') {
            $table_title = 'All Projects';
            $projects = Project::all();
        }
        
        return view('user', [
            'user' => $user,
            'table_title' => $table_title,
            'projects' => $projects
            ]);
    }
}
