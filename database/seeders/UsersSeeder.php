<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::create([
        //     'name' => 'Juscelino Cordeiro',
        //     'email' => 'jfilhdev@gmailcom',
        //     'password' => bcrypt('123456'),
        // ]);
        
        $users = User::factory()
            ->count(3)
            ->make();

        foreach ($users->toArray() as $user) {
            $user['password'] = bcrypt('123456');
            User::create($user);
        }
    }
}
