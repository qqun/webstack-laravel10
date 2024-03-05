<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if( !Auth::attempt(['email' => $email, 'password' => $password])) {
            throw new \Exception('登录失败');
        }

        return redirect()->route("admin.index")->with("message", "successfully logged in")->withInput();

        // return [
        //     'token' => $request->user()->createToken("USER_TOKEN"),
        //     'user'  =>  $request->user()
        // ];
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("login")->with('message','user logout')->withInput();
    }
}
