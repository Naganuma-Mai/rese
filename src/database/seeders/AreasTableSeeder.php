<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => '東京都',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('areas')->insert($param);
        $param = [
            'name' => '大阪府',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('areas')->insert($param);
        $param = [
            'name' => '福岡県',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('areas')->insert($param);
    }
}
