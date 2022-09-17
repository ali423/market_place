<?php

namespace Database\Seeders;

use App\Enum\UserRole;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create admin role
        $admin_role=Role::query()->create([
           'title'=>UserRole::ADMIN,
        ]);
        $admin_role->Permissions()->attach(Permission::all());

        // create seller role
        Role::query()->create([
            'title'=>UserRole::SELLER,
        ]);

        // create customer role
        Role::query()->create([
            'title'=>UserRole::CUSTOMER,
        ]);
    }
}
