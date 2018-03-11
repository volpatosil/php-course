<?php include "functions.php"; ?>
<?php 

class Dog {
  var $name = "Ringo";
  var $eyeColor = "Black";
  var $nose = 1;
  var $fur = "Golden";
  function ShowAll() {
    echo "Name: " . $this->name;
    echo "<br>";
    echo "Eye Color: " . $this->eyeColor;
    echo "<br>";
    echo "Nose-size: " . $this->nose;
    echo "<br>";
    echo "Fur color: " . $this->fur;
  }
}

$pitbull = new Dog();
$pitbull->name = "Boxer";
$pitbull->nose = 2;
$pitbull->fur = "Grey";

?>

<?php include "includes/header.php";?>
<section class="content">

	<aside class="col-xs-4">

		<?php Navigation();?>
			
			
	</aside><!--SIDEBAR-->

<article class="main-content col-xs-8">

<?php

$pitbull->ShowAll();

?>
	
	<?php  

	/*  Step 1: Use the Make a class called Dog

		Step 2: Set some properties for Dog, Example, eye colors, nose, or fur color

		Step 4: Make a method named ShowAll that echos all the properties

		Step 5: Instantiate the class / create object and call it pitbull

Step 6: Call the method ShowAll

	

		
	*/
	
	?>





</article><!--MAIN CONTENT-->

<?php include "includes/footer.php"; ?>