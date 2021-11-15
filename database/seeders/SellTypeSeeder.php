<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SellTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sell_types')->delete();
        DB::table('sell_types')
           ->insert([
               [
                   'id' => 1,
                   'name' => 'খুচরা'
               ],
               [
                   'id' => 2,
                   'name' => 'পাইকারী'
               ]
           ]);
    }
}
