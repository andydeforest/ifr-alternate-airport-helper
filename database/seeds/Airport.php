<?php

require 'Runway.php';

class Airport {

	/**
	 * ICAO code for the airport
	 *
	 * @var string
	 */
	private $icao;
	/**
	 * FAA identifier for the airport
	 *
	 * @var string
	 */
	private $identifier;
	/**
	 * Airport name
	 *
	 * @var string
	 */
	private $name;
	/**
	 * Airport city
	 *
	 * @var string
	 */
	private $city;
	/**
	 * Airport state
	 *
	 * @var string
	 */
	private $state;
	/**
	 * Airport latitude
	 *
	 * @var float
	 */
	private $latitude;
	/**
	 * Airport longitude
	 *
	 * @var float
	 */
	private $longitude;
	/**
	 * Airport elevation
	 *
	 * @var float
	 */
	private $elevation;
	/**
	 * Type of airport (AIRPORT, HELIPORT, etc)
	 *
	 * @var string
	 */
	private $type;
	/**
	 * FAA region code for the airport
	 *
	 * @var string
	 */
	private $regionCode;
	/**
	 * Airport ownership
	 *
	 * @var string
	 */
	private $ownership;
	/**
	 * ARTCC code for the ARTCC boundary the airport falls within
	 *
	 * @var string
	 */
	private $artcc;
	/**
	 * Boolean representing whether the airport has a control tower or not
	 *
	 * @var bool
	 */
	private $hasControlTower;
	/**
	 * Airport common traffic advisory frequency
	 *
	 * @var string
	 */
	private $ctaf;
	/**
	 * Array of runways for this airport
	 *
	 * @var array
	 */
	private $runways = [];

	/**
	 * Constructor for Airport
	 *
	 * @param string $icao Airport ICAO code
	 * @param string $identifier Airport FAA identifier
	 * @param string $name Airport name
	 * @param string $city Airport city
	 * @param string $county Airport county
	 * @param string $state Airport state
	 * @param float $latitude Airport latitude in DMS format
	 * @param float $longitude Airport longitude in DMS format
	 * @param float $elevation Airport elevation
	 * @param string $type Airport type (AIRPORT, HELIPORT, etc)
	 * @param string $regionCode FAA region code
	 * @param string $ownership Airport owenership body
	 * @param string $artcc Governing ARTCC code
	 * @param boolean $hasControlTower Control tower present at the airport
	 * @param string $ctaf Common traffic advisory frequency for the airport
	 */
	public function __construct(string $icao, string $identifier, string $name, string $city, string $county, string $state, float $latitude, float $longitude, float $elevation, string $type, string $regionCode, string $ownership, string $artcc, bool $hasControlTower, string $ctaf) {
		$this->icao = $icao;
		$this->identifier = $identifier;
		$this->name = $name;
		$this->city = $city;
		$this->county = $county;
		$this->state = $state;
		$this->latitude = $latitude;
		$this->longitude = $longitude;
		$this->elevation = $elevation;
		$this->type = $type;
		$this->regionCode = $regionCode;
		$this->ownership = $ownership;
		$this->artcc = $artcc;
		$this->hasControlTower = $hasControlTower;
		$this->ctaf = $ctaf;
	}
	
	public function addRunway(Runway $rwy) {
		array_push($this->runways, $rwy);
	}

	public function getRunways() {
		return $this->runways;
	}

	/**
	 * Gets the ICAO code for the airport
	 *
	 * @return string Airport ICAO code
	 */
	public function getIcao() {
		return $this->icao;
	}

	/**
	 * Gets the FAA identifier for the airport
	 *
	 * @return string Airport FAA identifier
	 */
	public function getIdentifier() {
		return $this->identifier;
	}

	/**
	 * Gets the name of the airport
	 *
	 * @return string Airport name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Gets the city the airport is in
	 *
	 * @return string Airport city
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * Gets the county the airport is in
	 *
	 * @return string Airport county
	 */
	public function getCounty() {
		return $this->county;
	}

	/**
	 * Gets the state the airport is in
	 *
	 * @return string Airport state
	 */
	public function getState() {
		return $this->state;
	}

	/**
	 * Gets the latitude of the airport in decimal format
	 *
	 * @return float Airport latitude in decimal format
	 */
	public function getLatitude() {
		return $this->latitude;
	}

	/**
	 * Gets the longitude of the airport in decimal format
	 *
	 * @return float Airport longitude in decimal format
	 */
	public function getLongitude() {
		return $this->longitude;
	}

	/**
	 * Gets the elevation of the airport
	 *
	 * @return float Airport elevation
	 */
	public function getElevation() {
		return $this->elevation;
	}

	/**
	 * Gets the type of airport
	 *
	 * @return string Airport type
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * Gets the FAA region code for the airport
	 *
	 * @return string Airport region code
	 */
	public function getRegionCode() {
		return $this->regionCode;
	}

	/**
	 * Gets the ownership of the airport 
	 *
	 * @return string Airport ownership body
	 */
	public function getOwnership() {
		return $this->ownership;
	}

	/**
	 * Gets the ARTCC code for the governing ARTCC body
	 *
	 * @return string ARTCC code
	 */
	public function getArtcc() {
		return $this->artcc;
	}

	/**
	 * Gets whether or not the airport has a control tower
	 *
	 * @return boolean Whether or not the airport has a control tower
	 */
	public function hasControlTower() {
		return $this->hasControlTower;
	}

	/**
	 * Gets common traffic advisory frequency for the airport
	 *
	 * @return string Airport CTAF frequency
	 */
	public function getCtaf() {
		return $this->ctaf;
	}

}