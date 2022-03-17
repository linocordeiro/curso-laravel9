<?php

namespace Database\Seeders;

use App\Models\Comment;
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
        //forma 1
        // User::create([
        //     'name' => 'Juscelino Cordeiro',
        //     'email' => 'jfilhdev@gmailcom',
        //     'password' => bcrypt('123456'),
        // ]);

        //forma2
        // $users = User::factory()
        //     ->count(10)
        //     ->make();

        // foreach ($users->toArray() as $user) {
        //     $user['password'] = bcrypt('123456');
        //     User::create($user);
        // }

        //forma 3
        User::factory()
            ->count(10)
            ->has(Comment::factory()->count(15))
            ->create();
    }
}
