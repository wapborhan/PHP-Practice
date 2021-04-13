<?php include "inc/header.php"; ?>


<?php 

class Person{
		public $name;
		public $age;

	    public function personName(){
	    	echo "Person Name is:".$this->name."<br/>";
	   }

	  public function personAge($value){
	  		echo "Person Age is:".$this->age=$value;

	   }
  }

$personOne = new Person;
$personOne->name="Ariful Islam";
$personOne->personName();

$personOne->personAge("18");




?>

	






<?php include "inc/footer.php"; ?>