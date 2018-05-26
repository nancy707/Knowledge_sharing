<?php
session_start();
include_once 'dbconnect.php';

//check if form is submitted
if (isset($_POST['login'])) {
	mysqli_select_db($con,'books');

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $result = mysqli_query($con, "SELECT * FROM credentials WHERE email = '" . $email. "'");
		$row = mysqli_fetch_array($result);
		$hash = $row[3];
//echo strlen($hash);
//$hash = substr( $hash, 0, 60 );

//echo password_verify($password,$hash);
if (password_verify($password, $hash)){
   // if ($row = mysqli_fetch_array($result)) {
        $_SESSION['usr_id'] = $row['id'];
	   //echo "login";
        $_SESSION['usr_name'] = $row['name'];
				$_SESSION['login_status']="logged_in";
		header("Location: jobs.php");

    } else {
        $errormsg = "Incorrect Email or Password!!!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Job Recommendations</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/hostels.css">
</head>
<body>

  <!-- add header -->
  <nav class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php"><img class="logo" src="images/job.png" alt="logo" /></a>
      </div>
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>
        <li><a href="faqs.php">FAQs</a></li>
        <li><a href="sitemap.php">Sitemap</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
				<?php
				if ( isset( $_SESSION['usr_name']) )
					 echo '<li style="color: white"><a href="edituserprofile1.php"><span class="glyphicon glyphicon-user"></span>'.$_SESSION['usr_name'].'</a></li>';
				else
				 echo '<li><a href="register3.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>';
				if( isset( $_SESSION['login_status']) )
				 echo '<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
				else
				 echo '<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
				 ?>
      </ul>
    </div>
  </nav> <!--end of header -->

<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
  <div class="container" style="width:480px; height:500px;">
    <div class="">
        <label for="name">Email</label>
        <input type="text" name="email" placeholder="Enter Email" name="uname" required class="form-control" />
    </div>

    <div class="">
        <label for="name">Password</label>
        <input type="password" name="password" placeholder="Password" name="psw" required class="form-control" />
    </div>
<br>
		<div class="">
				<button type="submit" name="login">Login</button>
		</div><br>

		<div class="text-danger text-center"><?php if (isset($errormsg)) { echo $errormsg; } ?></div>
  </div>

</form>


    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">
        New User? <a href="register3.php">Sign Up Here</a>
        </div>

</div>

</body>
</html>
