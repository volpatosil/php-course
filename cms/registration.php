<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<?php 

require 'vendor/autoload.php';

$dotenv = new \Dotenv\Dotenv(__DIR__);
$dotenv->load();

$options = array(
  'cluster' => 'eu',
  'encrypted' => true
);

$pusher = new Pusher\Pusher(getenv('APP_KEY'), getenv('APP_SECRET'), getenv('APP_ID'), $options);


if(isset($_POST['register'])) {

  $username = trim($_POST['username']);
  $email    = trim($_POST['email']);
  $password = trim($_POST['password']);

  $error = [
    'username'=>'',
    'email'=>'',
    'password'=>''
  ];

  if (strlen($username) < 4) {
    $error['username'] = 'Username needs to be longer';
  }

  if (strlen($username) == '') {
    $error['username'] = 'Username cannot be empty';
  }

  if (strlen($username) == '') {
    $error['username'] = 'Username cannot be empty';
  }
  if (username_exists($username)) {
    $error['username'] = 'Username already exists. Pick another one.';
  } 
  if ($email == '') {
    $error['email'] = 'Email cannot be empty';
  }
  if (email_exists($email)) {
    $error['email'] = 'Email already exists, <a href="index.php">please login</a>';
  } if ($password == '') {
    $error['password'] = 'Password cannot be empty';
  }

  foreach ($error as $key => $value) {
    if(empty($value)) {
      unset($error[$key]);
    }
  } // foreach 

  if(empty($error)) {
    register_user($username, $email, $password);

    $data['message'] = $username;

    $pusher->trigger('notifications', 'new_user', $data);

    login_user($username, $password);

  }
}


?>

<!-- Navigation -->

<?php  include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container">

  <section id="login">
    <div class="container">
      <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
          <div class="form-wrap">
            <h1>Register</h1>
            <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
              <div class="form-group">
                <label for="username" class="sr-only">username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" required autocomplete="on" value="<?php echo isset($username) ? $username: '' ?>">
                <p><?php echo isset($error['username']) ? $error['username'] : '' ?></p>
              </div>
              <div class="form-group">
                <label for="email" class="sr-only">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" autocomplete="on" value="<?php echo isset($email) ? $email : '' ?>">
                <p><?php echo isset($error['email']) ? $error['email'] : '' ?></p>
              </div>
              <div class="form-group">
                <label for="password" class="sr-only">Password</label>
                <input type="password" name="password" id="key" class="form-control" placeholder="Password" required>
                <p><?php echo isset($error['password']) ? $error['password'] : '' ?></p>
              </div>

              <input type="submit" name="register" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
            </form>

          </div>
        </div>
        <!-- /.col-xs-12 -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
  </section>


  <hr>



  <?php include "includes/footer.php";?>