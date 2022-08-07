<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\http\Requests\Auth\RegisterRequest;
use App\Models\{User, Address};

class RegisterController extends Controller
{
    public function create(){
        return view('auth.register');
    }
    public function store(RegisterRequest $request){
        $requestData = $request->all();
        $requestData['user']['role'] = 'participant';
        $user = User::create($requestData['user']);
        $user->address()->create($requestData['address']);

        foreach ($requestData['phones'] as $phone){
            $user->phones()->create($phone);
        }
    }
}
