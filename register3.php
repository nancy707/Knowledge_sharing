<?php
session_start();
include_once 'dbconnect.php';

//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['signup'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    $mob = mysqli_real_escape_string($con, $_POST['mobile']);
    $dept = mysqli_real_escape_string($con, $_POST['dept']);
    //name can contain only alpha characters and space
    if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
        $error = true;
        $name_error = "Name must contain only alphabets and space";
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $email_error = "Please Enter Valid Email ID";
    }
    if(strlen($password) < 6) {
        $error = true;
        $password_error = "Password must be minimum of 6 characters";
    }
    if($password != $cpassword) {
        $error = true;
        $cpassword_error = "Password and Confirm Password doesn't match";
    }
    if (!preg_match("/^[6-9][0-9]{9}$/",$mob)) {
        $error = true;
        $mob_error = "Mobile number must be of 10 digits";
    }
    if (!$error) {
		mysqli_select_db($con,'books');
	$hash = password_hash($password, PASSWORD_DEFAULT);



		if(mysqli_query($con, "INSERT INTO credentials(name,email,password,contact,dept) VALUES('" . $name . "', '" . $email . "', '" . $hash . "','" . $mob . "','" . $dept . "')")) {

		//$result = mysqli_query($con, "SELECT * FROM credentials WHERE email = '" . $email. "'");
		//$row = mysqli_fetch_array($result);
		//$uid=$row[0];
		//mysqli_query($con, "INSERT INTO users(uid,name) VALUES(" . $uid . ", '" . $name . "')");
			$successmsg = "Successfully Registered!";
			unset($name);
			unset($email);
			unset($pass);

      header("Location:login.php");
        } else {
            $errormsg = "Error in registering...Please try again later!";
        }
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
        <li><i class="fa fa-phone"></i>9428764568</li>
        <li><i class="fa fa-envelope-o"></i>KnowledgeShare@gmail.com</li>
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
      <h1><a href="index.php">e-Share</a></h1>
    </div>
    <div style="text-align:right">
    <ul class="nospace inline pushright">
      <?php
        if ( isset( $_SESSION['usr_name']) );
           else
         echo '<li><a class="btn" href="register3.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>';
        if( isset( $_SESSION['login_status']) ){

          echo '<li><a class="btn" href="self_profile.php?'.$_SESSION['usr_name'].'"><span class="glyphicon glyphicon-user"></span>'.$_SESSION['usr_name'].'</a></li>';

          echo '<li><a class="btn inverse" href="add_book.php"><span class="glyphicon glyphicon-plus"></span> Add Books</a></li>';
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
              <li><a href="technical.php">Technical books</a></li>
              <li><a href="journals.php">Journals</a></li>
              <li><a href="novels.php">Novels</a></li>
              <li><a href="biography.php">Biographies</a></li>
            </ul>
          </li>
          <li><a href="lecture.php">Lecture notes</a></li>
        </ul>
      </li>
      <li><a href="about.php">About us</a></li>
      <li><a href="Feedback1.php">Feedback</a></li>
      <li><a href="contact.php">Contact</a></li>
      <li><a href="faq.php">FAQs</a></li>
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
                  <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform" enctype="multipart/form-data">
                      <div class="col-md-15">
                    									<div class="textblack">


                    											<div class="form-group"><div align="center" style="margin-right:1px"> <span class="ErrorMsg"></span> </div></div>


                    											<div class="form-group">
                    												<label for="name">Name</label>
                    												<input name="name" type="text" class="form-control" placeholder="Enter your full name" required value="<?php if($error) echo $name; ?>">
                                            <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>

                                          </div>
                    											<div class="form-group">
                    												<label for="loginname">Email</label>
                    												<input name="email" type="email" class="form-control" placeholder="Enter your active email id" required value="<?php if($error) echo $email; ?>">
                                            <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>

                                          </div>
                    											<div class="form-group">
                    												<label for="password" class="control-label">Password</label>
                    												<input name="password" type="password" class="form-control" placeholder="Minimum 6 characters" required value="<?php if($error) echo $password; ?>">
                                            <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>

                                          </div>
                                          <div class="form-group">
                                              <label for="password">Confirm Password</label>
                                              <input type="password" name="cpassword" placeholder="Confirm Password" required class="form-control" value="<?php if($error) echo $cpassword; ?>"/>
                                              <span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
                                          </div>

                    											<div class="form-group">
                    												<label for="mobile">Mobile Number</label>
                    												<input name="mobile" type="text" class="form-control" placeholder="Where admin can contact you" required value="<?php if($error) echo $mob; ?>">
                                            <span class="text-danger"><?php if (isset($mob_error)) echo $mob_error; ?></span>
                                          </div>
                    											<div class="form-group">
                    												<label name="dept" >Department</label>
                    												<select class="form-control" name="dept">
                    														 <option value="CP">Computer Engineering</option>
                                                 <option value="IT">Information Technology</option>
                                                 <option value="ME">Mechanical Engineering</option>
                                                 <option value="MC">Mechantronics</option>
                                                 <option value="CL">Civil Engineering</option>
                                                 <option value="EC">Electronics and communication</option>

                    												</select>
                    											</div>
                    									</div>
                    								</div>


                          <div>
                              <button style="color:#FFFFFF; background-color:#82B440; border-color:#82B440;" type="submit" name="signup">Register</button>
                          </div>
                  </form>
                  <?php if (isset($successmsg)) { 	header("Location:registered.php"); } ?></span>
                  <span class=""><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
              </div>
          </div>
          <div class="row">
              <div class="col-md-4 col-md-offset-4 text-center">
              Already Registered? <a href="login.php">Login Here</a>
              </div>
          </div>
      </div>
    <!-- ################################################################################################ -->
  </div>
</div>

<div class="wrapper row4">
  <footer id="footer" class="hoc clear">
    <!-- ################################################################################################ -->
    <div class="one_third first">
      <h6 class="title">Contact us</h6>
      <ul class="nospace linklist contact">
        <li><i class="fa fa-map-marker"></i>
          <address>
          G H Patel College of Engineering and Technology &amp; Anand, 388120
          </address>
        </li>
        <li><i class="fa fa-phone"></i>9428764568<br></li>
        <li><i class="fa fa-envelope-o"></i>KnowledgeShare@gmail.com</li>
      </ul>
    </div>
    <div class="one_third">
      <h6 class="title">Departments</h6>
      <ul class="nospace linklist">
        <li><a href="cp.php">Computer Engineering</a></li>
        <li><a href="it.php">Information Technology</a></li>
        <li><a href="me.php">Mechanical Engineering</a></li>
        <li><a href="mc.php">Mechantronics Engineering</a></li>
        <li><a href="cl.php">Civil Engineering</a></li>
				<li><a href="ec.php">Electronics and communication</a></li>
      </ul>
    </div>
    <div class="one_third">
      <h6 class="title">Stay Updated</h6>
      <p class="btmspace-30">Get mails of newly posted Books and Stationaries.</p>
      <form method="post" action="#">
        <fieldset>
          <legend style="color:#82B440" >Newsletter</legend>
          <input class="btmspace-15" type="text" value="" placeholder="Name">
          <input class="btmspace-15" type="text" value="" placeholder="Email">
          <button type="submit" value="submit">Submit</button>
        </fieldset>
      </form>
    </div>
    <!-- ################################################################################################ -->
  </footer>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row5">
  <div id="copyright" class="hoc clear">
    <!-- ################################################################################################ -->
    <p class="fl_left">Copyright &copy; 2018 - All Rights Reserved - <a href="#">Knowledge Share</a></p>
    <!-- ################################################################################################ -->
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
</body>
</html>
