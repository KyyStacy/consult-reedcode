<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles if they don't exist
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $psikologRole = Role::firstOrCreate(['name' => 'psikolog']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Create admin account
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@reedcode.id'],
            [
                'name' => 'Admin Reed Code',
                'password' => bcrypt('password'),
            ]
        );
        if (!$adminUser->hasRole($adminRole)) {
            $adminUser->assignRole($adminRole);
        }

        // Create psikolog accounts (3 psikologs)
        for ($i = 1; $i <= 3; $i++) {
            $psikologEmail = $i === 1 ? 'psikolog@reedcode.id' : "psikolog{$i}@reedcode.id";
            $psikologUser = User::firstOrCreate(
                ['email' => $psikologEmail],
                [
                    'name' => "Psikolog {$i}",
                    'password' => bcrypt('password'),
                ]
            );
            if (!$psikologUser->hasRole($psikologRole)) {
                $psikologUser->assignRole($psikologRole);
            }
        }

        // Create user accounts (3 users)
        for ($i = 1; $i <= 3; $i++) {
            $userEmail = $i === 1 ? 'user@reedcode.id' : "user{$i}@reedcode.id";
            $userUser = User::firstOrCreate(
                ['email' => $userEmail],
                [
                    'name' => "User {$i}",
                    'password' => bcrypt('password'),
                ]
            );
            if (!$userUser->hasRole($userRole)) {
                $userUser->assignRole($userRole);
            }
        }
    }
}
