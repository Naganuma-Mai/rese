<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => 1,
            'shop_id' => 1
        ];
        DB::table('likes')->insert($param);
        $param = [
            'user_id' => 1,
            'shop_id' => 4
        ];
        DB::table('likes')->insert($param);
        $param = [
            'user_id' => 1,
            'shop_id' => 6
        ];
        DB::table('likes')->insert($param);
        $param = [
            'user_id' => 2,
            'shop_id' => 2
        ];
        DB::table('likes')->insert($param);
        $param = [
            'user_id' => 2,
            'shop_id' => 7
        ];
        DB::table('likes')->insert($param);
        $param = [
            'user_id' => 2,
            'shop_id' => 10
        ];
        DB::table('likes')->insert($param);
    }
}
