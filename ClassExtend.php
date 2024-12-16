class.Person.php
<?php
	class Person {
		private $name;
		private $dob;
		
		function __construct($name, $dob) {
			$this->name = $name;
			$this->dob = $dob;	
		}
		
		public function get_name() {
			return $this->name;
		}
		
		public function get_dob() {
			return $this->dob;
		}
		
		public function get_age() {
			//Calculate age
			$dob = new Datetime($this->dob);
			$today = new Datetime(date('Y-m-d'));
			$age = $today->diff($dob);
			
			//Return Age in Years
			return $age->y;
		}
	}
    ?>

    --------------------------------------------------------------------------------

class.Student.php
<?php

require_once( 'class.Person.php' );

class Student extends Person {
	private $gpa;
	private $major;
	private $address;

	public function __construct( $name, $dob, $address, $major = 'Undeclared' ) {
		parent::__construct( $name, $dob );
		$this->address = $address;
		$this->major = $major;

		$this->gpa = null;
	}

	public function get_address() {
		return $this->address;
	}

	public function get_major() {
		return $this->major;
	}

	public function get_gpa() {
		return $this->gpa;
	}
	
	public function set_address( $address ) {
		$this->address = $address;
	}

	public function set_major( $major ) {
		$this->set_major = $major;
	}

	public function set_gpa( $gpa ) {
		$this->gpa = $gpa;
	}

	public function calculate_gpa( $grades, $credits ) {
		$this->set_gpa( $grades / $credits );
		return $this->gpa;
	}

}