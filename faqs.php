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
         ?>
      </ul>
    </div>
  </nav> <!--end of header -->
	<center><h1>FAQs</h1></center>
  <pre style="margin-left:200px;margin-right:250px;font-family:Sans-Serif"><strong>
Q:  Is registration on the JobsPortal free?
A:  Yes. Registration is free for job seekers and job advertisers. Register here

Q:  I'm new to theJobsPortal. How can I register for free?
A:  To register for free as a Job Seeker click here

        Complete all the required information(indicated with *) then click on the "Create new account" button

Q:  How does the JobsPortal work for job seekers?
A:  Registered Job Seekers can subscribe to job adverts and job categories.
        You will also have an on CV profile that can be searched by job advertisers and employers.
        We advise job seekers to complete their online CV profile so that they can be included in our website's Job Seeker Search.
      </strong></pre>
  </body>
</html>
