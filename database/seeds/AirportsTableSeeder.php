<?php

use Illuminate\Database\Seeder;
use App\Airport;

require 'Parser.php';

class AirportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$parser = new Parser(database_path('seeds/APT.txt'));

		$airports = [];
		
		$parser->forEach(function($airport) use (&$airports)  {
			array_push($airports, $airport);
		});
		
		
		foreach($airports as $ap) {
			$airport = new Airport;
			$airport->icao = $ap->getIcao();
			$airport->identifier = $ap->getIdentifier();
			$airport->name = $ap->getName();
			$airport->city = $ap->getCity();
			$airport->county = $ap->getCounty();
			$airport->state = $ap->getState();
			$airport->latitude = $ap->getLatitude();
			$airport->longitude = $ap->getLongitude();
			$airport->elevation = $ap->getElevation();
			$airport->type = $ap->getType();
			$airport->has_control_tower = $ap->hasControlTower();

			$precision_approach = false;
			$nonprecision_approach = false;
			foreach($ap->getRunways() as $rwy) {
				if($rwy->getMarkings() === 'PIR') {
					$precision_approach = true;
				}
				if($rwy->getMarkings() === 'NPI') {
					$nonprecision_approach = true;
				}
			}
			$airport->has_precision_approach = $precision_approach;
			$airport->has_non_precision_approach = $nonprecision_approach;
			$airport->save();
		
		}
    }
}
