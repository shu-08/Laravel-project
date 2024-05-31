<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class stateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('state')->insert([
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'name' => '予約済',
                
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'name' => '使用中',
                
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'name' => '清掃中',
                
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'name' => '終了',
                
            ],
        ]);
    }
}
