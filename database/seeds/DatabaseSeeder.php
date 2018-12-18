<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
		// To use this, you need to have the APT.txt file from the FAA's 28-da7 subscription
		// it can be found here: https://www.faa.gov/air_traffic/flight_info/aeronav/aero_data/NASR_Subscription/

		//$this->call(AirportsTableSeeder::class);
		
		// the above file was not included because it's so large, so instead i'll just import the SQL directly
        Eloquent::unguard();
        $path = database_path('seeds/airports.sql');
        \DB::unprepared(file_get_contents($path));
        $this->command->info('Airport table seeded!');

    }
}
