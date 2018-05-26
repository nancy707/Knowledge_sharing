<!DOCTYPE html>
<html>
<head><title>Job Recommendations</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/hostels.css">
</head>
<body>

  <nav class="navbar navbar-inverse navbar-static-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="jobs.php"><img class="logo" src="images/job.png" alt="logo" /></a>
        </div>
        <ul class="nav navbar-nav">
          <li><a href="hostels3.php">Home</a></li>
          <li><a href="faqs.php">FAQs</a></li>
          <li><a href="sitemap.php">Sitemap</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <?php
          session_start();
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
	<center><h1 style="padding-top: 200px; color: FORESTGREEN ;">Registered successfully!</h1>
	<a href="login.php">Want to login in?</a></center>
  </body>
</html>
