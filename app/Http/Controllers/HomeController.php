<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
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
    public function index(Request $request)
    {
        //filter projects
        $mobile_projects = Project::where('category','Mobile')->orderBy('deadline','asc')->get();
        $desktop_projects = Project::where('category','Desktop')->orderBy('deadline','asc')->get();
        $web_projects = Project::where('category','Website')->orderBy('deadline','asc')->get();
        $other_projects = Project::where('category','Other')->orderBy('deadline','asc')->get();

        return view('home', [
            'mobile_projects' => $mobile_projects,
            'desktop_projects' => $desktop_projects,
            'web_projects' => $web_projects,
            'other_projects' => $other_projects
        ]);
    }
}
