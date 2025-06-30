<?php

namespace Tests\Traits;

use App\Models\User;

trait CreateUser
{

    protected function createUser()
    {
        return User::factory()->create();
    }
}