<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Country::count() > 0) {
            $this->command->info('Countries table already seeded, skipping...');
            return;
        }

        $countries = [
            ['name' => 'Armenia'],
            ['name' => 'Germany'],
            ['name' => 'United States'],
            ['name' => 'Canada']
        ];

        Country::insert($countries);
    }
}
