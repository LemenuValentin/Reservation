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

  public function setPrice($newPrice)
  {
	$this->Price = $newPrice;
	}
  public function getDestination()
  {
    return $this->Destination;
  }

  public function setDestination($newDestination)
  {
    $this->Destination = $newDestination;
  }

  public function getinsurance()
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

  public function getNbPlaces()
  {
    return $this->NbPlaces;
  }

   public function setNbPlaces($newplaces)
  {
    $this->NbPlaces = $newplaces;
  }

   public function getName()
  { 
    while (count($this->names) < $this->NbPlaces)
    {
      array_push($this->names, "");
    }
    return $this->names;
  }
  
  public function setName($newname)
  {
    $this->names = $newname;
  }

  public function getAge()
  {
    //Add '' when the input is empty, < 1, or not a number
    while (count($this->ages) < $this->NbPlaces)
    {
      array_push($this->ages, "");
    }
    return $this->ages;
  }
  public function setAge($newage)
  {
    $this->ages = $newage;
  }
  
   public function getCheckbox()
  {
    return $this->checkbox;
  }
  public function setCheckbox($newvaleur)
  {
    if ($newvaleur == 'checked')
    {
      $this->checkbox = 'checked';
    }
    else
    {
      $this->checkbox = '';
    }
  }
  
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
   
   public function HomepageError()
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
	
	public function DetailError()
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
	
	public function setIDedition($newID)
	{
		$this->IDedition = $newID;
	}
	
	public function getIDedition()
	{
	return $this->IDedition;
	}
	
}
?>