<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = json_decode(
            file_get_contents(database_path('data/countries.json')),
            true
        );

        DB::table('countries')->upsert(
            $countries,
            ['code'],
            ['name', 'iso3', 'phone_code', 'currency', 'is_active']
        );
    }
}
