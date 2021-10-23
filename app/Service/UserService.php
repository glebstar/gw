<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserService
{
    /**
     * Get list users paginate
     *
     * @param array $data
     * @return LengthAwarePaginator
     */
    public function list(array $data)
    {
        return User::paginate($data['limit']);
    }

    /**
     * Update Multi users
     *
     * @param array $data
     * @param string $id
     */
    public function updateMulti(array $data, string $id)
    {
        $ids = explode(',', $id);

        $users = User::find($ids);
        $users->each(function ($user, $key) use ($data) {
            $user->update($data);
        });
    }
}
