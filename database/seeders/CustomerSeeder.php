<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Customer::count() > 0) {
            $this->command->info('Customers table already seeded, skipping...');
            return;
        }

        Customer::create([
            'first_name' => "John",
            'last_name' => 'Doe',
            'birth_date' => '1997-01-01',
            'country_id' => 1,
            'profession' => 'Software Engineer',
            'years_in_profession' => 5
        ]);
    }
}
