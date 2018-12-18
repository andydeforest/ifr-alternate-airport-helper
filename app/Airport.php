<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model {

	protected $table = 'airports';
	
	public function distance(Airport $a) {
        $theta = $this->longitude - $a->longitude;
        $dist = sin(deg2rad($this->latitude)) * sin(deg2rad($a->latitude)) +  cos(deg2rad($this->latitude)) * cos(deg2rad($a->latitude)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        return $miles * 0.868976;
	}
}
