<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
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
    public function index(Request $request)
    {
        //filter projects
        $mobile_projects = Project::where('category', 'Mobile')->where('status', 'Open')->orderBy('deadline', 'asc')->get();
        $desktop_projects = Project::where('category', 'Desktop')->where('status', 'Open')->orderBy('deadline', 'asc')->get();
        $web_projects = Project::where('category', 'Website')->where('status', 'Open')->orderBy('deadline', 'asc')->get();
        $other_projects = Project::where('category', 'Other')->where('status', 'Open')->orderBy('deadline', 'asc')->get();

        return view('home', [
            'mobile_projects' => $mobile_projects,
            'desktop_projects' => $desktop_projects,
            'web_projects' => $web_projects,
            'other_projects' => $other_projects,
        ]);
    }
}
