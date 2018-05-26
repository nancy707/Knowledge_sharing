<!DOCTYPE html>
<html>
<head><title>Job Recommendations</title>
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
			 echo '<li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>';
			else
			 echo '<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';

			 ?></ul>
    </div>
  </nav> <!--end of header -->
<?php
session_start();
include_once 'dbconnect.php';

//set validation error flag as false
$error = false;
	mysqli_select_db($con,'jobs');
	if(isset($_SESSION['usr_id'])) {
	 $uid= $_SESSION['usr_id'];

	$result = mysqli_query($con, "SELECT upload_file FROM credentials WHERE id = " . $uid);
	$row = mysqli_fetch_array($result);
	$resume = $row['upload_file'];

echo $resume;
	if($resume == 0)
	{
		echo '<center><h3>You have not completed your profile</h3></center>'.'<br>';
		echo '<center><a href="edituserprofile1.php">Edit profile</a></center>';
	}
	else
	{
		echo "You have successfully applied";
	//	$score  = (($percentage*30) + ($distance*70))/100;
		//$query = mysqli_query($con,"INSERT INTO application(score,hid,uid) VALUES(".$score.",".$hid.",".$uid.")");
		header("Location:success.php");

	}}
?>
</body>
</html>
