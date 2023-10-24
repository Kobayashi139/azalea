<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reviews')->insert([
            'store_name' =>'店名',
            'body' => 'お店の感想を記入',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ]);
    }
}
