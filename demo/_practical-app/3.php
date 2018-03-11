<?php include "functions.php"; ?>
<?php include "includes/header.php";?>

	<section class="content">

	<aside class="col-xs-4">

	<?php Navigation();?>
			
	</aside><!--SIDEBAR-->


<article class="main-content col-xs-8">

<?php  
//Step 1
if(1 < 0) {
  echo "I like PHP";
} elseif (2 < 2) {
  echo "I dislike PHP";
} else {
  echo "I love PHP";
}
//Step 2
for($i = 0; $i < 10;$i++) {
  echo "<br>" . $i ;
}

echo "<br>";

$beetle = "John";

switch($beetle) {
  case "Paul":
  echo "Paul McCartney";
  break;
  case "Ringo":
  echo "Ringo Starr";
  break;
  case "John":
  echo "John Lennon";
  break;
  case "George":
  echo "George Harrison";
  break;
  case "Otto":
  echo "Who?";
  break;

  default:
  echo "Not a Beetle";
  break;
}


/*  Step1: Make an if Statement with elseif and else to finally display string saying, I love PHP



	Step 2: Make a forloop  that displays 10 numbers


	Step 3 : Make a switch Statement that test againts one condition with 5 cases

 */

	
?>






</article><!--MAIN CONTENT-->
	
<?php include "includes/footer.php"; ?>