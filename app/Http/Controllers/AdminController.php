<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
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

    public function index(Request $request)
    {
        if(Gate::allows('manage-admin')) {
            $users = User::where('email', 'like', $request->nim.'%')->get();

            return view('admin', [
                'users' => $users
                ]);
        } else {
            abort(403);
        }
    }

    public function manage(Request $request)
    {
        if(Gate::allows('manage-admin')) {
        	$user = User::find($request->input('user_id'));
        	if($user == null)
        		return response()->json([
        			'status' => 'error',
        			'message' => 'User not found'
        		], 200);
        	$user->role = $request->input('role');
        	$user->save();
            $role = 'roleless.';
            if ($user->role == 'admin') {
                $role = 'admin.';
            } else if ($user->role == 'project_manager') {
                $role = 'project manager.';
            } else if ($user->role == 'programmer') {
                $role = 'programmer.';
            }
        	return response()->json([
        			'status' => 'success',
        			'message' => $user->email.' role changed to '.$role,
        		], 200);

        } else {
            return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized access',
                ], 200);
        }
    }
}
