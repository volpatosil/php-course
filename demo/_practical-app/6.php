
<?php include "functions.php"; ?>
<?php include "includes/header.php";?>

	<section class="content">

		<aside class="col-xs-4">
		
		<?php Navigation();?>
			
		</aside><!--SIDEBAR-->


<article class="main-content col-xs-8">

<form method="POST" action="6.php">
<label for="setning">Write a sentence</label>
<input type="text" id="setning" name="setning" placeholder="ex: Rabbits are great">
<input type="submit" name="submit" value="SUBMIT">


</form>


	<?php  
$setning = $_POST['setning'];
if (isset($_POST['submit'])) {
  echo "Congratulations. You have written this sentence: " . $setning;
} else {
  echo "You have not written a sentence yet :(";
}

/*  Step1: Make a form that submits one value to POST super global


 */

	
?>


</article><!--MAIN CONTENT-->
<?php include "includes/footer.php"; ?>