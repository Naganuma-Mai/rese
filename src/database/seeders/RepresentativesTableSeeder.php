<?php

namespace Database\Seeders;

use App\Models\Representative;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RepresentativesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Representative::create([
            'name' => '店舗代表者',
            'email' => 'representative@example.com',
            'password' => Hash::make('coachtech1107')
        ]);
    }
}
