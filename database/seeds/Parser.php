<?php

require 'Airport.php';

class Parser {

	/**
	 * Location of the text file to be parsed
	 *
	 * @var string
	 */
	private $location;

	private $current_airport = null;

	/**
	 * Parser constructor
	 *
	 * @param string $location path to the text file to be parsed
	 */
	public function __construct(string $location = './APT.txt') {
		if(file_exists($location)) {
			$this->location = $location;
		} else {
			throw new Exception('File not found: '.$location);
		}
	}

	/**
	 * Parses each line into an Airport object then fires a callback
	 *
	 * @param function $callback Callback function to be fired after Airport object is parsed
	 * @return void
	 */
	public function forEach($callback) {
		if(($handle = fopen($this->location, 'r')) !== FALSE) {
			while(($line = fgets($handle)) !== false) {
				$types = ['AIRPORT', 'BALLOONPORT', 'SEAPLANE BASE', 'GLIDERPORT', 'HELIPORT', 'ULTRALIGHT'];
				// make sure we're parsing airport row
				if(in_array(trim(substr($line, 14, 13)), $types)) {
					$identifier = $this->parseLine($line, 27, 4);
					$icao = $this->parseLine($line, 1210, 4);
					$name = $this->parseLine($line, 133, 50);
					$city = $this->parseLine($line, 93, 40);
					$type = $this->parseLine($line, 14, 13);
					$regionCode = $this->parseLine($line, 41, 3);
					$state = $this->parseLine($line, 50, 20);
					$county = $this->parseLine($line, 70, 21);
					switch($this->parseLine($line, 183, 2)) {
						case 'PU':
							$ownership = 'PUBLICLY OWNED';
							break;
						case 'PR':
							$ownership = 'PRIVATELY OWNED';
							break;
						case 'MA':
							$ownership = 'AIR FORCE OWNED';
							break;
						case 'MN':
							$ownership = 'NAVY OWNED';
							break;
						case 'MR':
							$ownership = 'ARMY OWNED';
							break;
						case 'CG':
							$ownership = 'COAST GUARD OWNED';
							break;
						default:
							$ownership = 'UNKNOWN';
							break;
					}
					$elevation = floatval($this->parseLine($line, 578, 7));
					$artcc = $this->parseLine($line, 637, 4);
					$controlTower = $this->parseLine($line, 980, 1) === 'Y';
					$ctaf = $this->parseLine($line, 988, 7);
					// N176-38-32.9277W635912.9277
					$lat = $this->dmsToDeci(substr($line, 523, 14));
					$lng = $this->dmsToDeci(substr($line, 550, 15));
					

					$airport = new Airport($icao, $identifier, $name, $city, $county, $state, $lat, $lng, $elevation, $type, $regionCode, $ownership, $artcc, $controlTower, $ctaf);

					$this->current_airport = $airport;

					$callback($airport);

				} else if(substr($line, 0, 3) === 'RWY') {
					// Parse runway info for this airport
					$rwy_id = $this->parseLine($line, 16, 7);
					$rwy_length = intval($this->parseLine($line, 23, 5));
					$rwy_width = intval($this->parseLine($line, 28, 4));

					$rwy_markings = $this->parseLine($line, 304, 5);

					$runway = new Runway($rwy_id, $rwy_length, $rwy_width, $rwy_markings);

					$airport->addRunway($runway);


				} else {
					continue;
				}
		
			}
			fclose($handle);
		}
	}

	/**
	 * Parses a line from a specific location and length, then trims the result
	 *
	 * @param string $line Line to parse
	 * @param integer $start Position to start parsing at
	 * @param integer $length Amount of characters to parse
	 * @return string Parsed, trimmed line
	 */
	private function parseLine(string $line, int $start, int $length) {
		return trim(substr($line, $start, $length));
	}

	/**
	 * Converts coordinates in DMS format to decimal format
	 *
	 * @param string $dms Coordinate in DMS format
	 * @return float Coordinate in decimal format
	 */
	private function dmsToDeci(string $dms) {
		$parse = explode('-', $dms);
		$deg = $parse[0];
		$min = $parse[1];
		$sec = $parse[2];
		// check if last char is N/S or E/W
		$char = substr($sec, strlen($sec) - 1, 1);
	
		$deg = floatval($deg);
		$min = floatval($min);
		$sec = floatval($sec);
	
		$coord = $deg+((($min*60)+($sec))/3600);
	
		// make the coord negative
		if($char == 'S' || $char == 'W') {
			$coord = $coord - ($coord * 2);
		}
		return $coord;
	}
}