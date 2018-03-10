<?php

if(isset($_POST['submit'])) {

  $username = $_POST['username'];
  $password = $_POST['password'];

  $connection = mysqli_connect('localhost', 'root', 'root', 'loginapp');

  if($connection) {

    echo "We are connected";

  } else {
    
    die("Database connection failed");

  }



/*       if($username && $password) {
        echo $username;
        echo $password;
      } else {
        echo "This field can not be blank";
      } */


}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
    crossorigin="anonymous">

</head>

<body>

  <div class="container">
    <div class="col-sm-6">

      <form action="login.php" method="post">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" class="form-control" placeholder="text">

        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control">

        </div>

        <input class="btn btn-primary" type="submit" name="submit" value="Submit">

      </form>

    </div>
  </div>


</body>

</html>