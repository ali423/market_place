<?php

namespace Database\Seeders;

use App\Enum\UserRole;
use App\Enum\UserStatus;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_role= Role::query()->where('title',UserRole::ADMIN)->firstOrFail();

        User::query()
            ->create([
                'role_id' => $admin_role->id,
                'name' => 'Ali Mokhtari',
                'status' => UserStatus::ACTIVATE,
                'email' => 'alimokhtari423@gmail.com',
                'password' => ('123456789'),
            ]);
    }
}
