<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login (LoginFormRequest $request)
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)){
            return response()->json([
                'message' => 'Foydalanuvchi_Id yoki Parol noto`g`ri'
            ], 401);
        }

        $user = Auth::user();

        if (!$user->is_active){
            return response()->json([
                'message' => 'Hisob bloklangan'
            ], 403);
        }

        $token = $user->createToken('crm-token')->plainTextToken;

        return response()->json([
            'message' => 'Muvaffaqiyatli kirish.',
            'token' => $token,
            'user' => $user
        ]);

    }
}
