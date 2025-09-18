<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class AccountSeeder extends Seeder
{
    public function run(): void
    {
        $role = Role::firstOrCreate(['name' => 'superadmin']);
        
        $admin = User::updateOrCreate(
            ['email' => 'jsanguyo1624@gmail.com'],
            [
                'uuid'           => (string) Str::uuid(),
                'name'           => 'Jerry Sanguyo',
                'contact_number' => '00000000000',
                'password'       => bcrypt('password'),
            ]
        );

        $admin->syncRoles([$role]);
    }
}
