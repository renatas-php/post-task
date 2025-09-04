<?php

namespace App\Http\Controllers\Api\Front\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Services\RegisterService;

class RegisterController extends Controller
{   
    protected $registerService;

    public function __construct()
    {
        $this->registerService = new RegisterService();
    }

    public function register(RegisterRequest $request)
    {   
        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'surname' => $request->surname,
            'password' => Hash::make($request->password),
            'group_id' => $this->registerService->getRandomGroupId(),
        ]);

        Auth::login($user); // Log the user in
        $request->session()->regenerate();
  
        return response()->json([
            'data' => $user,
        ]);
    }
}
