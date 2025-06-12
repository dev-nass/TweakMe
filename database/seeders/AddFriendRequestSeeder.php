<?php

namespace Database\Seeders;

use App\Models\AddFriendRequest;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddFriendRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = User::all();

        foreach ($users as $user) {
            AddFriendRequest::create([
                'sender_id' => $user->id,
                'receiver_id' => 21,
                'status' => 'pending',
            ]);
        }
    }
}
