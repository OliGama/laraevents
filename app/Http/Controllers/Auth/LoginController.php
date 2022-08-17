<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest as AuthLoginRequest;
use Illuminate\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create(){
        return view('auth.login');
    }
    public function store(AuthLoginRequest $request){
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($credentials)){
            $userRole = auth()->user()->role;

            if($userRole === 'participant'){
                return redirect()->route('participant.dashboard.index');
            }

            if($userRole === 'organization'){
                return redirect()->route('organization.dashboard.index');
            }
        }

        return redirect()
            ->route('auth.login.create')
            ->with('warning', 'Autenticação falhou')
            ->withInput();
    }
    public function destroy(){
        Auth::logout();
        return redirect()->route('auth.login.create');
    } 
}
