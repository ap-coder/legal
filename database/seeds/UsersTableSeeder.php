<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [[
            'id'                 => 1,
            'name'               => 'Admin',
            'email'              => 'admin@admin.com',
            'password'           => '$2y$10$ewxYWygH9lbtz3dkv84/e.OwIvhGG8DQ.o6kan4nCrkBVKY18F58y',
            'remember_token'     => null,
            'created_at'         => '2019-08-20 23:42:30',
            'updated_at'         => '2019-08-20 23:42:30',
            'deleted_at'         => null,
            'approved'           => 1,
            'verified'           => 1,
            'verified_at'        => '2019-08-20 23:42:30',
            'verification_token' => '',
        ]];

        User::insert($users);
    }
}
