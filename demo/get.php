<?php 

  print_r($_GET);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  
<?php

  $id = 10;
  $button = "CLICK HERE NOW";

?>

<a href="get.php?id=<?php echo $id; ?>"><?php echo $button; ?></a>

</body>
</html>