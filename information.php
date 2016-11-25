<?php
	class information 
	{
		private $Destination;
		private $NombrePlaces;
		private $insurance;
		private $listTravelers;
		
		public function __construct($dest, $nb_place, $insurance) 
		{ 
		   $this->Destination = $dest;  
		   $this->NombrePlaces = $nb_place;
		   $this->insurance = $insurance;
		   $this->listTravelers = array();
		}
		
		public function get_destination()  
		{  
		   return $this->Destination ;  
		} 
	
		public function get_traveler()  
		{  
		   return $this->NombrePlaces;  
		}
		
		public function get_insurance()
		{
			return $this->insurance;
		}
		
		public function get_list()
		{
			return $this->listTravelers;
		}

	}