<?php
	class traveler
	{
		private $name;
		private $age;
		
		public function __construct($name, $age) 
		{ 
		   $this->name = $name; 
		   $this->age = $age;
		}
		
		public function get_name()  
		{  
		   return $this->name;  
		}
		
		public function get_age()  
		{  
		   return $this->age;  
		}

	}
?>