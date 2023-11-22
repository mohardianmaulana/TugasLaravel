<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class flowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('flowers')->insert([
            'nama'=>'mawar',
            'jumlah'=> 10,
            'harga'=>15000,
            'image'=>'',
        ]);
    }
}