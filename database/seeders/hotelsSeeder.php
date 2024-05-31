<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class hotelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \DB::table('hotels')->insert([
            [
                'userid' => 'uhs',
                'name' => 'shu',
                'email' => 'shu@gmail.com',
                'password' => 'shsh',
                
            ],
            [
                'userid' => 'taro',
                'name' => '太郎くん',
                'email' => 'taro@gmail.com',
                'password' => 'tarotaro',
            ],
        ]);
    }
}
