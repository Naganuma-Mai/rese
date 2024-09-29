<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class RepresentativesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => '店舗代表者1',
            'email' => 'representative1@example.com',
            'password' => Hash::make('coachtech3001'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'name' => '店舗代表者2',
            'email' => 'representative2@example.com',
            'password' => Hash::make('coachtech3002'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'name' => '店舗代表者3',
            'email' => 'representative3@example.com',
            'password' => Hash::make('coachtech3003'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'name' => '店舗代表者4',
            'email' => 'representative4@example.com',
            'password' => Hash::make('coachtech3004'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'name' => '店舗代表者5',
            'email' => 'representative5@example.com',
            'password' => Hash::make('coachtech3005'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'name' => '店舗代表者6',
            'email' => 'representative6@example.com',
            'password' => Hash::make('coachtech3006'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'name' => '店舗代表者7',
            'email' => 'representative7@example.com',
            'password' => Hash::make('coachtech3007'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'name' => '店舗代表者8',
            'email' => 'representative8@example.com',
            'password' => Hash::make('coachtech3008'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'name' => '店舗代表者9',
            'email' => 'representative9@example.com',
            'password' => Hash::make('coachtech3009'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'name' => '店舗代表者10',
            'email' => 'representative10@example.com',
            'password' => Hash::make('coachtech3010'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'name' => '店舗代表者11',
            'email' => 'representative11@example.com',
            'password' => Hash::make('coachtech3011'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'name' => '店舗代表者12',
            'email' => 'representative12@example.com',
            'password' => Hash::make('coachtech3012'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'name' => '店舗代表者13',
            'email' => 'representative13@example.com',
            'password' => Hash::make('coachtech3013'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'name' => '店舗代表者14',
            'email' => 'representative14@example.com',
            'password' => Hash::make('coachtech3014'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'name' => '店舗代表者15',
            'email' => 'representative15@example.com',
            'password' => Hash::make('coachtech3015'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'name' => '店舗代表者16',
            'email' => 'representative16@example.com',
            'password' => Hash::make('coachtech3016'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'name' => '店舗代表者17',
            'email' => 'representative17@example.com',
            'password' => Hash::make('coachtech3017'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'name' => '店舗代表者18',
            'email' => 'representative18@example.com',
            'password' => Hash::make('coachtech3018'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'name' => '店舗代表者19',
            'email' => 'representative19@example.com',
            'password' => Hash::make('coachtech3019'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'name' => '店舗代表者20',
            'email' => 'representative20@example.com',
            'password' => Hash::make('coachtech3020'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('representatives')->insert($param);
    }
}
