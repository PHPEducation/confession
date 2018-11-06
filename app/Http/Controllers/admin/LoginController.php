<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\LoginFormAdminRequest;
use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;
use Session;

class LoginController extends Controller
{
    public function viewLogin()
    {
        return view('admin.login');
    }

    public function postLogin(LoginFormAdminRequest $request)
    {
        $login = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
//        dd($login);
        if (Auth::attempt($login)) {
            Session::put('website_language', config('app.locale'));
            // ham attempt de kiem tra thong tin dang nhap co trung voi DB

            return redirect()->route('dashboard.index');
//            return view('admin.home');
        } else {
            return redirect()->back()->with('danger', trans('message.danger'));
        }
    }

    public function adminLogOut()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
