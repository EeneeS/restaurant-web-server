<?php

namespace App\Http\Controllers;

use App\Modules\User\Services\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private UserService $_service;
    function __construct(UserService $service) {
        $this->_service = $service;
    }

    public function register(Request $request) {
        $data = $request->all();
        $this->_service->registerUser($data);
        if ($this->_service->hasErrors()) {
            return response($this->_service->getErrors(), 400);
        }
        return response()->noContent();
    }

    public function login(Request $request) {
        $data = $request->only('email', 'password');
        $token = $this->_service->login($data);
        if ($token) {
            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ]);
        } else {
            return response("Unauthorized", 401);
        }
    }
}
