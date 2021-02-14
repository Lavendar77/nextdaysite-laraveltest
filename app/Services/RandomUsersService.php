<?php

namespace App\Services;

use App\Models\User;

class RandomUsersService
{
    /**
     * Fake the specified number of users.
     *
     * @param integer $numberOfUsers
     * @return void
     */
    public static function make(int $numberOfUsers)
    {
        User::factory($numberOfUsers)->create();

        return;
    }
}
