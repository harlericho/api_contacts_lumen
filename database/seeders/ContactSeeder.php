<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('contacts')->insert([
            [
                'dni' => '1312362062',
                'names' => 'carlos choca',
                'address' => 'gatazo',
                'phone' => '0988050918',
                'photo' => null
            ],
            [
                'dni' => '2302302304',
                'names' => 'paola lopez',
                'address' => 'terrazas',
                'phone' => '0789789877',
                'photo' => null
            ],
            [
                'dni' => '1201201202',
                'names' => 'liz madel',
                'address' => 'san luis',
                'phone' => '0978978978',
                'photo' => null
            ],
        ]);
    }
}
