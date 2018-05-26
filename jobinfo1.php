<?php
session_start();
?>
<html>
<head>
<!--<link rel="stylesheet" href="css/hostelinfo.css">-->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/hostels.css">
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
  </head>
  <body>

    <nav class="navbar navbar-inverse navbar-static-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php"><img class="logo" src="images/job.png" alt="logo" /></a>
        </div>
        <ul class="nav navbar-nav">
          <li><a href="jobs.php">Home</a></li>
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
    </nav>

<?php
//session_start();
include_once 'dbconnect.php';
//check if form is submitted
//if (isset($_POST['login'])) {
	mysqli_select_db($con,'jobs');
if(isset($_REQUEST['cid'])){
    $cid = $_REQUEST['cid'];
	}
		$result = mysqli_query($con, "SELECT * FROM job WHERE cid=".$cid);
		if(mysqli_num_rows($result) > 0){ // if one or more rows are returned do following
			while($row = mysqli_fetch_array($result)){
		$res = mysqli_query($con, "SELECT * FROM company WHERE cid=".$cid);
		$result2=mysqli_fetch_array($res);
		$jname=$row[1];
    $location=$row[2];
    $salary=$row[3];
    $experience=$row[4];

		$cname=$result2[1];
		$category=$result2[2];
		$email=$result2[3];
		$contact=$result2[4];
		echo '<div class="container">
        <div class="hostel-card">
        <img src="https://picsum.photos/200/200/?random" class="hostel-img" />
		<h3 class="hostel-name">'.$jname.'</h3>
		<h3>'.$cname.'</h3>
		<h4>Work: '.$category.'</h4>
		<h4>Location: '.$location.'</h4>
		<h4>Salary: '.$salary,'</h4>
		<p class="inc-size">Experience: '.$experience.' years </p>
		<p class="inc-size">Email address: '.$email.' </p>
		<p class="inc-size">Contact: '.$contact.' </p>';
if(isset($_SESSION['login_status'])){
    if($_SESSION['login_status']=="logged_in"){
    echo '
		  <button  onclick="myFunction()">Apply</button></div>
		</div>';}}
    else{
    echo '
    <button  onclick="myFunction2()">Register</button>
</div>
  </div>';
}
}}
?>
<script type="text/javascript">
function myFunction(){
	window.location="apply.php";
}
</script>
<script>
function myFunction2(){
	window.location="register3.php";
}
</script>
</body>
</html>
