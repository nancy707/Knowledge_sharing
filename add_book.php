<?php
session_start();
include_once 'dbconnect.php';

//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['add'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $author = mysqli_real_escape_string($con, $_POST['author']);
    $cat = mysqli_real_escape_string($con, $_POST['cat']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    if(isset($_SESSION['usr_id'])){
      $uid=$_SESSION['usr_id'];
    }

    //name can contain only alpha characters and space
    if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
        $error = true;
        $name_error = "Name must contain only alphabets and space";
    }

    if (!$error) {
		mysqli_select_db($con,'books');
    $result = mysqli_query($con, "SELECT * FROM credentials WHERE id = " . $uid);
    $row = mysqli_fetch_array($result);
    $dept=$row[5];

		if(mysqli_query($con, "INSERT INTO book_details(name,author,category,price,uid,dept) VALUES('" . $name . "', '" . $author . "', '" . $cat . "','" . $price . "','". $uid ."','". $dept ."')")) {

		/*$result = mysqli_query($con, "SELECT * FROM credentials WHERE email = '" . $email. "'");
		$row = mysqli_fetch_array($result);
		$uid=$row[0];
		mysqli_query($con, "INSERT INTO users(uid,bid) VALUES(" . $uid . ", '" . $name . "')");*/
			$successmsg = "Successfully Registered!";
			unset($name);

      header("Location:registered.php");
        } else {
            $errormsg = "Error in adding book...Please try again later!";
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
        if( isset( $_SESSION['login_status']) ){
          echo '<li><a href="add_book.php"><span class="glyphicon glyphicon-plus"></span> Add Book</a></li>';
         echo '<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
       }
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
              												<input name="name" type="text" class="form-control" placeholder="Enter book's full name" required value="<?php if($error) echo $name; ?>">
                                      <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>

                                    </div>
              											<div class="form-group">
              												<label>Author</label>
              												<input name="author" type="text" class="form-control" placeholder="Enter author's name">
                                      <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>

                                    </div>

              											<div class="form-group">
              												<label name="cat" >Category</label>
              												<select class="form-control" name="cat">
              														 <option value="technical">Technical</option>
                                           <option value="notes">Lecture notes</option>
                                           <option value="journal">Journal</option>
                                           <option value="novel">Novel</option>
                                           <option value="bio">Biography</option>

              												</select>
              											</div>
                                    <div class="form-group">
                                      <label>Price</label>
                                      <input name="price" type="text" class="form-control" placeholder="Enter price">

                                    </div>
              											<!---<div>
              												<input name="Submit" type="submit" class="btn btn-orange" value="Sign Up">
              											</div>
              											<br>
                                  -->
              									</div>
              								</div>


                    <div class="">
                        <button type="submit" name="add">Add</button>
                    </div>
            </form>
            <!--<span class=""><?php if (isset($successmsg)) { 		header("Location:jobs.php"); } ?></span>-->
            <span class=""><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
        </div>
    </div>

</div>
</body>
</html>
