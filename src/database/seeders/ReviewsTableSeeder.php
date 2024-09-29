<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReviewsTableSeeder extends Seeder
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
            'point' => 5,
            'comment' => 'とてもおいしかったです！',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('reviews')->insert($param);
        $param = [
            'user_id' => 2,
            'shop_id' => 2,
            'point' => 4,
            'comment' => 'お店の雰囲気がよかったです。',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('reviews')->insert($param);
    }
}
