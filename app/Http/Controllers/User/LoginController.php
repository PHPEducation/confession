<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Validator;

class LoginController extends Controller
{
    //đăng nhập quá 3 lần thì sẽ bị block đăng nhập trong 10s
    protected $maxAttempts = 3;
    protected $decayMinutes = 10;

    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * [loginForm description]
     * @return [type] [description]
     */
    public function loginForm()
    {
        return view('user.login.login');
    }

    /**
     * [login description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function login(LoginRequest $request)
    {
        $email = $request->input('email');

        $password = $request->input('password');

        if (Auth::attempt(['email' => $email, 'password' => $password], $request->has('remember-me'))) {
            return redirect()->route('cfs');
        } else {
            $errors = new MessageBag(['password' => __('message.fail')]);

            return redirect()->back()->withInput()->withErrors($errors);
        }
    }

    /**
     * [logout description]
     * @return [type] [description]
     */
    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('cfs');
    }
}
