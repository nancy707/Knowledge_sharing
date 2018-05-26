<?php
session_start();
include_once 'dbconnect.php';

//set validation error flag as false
$error = false;
mysqli_select_db($con,'jobs');
if(isset($_SESSION['usr_id'])){
	$id = $_SESSION['usr_id'];

//echo $id;
if (isset($_POST['submit'])) {
			//file upload
			header("Location:edited.php");

			/*	if(mysqli_query($con, "INSERT INTO credentials(upload_file) VALUES('".$filename."') where id =".$id)) {
					echo'<center>Successfully Edited</center>';
				}else{
					echo '<center>Error in editing</center>';*/
				}}
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
				 ?>
      </ul>
    </div>
  </nav> <!--end of header -->
<div class="container" style="width:480px; height:500px;">
		<form name="edituserprofile" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<div class="form-group">
				<label for="mobile">Resume Title</label>
				<input name="headline" type="text" class="form-control"  placeholder="i.e. PHP developer with 5 years of experience!">
			</div>
			<div class="form-group">
				<div class="form-group">

					<label for="exampleFormControlFile1">Upload Resume</label>
					<input type="file" class="form-control-file" name="uploaded_file">
					Formats: doc, docx, rtf, pdf.
				</div>
			</div>
			<div class="">
					<button type="submit" name="submit">Register</button>
			</div>
		</form>
	</div>}
	</body>
</html>
