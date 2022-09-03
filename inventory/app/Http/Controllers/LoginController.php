<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
	public function index()
	{
		return view('login');
	}

	public function login(Request $request)
	{
	    $rules = [
	        'name'		=> 'required',
	        'password'	=> 'required'
	    ];

	    $messages = [
	        'name.required'		=> 'Username wajib diisi',
	        'password.required'	=> 'Password wajib diisi',
	    ];

	    $validator = Validator::make($request->all(), $rules, $messages);

	    if($validator->fails()) {
	        return redirect()->back()->withErrors($validator)->withInput($request->all);
	    }

	    $remember = $request->has('remember') ? true : false;

	    $data = [
	        'name'		=> $request->input('name'),
	        'password'  => $request->input('password'),
	    ];

	    Auth::attempt($data, $remember);

	    if (Auth::check()) {
	    	session::put('sess_username', $data['name']);
	        return redirect()->route('home');
	    } else {
	        return redirect()->route('login')->withInput()->withErrors(['error' => 'Username atau Password tidak sesuai !!!']);
	    }
	}

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
}
