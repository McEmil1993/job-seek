<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MakeCountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = file_get_contents(storage_path('countries/countries.json'));
        $countries = json_decode($countries, true)['countries'];
        \App\Models\Country::insert($countries);

        $states = file_get_contents(storage_path('countries/states.json'));
        $states = json_decode($states, true)['states'];
        \App\Models\State::insert($states);

        $cities = file_get_contents(storage_path('countries/cities.json'));
        $cities = json_decode($cities, true)['cities'];
        collect($cities)
            ->chunk(500)
            ->each(function ($city) {
                \App\Models\City::insert($city->toArray());
            });
    }
}
