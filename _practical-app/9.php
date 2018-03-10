<?php include "functions.php"; ?>

<?php
// Set cookie properties 
$name = "Kage";
$value = "Grela_gode_kager";
$time = time() + 86400 * 7;
setcookie($name, $value, $time);

session_start();
$_SESSION['trouble'] = "ORANG :(";

?>

<?php include "includes/header.php";?>



	<section class="content">

		<aside class="col-xs-4">

		<?php Navigation();?>
			
			
		</aside><!--SIDEBAR-->


			<article class="main-content col-xs-8">
			
		<a href="9.php?id=1&parameter=freedom" class="btn btn-info">Click Here</a>

  <?php

  $g = $_GET;
  $id = $g[id];
  $param = $g[parameter];

  if (isset($id)) {
  echo "Number" . $id . " is: ";
  echo $param;
  echo "<br>";
  }
 

  echo $_SESSION['trouble'];
  ?>


	<?php 

	/*  Create a link saying Click Here, and set 
	the link href to pass some parameters and use the GET super global to see it

		Step 2 - Set a cookie that expires in one week

		Step 3 - Start a session and set it to value, any value you want.
	*/
	
	?>





</article><!--MAIN CONTENT-->
<?php include "includes/footer.php"; ?>