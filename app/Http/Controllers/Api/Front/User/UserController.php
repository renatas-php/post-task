<?php

namespace App\Http\Controllers\Api\Front\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {        
        $data = User::where('id', auth('sanctum')->id())->firstOrFail();

        return response()->json([
            'data' => $data,
        ]);
    }
}
