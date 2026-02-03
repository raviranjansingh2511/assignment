<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $check = User::where('email','admin@gmail.com')->where('role',1)->first();
        if($check){
            User::where('id', $check->id)->update([
                'password' => Hash::make(12345678),
            ]);
        }else{
            User::create([
                'name' => 'Super Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make(12345678),
                'role' => 1,
                'invited_by' => null,
                'deleted_at' => null,
            ]);
        }
    }
}
