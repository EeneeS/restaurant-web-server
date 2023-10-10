<?php

namespace App\Modules\User\Services;

use App\Models\User;
use App\Modules\Core\Services\Service;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserService extends Service
{

    protected $_rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6',
    ];

    private array $credentailRules = [
        'email' => 'required|string|email',
        'password' => 'required|string',
    ];

    function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function registerUser($data) {
        $this->validate($data);
        if ($this->hasErrors()) {
            return;
        }

        $data['password'] = Hash::make($data['password']);
        $this->_model->create($data);
    }

    function login($data) : ?string {
        $validator = Validator::make($data, $this->credentailRules);
        if ($validator->fails()) return null;

        $data = collect($data);
        $credentials = $data->only('email', 'password')->toArray();
        return auth()->attempt($credentials);
    }
}
