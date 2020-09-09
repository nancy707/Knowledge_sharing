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
		header("Location: index.php");

    } else {
        $errormsg = "Incorrect Email or Password!!!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Knowledge Sharing Platform</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="stylesheet" href="css/hostels.css">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>
<body id="top">
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row0">
  <div id="topbar" class="hoc clear">
    <!-- ################################################################################################ -->
    <div class="fl_left">
      <ul class="nospace inline pushright">
        <li><i class="fa fa-phone"></i> +00 (123) 456 7890</li>
        <li><i class="fa fa-envelope-o"></i> info@domain.com</li>
      </ul>
    </div>
    <div class="fl_right">
      <ul class="faico clear">
        <li><a class="faicon-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
        <li><a class="faicon-pinterest" href="#"><i class="fa fa-pinterest"></i></a></li>
        <li><a class="faicon-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
        <li><a class="faicon-dribble" href="#"><i class="fa fa-dribbble"></i></a></li>
        <li><a class="faicon-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
        <li><a class="faicon-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
        <li><a class="faicon-rss" href="#"><i class="fa fa-rss"></i></a></li>
      </ul>
    </div>
    <!-- ################################################################################################ -->
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row1">
  <header id="header" class="hoc clear">
    <!-- ################################################################################################ -->
    <div id="logo" class="fl_left">
      <h1><a href="index.php">Knowledge Sharing Platform</a></h1>
    </div>
    <div style="text-align:right">
    <ul class="nospace inline pushright">
      <?php
        if ( isset( $_SESSION['usr_name']) )
           echo '<li><a class="btn" href="edituserprofile1.php"><span class="glyphicon glyphicon-user"></span>'.$_SESSION['usr_name'].'</a></li>';
        else
         echo '<li><a class="btn" href="register3.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>';
        if( isset( $_SESSION['login_status']) ){
          echo '<li><a class="btn inverse" href="add_book.php"><span class="glyphicon glyphicon-plus"></span> Add Book</a></li>';
         echo '<li><a class="btn inverse" href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
       }
        else
         echo '<li><a class="btn inverse" href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
         ?>
    </ul>
</div>
    <!-- ################################################################################################ -->
  </header>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row2">
  <nav id="mainav" class="hoc clear">
    <!-- ################################################################################################ -->
    <ul class="clear">
      <li><a href="index.php">Home</a></li>
      <li><a class="drop" href="#">Departments</a>
        <ul>
					<li><a href="cp.php">Computer Engineering</a></li>
          <li><a href="it.php">Information Technology</a></li>
          <li><a href="me.php">Mechanical Engineering</a></li>
          <li><a href="mc.php">Mechantronics</a></li>
          <li><a href="cl.php">Civil Engineering</a></li>
          <li><a href="ec.php">Electronics and communication</a></li>

        </ul>
      </li>
      <li><a class="drop" href="#">Category</a>
        <ul>
            <li><a class="drop" href="#">Books</a>
            <ul>
              <li><a href="#">Technical books</a></li>
              <li><a href="#">Journals</a></li>
              <li><a href="#">Novels</a></li>
              <li><a href="#">Biographies</a></li>
            </ul>
          </li>
          <li><a href="#">Lecture notes</a></li>
          <li><a href="#">Stationaries</a></li>
        </ul>
      </li>
      <li><a href="about.php">About us</a></li>
      <li><a href="feedback.php">Feedback</a></li>
      <li><a href="contact.php">Contact</a></li>
    </ul>
    <!-- ################################################################################################ -->
  </nav>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper bgded overlay" style="background-image:url('images/demo/backgrounds/stack-of-books.jpg');">
  <div class="hoc clear">
    <!-- ################################################################################################ -->
      <div class="container" style="width:500px; height:500px;">
          <div class="">
              <div class="">
								<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
									<div class="container" style="width:480px; height:500px;">
										<div class="">
												<label for="name">Email</label>
												<input type="text" name="email" placeholder="Enter Email" name="uname" required class="form-control" />
										</div></br>

										<div class="">
												<label for="name">Password</label>
												<input type="password" name="password" placeholder="Password" name="psw" required class="form-control" />
										</div>
								<br>
										<div class="">
												<button style="color:#FFFFFF; background-color:#82B440; border-color:#82B440;"type="submit" name="login">Login</button>
										</div><br>
										<div class="text-danger text-center"><?php if (isset($errormsg)) { echo $errormsg; } ?></div>
									</div>

								</form></div>
          </div>
					<div>
							<div class="col-md-4 col-md-offset-4 text-center">
							New User? </br><a href="register3.php">Sign Up Here</a>
							</div>
					</div>
      </div>
    <!-- ################################################################################################ -->
  </div>
</div>

</body>
</html>
