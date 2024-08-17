<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::where('username', 'admin');
        if ($user->first()) {
            $user->delete();
        }
        User::create([
            'uuid' => Str::orderedUuid(),
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'role' => "ADMIN",
        ]);
    }
}
