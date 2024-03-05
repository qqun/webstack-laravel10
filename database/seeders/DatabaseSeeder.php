<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\System;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $user = User::create(
        //     [
        //         "name"  =>  'Admin@adm.in',
        //         "email" =>  'admin@adm.in',
        //         "password"  =>  Hash::make('admin'),
        //         "email_verified_at" =>  now(),
        //         "created_at"    =>  now(),
        //     ]
        // );

        $system = [
            [
                'title' =>  '标题',
                'key'   =>  'site',
                'value' =>  'my site',
                'describe'  =>  ''
            ],
            [
                'title' =>  '关键词',
                'key'   =>  'keyword',
                'value' =>  'my site',
                'describe'  =>  ''
            ],
            [
                'title' =>  '描述',
                'key'   =>  'description',
                'value' =>  'my site',
                'describe'  =>  ''
            ],
            [
                'title' =>  '图标',
                'key'   =>  'icon',
                'value' =>  'my site',
                'describe'  =>  ''
            ],
            [
                'title' =>  '备案',
                'key'   =>  'beian',
                'value' =>  'my site',
                'describe'  =>  ''
            ],
        ];

        foreach($system as $s){
            System::create($s);
        }
    }
}
