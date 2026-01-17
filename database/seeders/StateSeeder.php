<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\State;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = json_decode(
            file_get_contents(database_path('data/states.json')),
            true
        );

        foreach ($states as $state) {
            $country = Country::where('code', $state['country_code'])->first();

            if ($country) {
                State::updateOrCreate(
                    [
                        'country_id' => $country->id,
                        'code' => $state['code']
                    ],
                    [
                        'name' => $state['name'],
                        'is_active' => true
                    ]
                );
            }
        }
    }
}
