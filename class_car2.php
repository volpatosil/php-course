<?php

class Car {

  function MoveWheels() {
    echo "Wheels move";
  }

}

if(method_exists("Car", "MoveWheels")) {
  echo "The Method Exist";
} else {
  echo "no it does not";
}


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




  
</body>
</html>