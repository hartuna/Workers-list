<?php

class Worker{

	private $name;
	private $surname;
	private $experience;
	private $days = 0;
	private $bonus = 0;

	public function __construct($name, $surname, $experience){
		$this->name = $name;
		$this->surname = $surname;
		$this->experience = $experience;
	}

	public function experienceBonus(){
		$this->days = (strtotime(date('Y-m-d')) - strtotime($this->experience)) / (3600 * 24);
		while($this->days > 180){
			$this->bonus += 5;
			$this->days -= 180;
		}
		$this->bonus /= 100;
		return $this->bonus;
	}

}

class Agreement{

	private $agreement;
	private $salaryBase;
	private $workTimePerDay;
	private $salary;
	private $contribution;

	public function __construct($agreement, $salaryBase, $workTimePerDay){
		$this->agreement = $agreement;
		$this->salaryBase = $salaryBase;	
		$this->workTimePerDay = $workTimePerDay;	
	}

	public function salary(){
		if($this->workTimePerDay == 4){
			$this->salary = $this->salaryBase * 0.5;
		}
		else if($this->workTimePerDay == 6){
			$this->salary = $this->salaryBase * 0.75;
		}
		else if($this->workTimePerDay == 8){
			$this->salary = $this->salaryBase;
		}
		return $this->salary;
	}

	public function contributions(){
		if($this->agreement == 'UOP'){
			$this->contribution = 28;
		}
		else if($this->agreement == 'UZ' || $this->agreement == 'UD'){
			$this->contribution = 18;
		}
		$this->contribution /= 100;
		return $this->contribution;
	}

}

?>