<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Default password for all users: password
     */
    public function run(): void
    {
        // Create 2 managers (no manager_id)
        $manager1 = User::create([
            'name' => 'Sarah Johnson',
            'email' => 'sarah.johnson@horizondynamics.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
            'manager_id' => null,
        ]);

        $manager2 = User::create([
            'name' => 'Michael Chen',
            'email' => 'michael.chen@horizondynamics.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
            'manager_id' => null,
        ]);

        // Create employees reporting to Manager 1
        User::create([
            'name' => 'Emily Rodriguez',
            'email' => 'emily.rodriguez@horizondynamics.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
            'manager_id' => $manager1->id,
        ]);

        User::create([
            'name' => 'David Park',
            'email' => 'david.park@horizondynamics.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
            'manager_id' => $manager1->id,
        ]);

        User::create([
            'name' => 'Lisa Thompson',
            'email' => 'lisa.thompson@horizondynamics.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
            'manager_id' => $manager1->id,
        ]);

        User::create([
            'name' => 'James Wilson',
            'email' => 'james.wilson@horizondynamics.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
            'manager_id' => $manager1->id,
        ]);

        User::create([
            'name' => 'Anna Martinez',
            'email' => 'anna.martinez@horizondynamics.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
            'manager_id' => $manager1->id,
        ]);

        // Create employees reporting to Manager 2
        User::create([
            'name' => 'Robert Kim',
            'email' => 'robert.kim@horizondynamics.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
            'manager_id' => $manager2->id,
        ]);

        User::create([
            'name' => 'Jennifer Lee',
            'email' => 'jennifer.lee@horizondynamics.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
            'manager_id' => $manager2->id,
        ]);

        User::create([
            'name' => 'Christopher Brown',
            'email' => 'christopher.brown@horizondynamics.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
            'manager_id' => $manager2->id,
        ]);

        User::create([
            'name' => 'Michelle Davis',
            'email' => 'michelle.davis@horizondynamics.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
            'manager_id' => $manager2->id,
        ]);

        User::create([
            'name' => 'Daniel Anderson',
            'email' => 'daniel.anderson@horizondynamics.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
            'manager_id' => $manager2->id,
        ]);
    }
}
