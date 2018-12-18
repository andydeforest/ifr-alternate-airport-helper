<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Airport;
use DB;

class ParseController extends Controller {

    public function index(Request $request) {
		$ap = null;
		$radius = null;
		$precision = [];
		$non_precision = [];

		if($request->airport !== '') {
			$ap = Airport::where('icao', strtoupper($request->airport))->first();
			if(!$ap) {
				$ap = Airport::where('identifier', strtoupper($request->airport))->first();
			}
		}
		if($request->speed !== '') {
			$speed = intval($request->speed);
			$radius = ($speed * 0.75) * 1852;
		}
		// find airports in radius with precision approach
		if($ap !== null && $radius !== null) {

			$nm_dist = (($speed * 0.75) * 6000) / 5280;

			$precision_ids = DB::select('SELECT id FROM (SELECT id, icao, latitude, longitude, has_precision_approach, identifier, SQRT(POW(69.1 * (latitude - '.floatval($ap->latitude).'), 2) + POW(69.1 * ('.floatval($ap->longitude).' - longitude) * COS(latitude / 57.3), 2)) AS distance FROM airports) as innerSelect WHERE distance <= '.$nm_dist.' AND has_precision_approach = TRUE AND identifier != \''.$ap->identifier.'\' ');

			foreach($precision_ids as $p) {
				$prec_ap = Airport::find($p->id);
				$prec_ap->distance = $ap->distance($prec_ap);
				array_push($precision, $prec_ap);
			}

			$nonprecision_ids = DB::select('SELECT id FROM (SELECT id, icao, latitude, longitude, has_non_precision_approach, has_precision_approach, identifier, SQRT(POW(69.1 * (latitude - '.floatval($ap->latitude).'), 2) + POW(69.1 * ('.floatval($ap->longitude).' - longitude) * COS(latitude / 57.3), 2)) AS distance FROM airports) as innerSelect WHERE distance <= '.($speed * 0.75).' AND has_non_precision_approach = TRUE AND has_precision_approach = FALSE AND identifier != \''.$ap->identifier.'\' ');

			foreach($nonprecision_ids as $p) {
				$nonprec_ap = Airport::find($p->id);
				$nonprec_ap->distance = $ap->distance($nonprec_ap);
				array_push($non_precision, $nonprec_ap);
			}
		}

		return ['success' => true, 'airport' => $ap, 'radius' => $radius, 'precision_airports' => $precision, 'non_precision_airports' => $non_precision];

	}
}
