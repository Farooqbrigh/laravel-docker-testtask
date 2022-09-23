<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }
    public function getData()
    {
        $users = User::select('id','name','email', 'counter')->get();
        return view('home', ['users' => $users]);
    }
    public function postData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'
        ]);
        $check_email = User::where(['email' => $request->email])->first();
        if (!empty($check_email)) {
            return redirect('home')->withErrors(['message' => 'Given email already exist.']);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return back();
    }
}
