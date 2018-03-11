<?php include "functions.php"; ?>

<?php

  $connection = mysqli_connect("localhost","root","root","practical-database");

  // Check connection
  if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

  $query = "SELECT * FROM practical_table";
  $result = mysqli_query($connection, $query);

  if(!$result) {
    die('Query FAILED' . msqli_error());
  }


?>

<?php include "includes/header.php";?>
    

	<section class="content">

		<aside class="col-xs-4">

		<?php Navigation();?>
			
			
		</aside><!--SIDEBAR-->


	<article class="main-content col-xs-8">
	
  <?php 
  echo "<br>";
  while($row = mysqli_fetch_assoc($result)) {
    echo "<br>";
    /* print_r($row); */
    echo $row[problem] . ": " . $row[number];
  }
  ?>
	
  <?php  
  


	/*  Step 1 - Create a database in PHPmyadmin

		Step 2 - Create a table like the one from the lecture

		Step 3 - Insert some Data

		Step 4 - Connect to Database and read data

*/
	
	?>





</article><!--MAIN CONTENT-->

<?php include "includes/footer.php"; ?>
