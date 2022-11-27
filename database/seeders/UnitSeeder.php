<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('units')->delete();
        Schema::enableForeignKeyConstraints();

        DB::table('units')
           ->insert([
                [
                    'id' => 1,
                    'name' => 'বস্তা'
                ],
                [
                    'id' => 2,
                    'name' => 'কার্টুন'
                ],
                [
                    'id' => 3,
                    'name' => 'প্যাকেট'
                ],
                [
                    'id' => 4,
                    'name' => 'বোতল'
                ],
                [
                    'id' => 5,
                    'name' => 'কেজি'
                ],
                [
                    'id' => 6,
                    'name' => 'গ্রাম'
                ],
                [
                    'id' => 7,
                    'name' => 'লিটার'
                ],
                [
                    'id' => 8,
                    'name' => 'মিলি লিটার'
                ],
                [
                    'id' => 9,
                    'name' => 'ফুট'
                ],
                [ 
                    'id' => 10,
                    'name' => 'মিটার'
                ],
              
                
                
           ]);
    }
}
