<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            [
                'id' => 1, 
                'title' => 'Superadmin',
            ],
            [
                'id' => 2, 
                'title' => 'Admin',
            ],
            [
                'id' => 3, 
                'title' => 'Member',
            ],
        ]);
    }
}
