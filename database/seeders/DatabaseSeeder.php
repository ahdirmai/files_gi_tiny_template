<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Division;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

// use Spatie\Permission\Contracts\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $name = [
            'admin',
            'user'
        ];

        foreach ($name as $name) {

            Role::create([
                'name' => $name
            ]);
        };

        $name = [
            'View',
            'Manage'
        ];
        foreach ($name as $name) {
            Permission::create([
                'name' => $name
            ]);
        };


        $name = [
            'Web Developer',
            'Ui/UX Design',
            'Streaming Tech',
            'Social Media Strategis'
        ];

        foreach ($name as $name) {
            Division::create([
                'name' => $name
            ]);
        };

        User::create([
            'name' => 'ahdirmai',
            'username' => 'ahdirmai',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            // 'division_id' => random_int(1, 4)
            // password
        ])->assignRole('admin');

        User::create([
            'name' => 'user 2',
            'username' => 'user2',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'division_id' => random_int(1, 4)
        ])->assignRole('user');

        User::create([
            'name' => 'Rani',
            'username' => 'raniii',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'division_id' => random_int(1, 4)
        ])->assignRole('user');

        User::create([
            'name' => 'Syarbini',
            'username' => 'syarbini',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'division_id' => random_int(1, 4)
        ])->assignRole('user');
    }
}
