<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationsTableSeeder extends Seeder
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
            'date' => '2024-09-25',
            'time' => '18:00:00',
            'number' => 2
        ];
        DB::table('reservations')->insert($param);
        $param = [
            'user_id' => 2,
            'shop_id' => 2,
            'date' => '2024-09-27',
            'time' => '18:30:00',
            'number' => 3
        ];
        DB::table('reservations')->insert($param);
        $param = [
            'user_id' => 1,
            'shop_id' => 8,
            'date' => '2024-10-13',
            'time' => '19:00:00',
            'number' => 2
        ];
        DB::table('reservations')->insert($param);
        $param = [
            'user_id' => 2,
            'shop_id' => 6,
            'date' => '2024-10-25',
            'time' => '17:30:00',
            'number' => 7
        ];
        DB::table('reservations')->insert($param);
    }
}
