<?php

function imagePlaceholder($image ='') {
  if(!$image) {
    return 'placeholder.jpg';
  } else {
    return $image;
  }
}

function redirect($location)
{
  return header("Location: {$location}");
  exit;
}

function IfItIsMethod($method = null) {
  if($_SERVER['REQUEST_METHOD'] == strtoupper($method)) {
    return true;
  }
  return false;
}

function isLoggedIn() {
  if(isset($_SESSION['user_role'])) {
    return true;
  }
  return false;
}

function checkIfUserIsLoggedInAndRedirect($redirectLocation = null) {
  if(isloggedIn()) {
    redirect($redirectLocation);
  }
}

function escape($string) {
  global $connection;
  return mysqli_real_escape_string($connection, trim($string));

}

function users_online() {

  if(isset($_GET['onlineusers'])) {

  global $connection;

  if(!$connection) {
    session_start();
    include("../includes/db.php");

    $session = session_id();
    $time = time();
    $time_out_in_seconds = 30;
    $time_out = $time - $time_out_in_seconds;


    $query = "SELECT * FROM users_online WHERE session = '$session'";
    $send_query = mysqli_query($connection, $query);
    $count = mysqli_num_rows($send_query);

    if ($count == null) {
      mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time')");
    } else {
      mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
    }
    $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
    echo $count_user = mysqli_num_rows($users_online_query);
    }
  } // get request onlineusers
}

users_online();

function confirm($result) {
  global $connection;
    if(!$result) {
    die("QUERY FAILED" . mysqli_error($connection));
  }
}

function insert_categories() {
global $connection;
  if(isset($_POST['submit'])) {

    $cat_title = $_POST['cat_title'];

    if($cat_title == "" || empty($cat_title)) {
      echo "This field should not be empty";
    } else {
      $stmt = mysqli_prepare($connection, "INSERT INTO categories(cat_title) VALUES(?)");
     
      mysqli_stmt_bind_param($stmt, 's', $cat_title);

      mysqli_stmt_execute($stmt);

      if(!$stmt) {
        die('QUERY FAILED' . mysqli_error($connection));
      }
    }
mysqli_stmt_close($stmt);
  }
}

function findAllCategories() {
global $connection;
  // FIND ALL CATEGORIES QUERY

  $query = "SELECT * FROM categories";
  $select_categories = mysqli_query($connection, $query);

  while($row = mysqli_fetch_assoc($select_categories)) {
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];
    echo "<tr>";
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";
    echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
    echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
    echo "</tr>";
  }
}

function deleteCategories() {
global $connection;
  // DELETE QUERY
  if(isset($_GET['delete'])) {
    $the_cat_id = $_GET['delete'];
    $query = "DELETE FROM categories WHERE cat_id ={$the_cat_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: categories.php");
  }
}

// Retrieves all entries from a MySQL table and return the number of rows
function recordCount($table) {
  global $connection;
  $query = "SELECT * FROM {$table}";
  $select_all_post = mysqli_query($connection, $query);
  $result = mysqli_num_rows($select_all_post);
  confirm($result);
  return $result;
}

function checkStatus($table, $column, $status) {
  global $connection;
  $query = "SELECT * FROM {$table} WHERE {$column} = '{$status}'";
  $result = mysqli_query($connection, $query);
  return mysqli_num_rows($result); 
}

function is_admin($username) {
  global $connection;

  $query = "SELECT user_role FROM users WHERE username = '$username'";
  $result = mysqli_query($connection, $query);
  confirm($result);

  $row = mysqli_fetch_array($result);

  if($row['user_role'] == 'admin') {
    return true;
  } else {
    return false;
  }

}

function username_exists($username) {
  global $connection;

  $query = "SELECT username FROM users WHERE username = '{$username}'";
  $result = mysqli_query($connection, $query);
  confirm($result);

  if(mysqli_num_rows($result) > 0) {
    return true;
  } else {
    return false;
  }

}

function email_exists($email)
{
  global $connection;

  $query = "SELECT user_email FROM users WHERE user_email = '{$email}'";
  $result = mysqli_query($connection, $query);
  confirm($result);

  if (mysqli_num_rows($result) > 0) {
    return true;
  } else {
    return false;
  }

}

function register_user($username, $email, $password) {
global $connection;

$username = escape($username);
$email = escape($email);
$password = escape($password);

$password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

/* $query = "SELECT randSalt FROM users";
$select_randsalt_query = mysqli_query($connection, $query);

if (!$select_randsalt_query) {
  die('Query Failed' . mysqli_error($connection));
} */

/* $row = mysqli_fetch_array($select_randsalt_query);
$salt = $row['randSalt'];
$password = crypt($password, $salt); */

$query = "INSERT INTO users (username, user_email, user_password, user_role) ";
$query .= "VALUES ('{$username}', '{$email}', '{$password}', 'subscriber')";
$register_user_query = mysqli_query($connection, $query) . ' ' . mysqli_errno($connection);

confirm($register_user_query);

}

function login_user($username, $password) {
  global $connection;

  $username = trim(escape($username));
  $password = trim(escape($password));

  $query = "SELECT * FROM users WHERE username = '{$username}' ";
  $select_user_query = mysqli_query($connection, $query);

  if (!$select_user_query) {
    die('QUERY FAILED' . mysqli_error($connection));
  }
  while ($row = mysqli_fetch_array($select_user_query)) {
    $db_user_id         = escape($row['user_id']);
    $db_username        = escape($row['username']);
    $db_user_password   = escape($row['user_password']);
    $db_user_firstname  = escape($row['user_firstname']);
    $db_user_lastname   = escape($row['user_lastname']);
    $db_user_role       = escape($row['user_role']);

    /*   $password = crypt($password, $db_user_password); */
    if (password_verify($password, $db_user_password)) {
      $_SESSION['username'] = $db_username;
      $_SESSION['firstname'] = $db_user_firstname;
      $_SESSION['lastname'] = $db_user_lastname;
      $_SESSION['user_role'] = $db_user_role;
      redirect("/admin");
    } else {
      return false;
    }
  }
  return true;

}

?>