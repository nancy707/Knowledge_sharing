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
    if (!$error) {
		mysqli_select_db($con,'books');
	$hash = password_hash($password, PASSWORD_DEFAULT);
  $mob = mysqli_real_escape_string($con, $_POST['mobile']);
  $dept = mysqli_real_escape_string($con, $_POST['dept']);


		if(mysqli_query($con, "INSERT INTO credentials(name,email,password,contact,dept) VALUES('" . $name . "', '" . $email . "', '" . $hash . "','" . $mob . "','" . $dept . "')")) {

		//$result = mysqli_query($con, "SELECT * FROM credentials WHERE email = '" . $email. "'");
		//$row = mysqli_fetch_array($result);
		//$uid=$row[0];
		//mysqli_query($con, "INSERT INTO users(uid,name) VALUES(" . $uid . ", '" . $name . "')");
			$successmsg = "Successfully Registered!";
			unset($name);
			unset($email);
			unset($pass);

      header("Location:registered.php");
        } else {
            $errormsg = "Error in registering...Please try again later!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Job Recommendation</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/hostels.css">
</head>
<body>

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


<div class="container" style="width:480px; height:500px;">
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
              												<input name="email" type="email" class="form-control" placeholder="Enter your active email id">
                                      <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>

                                    </div>
              											<div class="form-group">
              												<label for="password" class="control-label">Password</label>
              												<input name="password" type="password" class="form-control" placeholder="Minimum 6 characters">
                                      <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>

                                    </div>
                                    <div class="form-group">
                                        <label for="password">Confirm Password</label>
                                        <input type="password" name="cpassword" placeholder="Confirm Password" required class="form-control" />
                                        <span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
                                    </div>

              											<div class="form-group">
              												<label for="mobile">Mobile Number</label>
              												<input name="mobile" type="text" class="form-control" placeholder="Where admin can contact you">
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

              											<!---<div>
              												<input name="Submit" type="submit" class="btn btn-orange" value="Sign Up">
              											</div>
              											<br>
                                  -->
              									</div>
              								</div>


                    <div class="">
                        <button type="submit" name="signup">Register</button>
                    </div>
            </form>
            <!--<span class=""><?php if (isset($successmsg)) { 		header("Location:registered.php"); } ?></span>-->
            <span class=""><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">
        Already Registered? <a href="login.php">Login Here</a>
        </div>
    </div>
</div>
</body>
</html>
