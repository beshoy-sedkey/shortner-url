<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{    
    /**
     * login
     *
     * @return void
     */
    public function login()
    {
        if (Auth::attempt(['email'=>request('email') , 'password'=>request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('shortner-url')->accessToken;
            $success['userId'] = $user->id;
            return $this->Success200($success);
        }else {
            return $this->error403();
        }
    }
    public function register(RegistrationRequest $registrationRequest)
    {
        $user = User::create([
             'name' => $registrationRequest->name,
             'email'=> $registrationRequest->email,
             'password'=>bcrypt($registrationRequest->getPassword),

        ]);
            $success['token'] = $user->createToken('shortner-url')->accessToken;
            $success['userId'] = $user->id;
        $this->Success200($success);    

    }
    
}
