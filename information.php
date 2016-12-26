<?php

class info
{
	
	private $Destination;
	private $NbPlaces;
	private $names;
	private $ages;
	private $insurance;
	private $checkbox;
	private $totalprice;
	private $Price;
	private $IDedition;

	public function __construct($Destination ="", $NbPlaces="", $names= [], $ages= [])
		{
			$this->Destination = $Destination;
			$this->NbPlaces = $NbPlaces;
			$this->names = $names;
			$this->ages = $ages;
			$this->totalprice = 0;
			$this->IDedition = 0;
		}
	
	//get the destination
	public function getDestination()
		{
			return $this->Destination;
		}
	
	//set the destination
	public function setDestination($new_destination)
		{
			$this->Destination = $new_destination;
		}
	
	//get the number of traveler
	public function getNbPlaces()
		{
			return $this->NbPlaces;
		}
	
	//set the number of traveler
	public function setNbPlaces($new_places)
		{
			$this->NbPlaces = $new_places;
		}
	
	//get the checkbox value
	public function getCheckbox()
		{
			return $this->checkbox;
		}
	
	//set checkbox value -> 'checked' if the check box is checked in homepage
	public function setCheckbox($new_value)
		{
			if ($new_value == 'checked')
			{
				$this->checkbox = 'checked';
			}
			else
			{
				$this->checkbox = '';
			}
		}
		
	//return 'OUI' if the insurance's checkbox is checked, else return 'NON'
	public function getInsurance()
		{
			if ($this->checkbox == 'checked')
			{
				return 'OUI';
			}
			else
			{
				return 'NON';
			}
		}

	//get an array of all traveler's name
	public function getName()
		{ 
			//if the input is empty, add ''
			while (count($this->names) < $this->NbPlaces)
			{
				array_push($this->names, "");
			}
			return $this->names;
		}
		
	//set the name's array
	public function setName($new_name)
		{
			$this->names = $new_name;
		}
	
	//get an array of all traverlet's age
	public function getAge()
		{
			//if the input is empty, add ''
			while (count($this->ages) < $this->NbPlaces)
			{
				array_push($this->ages, "");
			}
			return $this->ages;
		}
	
	//set the age's array
	public function setAge($new_age)
		{
			$this->ages = $new_age;
		}

	//set the price
	public function setPrice($new_price)
		{
			$this->Price = $new_price;
		}
	
	//compute and get the price
	public function getPrice()
		{
			$totalprice = 0;
			foreach ($this->ages as $ages)
			{
				if ($ages <= 12)
				{
					$this->totalprice += 10;
				}
				else
				{
					$this->totalprice += 15;       
				}
			}
			if ($this->checkbox == 'checked')
			{
				return $this->totalprice + 20;
			}
			else
			{
				return $this->totalprice + 0;
			}
		}
	
	//get the price for the database
	public function Price()
		{
			$price = $this->totalprice;
			if ($this->checkbox == 'checked')
			{
				$price += 20;
				return $price;
			}
			else
			{
				$price += 0;
				return $price;
			}
		}
   
	//set the error warning for the homepage
	public function homepageError()
		{
			if(($this->Destination == "") && ($this->NbPlaces == ""))
			{
				return "Vous devez entrer une destination et un nombre de voyageur";
			}
			elseif($this->Destination == "")
			{
				return "Vous devez entrer une destination";
			}
			elseif($this->NbPlaces == "")
			{
				return "Vous devez entrer un nombre de voyageur";
			}
			else
			{
				return "Veuillez compléter le formulaire";
			}
		}
	
	//set the error warning for the detail page
	public function detailError()
		{
			if(in_array("",$this->names) || in_array("",$this->ages))
			{
				return "veuiller compléter entièrement le formulaire";
			}
			else
			{
				return '';
			}
		}
	
	//register the id used in the database
	public function setIDedition($new_id)
		{
			$this->IDedition = $new_id;
		}
	
	//get the id used in the database
	public function getIDedition()
		{
			return $this->IDedition;
		}
	
}
?>