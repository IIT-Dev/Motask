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
        $category = $request->query('category');
        if($category != null)
            $projects = Project::where('category', $category)->orderBy('deadline','asc')->get();
        else
            $projects = Project::orderBy('deadline','asc')->get();

        return view('home', [
            'projects' => $projects
            ]);
    }
}
