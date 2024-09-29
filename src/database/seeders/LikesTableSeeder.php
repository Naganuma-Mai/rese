<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
            'shop_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('likes')->insert($param);
        $param = [
            'user_id' => 1,
            'shop_id' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('likes')->insert($param);
        $param = [
            'user_id' => 1,
            'shop_id' => 6,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('likes')->insert($param);
        $param = [
            'user_id' => 2,
            'shop_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('likes')->insert($param);
        $param = [
            'user_id' => 2,
            'shop_id' => 7,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('likes')->insert($param);
        $param = [
            'user_id' => 2,
            'shop_id' => 10,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('likes')->insert($param);
    }
}
