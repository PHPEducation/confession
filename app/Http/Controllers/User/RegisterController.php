<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Validator;

class RegisterController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * [registerForm description]
     * @return [type] [description]
     */
    public function registerForm()
    {
        return view('user.register.register');
    }

    /**
     * [register description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function register(RegisterRequest $request)
    {
        $email = $request->input('email');

        $password = $request->input('password');

        $name = $request->input('name');

        $nickName = $request->input('nick_name');

        User::create([
            'name' => $name,
            'nick_name' => $nickName,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        return redirect()->route('user.login_form');
    }
}
