<?php
	class information 
	{
		private $destination;
		private $nb_traveler;
		private $insurance;
		private $listTravelers;
		
		public function __construct($dest, $nb_place, $insurance) 
		{ 
		   $this->destination = $dest;  
		   $this->nb_traveler = $nb_place;
		   $this->insurance = $insurance;
		}
		
		public function get_destination()  
		{  
		   return $this->destination ;  
		} 
	
		public function get_traveler()  
		{  
		   return $this->nb_traveler;  
		}
		
		public function get_insurance()
		{
			return $this->insurance;
		}
		
	}