<?php


class Runway {

	/**
	 * Runway identifier
	 *
	 * @var string
	 */
	private $identifier;
	/**
	 * Runway length to the nearest foot
	 *
	 * @var integer
	 */
	private $length;
	/**
	 * Runway width to the nearest foot
	 *
	 * @var integer
	 */
	private $width;
	/**
	 * Runway approach markings
	 *
	 * @var string
	 */
	private $markings;

	/**
	 * Constructor for Runway
	 *
	 * @param string $identifier Runway identifier (09/27)
	 * @param integer $length Runway length to nearest foot
	 * @param integer $width Runway width to nearest foot
	 * @param string $markings Runway markings
	 */
	public function __construct($identifier, $length, $width, $markings) {
		$this->identifier = $identifier;
		$this->length = $length;
		$this->width = $width;
		$this->markings = $markings;
	}

	/**
	 * Gets the identifier for the runway (Ex: 09/27)
	 *
	 * @return string Runway identifier
	 */
	public function getIdentifier() {
		return $this->identifier;
	}

	/**
	 * Gets the runway length to the nearest foot
	 *
	 * @return integer Runway legnth in feet
	 */
	public function getLength() {
		return $this->length;
	}

	/**
	 * Gets the runway width to the nearest foot
	 *
	 * @return integer Runway width in feet
	 */
	public function getWidth() {
		return $this->width;
	}

	/**
	 * Gets the type of runway markings
	 *
	 * @return string Runway markings
	 */
	public function getMarkings() {
		return $this->markings;
	}

}