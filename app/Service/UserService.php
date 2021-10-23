<?php

namespace App\Service;

use App\Models\User;

class UserService
{
    public function list(array $data)
    {
        return User::paginate($data['limit']);
    }
}
