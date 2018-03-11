<?php

if (isset($_POST['submit'])) {
$minimum = 5;
$maximum = 10;

$name = array("Edwin", "Student", "Peter", "Samid", "Mohad", "Maria", "Jane", "tom");
$username = $_POST['username'];
$password = $_POST['password'];

  if(strlen($username) < $minimum) {
    echo "Username has to be longer than five";
  }

    if(strlen($username) > $maximum) {
    echo "Username cannot be longer than 10";
  }

  if(!in_array($username, $name)) {
    echo "Sorry you are not allowed";
  } else {
    echo "Welcome";
  }


//  echo "Hello " . $username;
//  echo "<br>";
//  echo "You password is " . $password;
}

?>