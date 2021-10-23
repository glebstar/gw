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
    public function list(array $data): LengthAwarePaginator
    {
        return User::paginate($data['limit']);
    }

    /**
     * Update multi users
     *
     * @param array $data
     * @param string $id
     */
    public function updateMulti(array $data, string $id): void
    {
        $ids = explode(',', $id);

        $users = User::find($ids);
        $users->each(function ($user, $key) use ($data) {
            $user->update($data);
        });
    }

    /**
     * Delete multi users
     *
     * @param $id
     */
    public function destroyMulti($id): void 
    {
        $ids = explode(',', $id);

        User::whereIn('id', $ids)->delete();
    }
}
