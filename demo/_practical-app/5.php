<?php include "functions.php"; ?>
<?php include "includes/header.php";?>
	<section class="content">

		<aside class="col-xs-4">
		<?php Navigation();?>
			
			
		</aside><!--SIDEBAR-->


<article class="main-content col-xs-8">

	
  <?php 
  
  $number = 100;
  echo sqrt($number);

  echo "<br>";

  $string = "I am the stringest";
  echo strtoupper($string);

  echo "<br>";

  $array = [10,6,3,8,4,2,"Arnold","Tyrone"];
  sort($array);
  print_r($array);

/*  Step1: Use a pre-built math function here and echo it



	Step 2:  Use a pre-built string function here and echo it


	Step 3:  Use a pre-built Array function here and echo it

 */

	
?>





</article><!--MAIN CONTENT-->
<?php include "includes/footer.php"; ?>