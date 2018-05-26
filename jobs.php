<?php
include_once 'dbconnect.php';
		session_start();
    mysqli_select_db($con,"books") or die(mysql_error());
		if(isset($_SESSION['usr_id'])){
			$uid=$_SESSION['usr_id'];
		}

?>
<html>
  <head>
    <title>Job Recommendations</title>
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
          <a class="navbar-brand" href="jobs.php"><img class="logo" src="images/job.png" alt="logo" /></a>
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
 					 if( isset( $_SESSION['login_status']) ){
						 echo '<li><a href="add_book.php"><span class="glyphicon glyphicon-plus"></span> Add Book</a></li>';
					 	echo '<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
					}
 					 else
					 	echo '<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
						?>

        </ul>
      </div>
    </nav>

    <div class="container">

			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
          <!--<input type="text" name="query" />
          <input type="submit" value="Search" />-->
					<div style="width:1000px; height:100px;">
						<h3>Search through</h3>
					<!--<input style="width:200px"id="txtKeywords" name="keywords" type="text" placeholder="Enter "/>-->
					<!--<input id="txtLocation" name="location" type="text" placeholder="Enter Location"/>-->
					<h4>Category</h4>
					<select name="cat">
						<option value="0">Any</option>
						<option value="technical">Technical</option>
						<option value="notes">Lecture notes</option>
						<option value="journal">Journal</option>
						<option value="novel">Novel</option>
						<option value="bio">Biography</option>

					</select>&nbsp;
					<h4>Department</h4>
					<select name="dept">
						<option value="0">Any</option>
						<option value="CP">Computer Engineering</option>
						<option value="IT">Information Technology</option>
						<option value="ME">Mechanical Engineering</option>
						<option value="MC">Mechantronics</option>
						<option value="CL">Civil Engineering</option>
						<option value="EC">Electronics and communication</option>


					</select>&nbsp;
					<br><br>
					<button type="submit" name="search" onclick="javascript:setAClickOnSearch();">Search</button>
					</div>
      </form>
			<?php
							if(isset($_GET['search'])){
						 // $keyword = $_GET['keywords'];
						 	if(isset($_GET['dept'])!=0 || isset($_GET['cat'])!=0){
							if(isset($_GET['dept']) && $_GET['cat']==0){
							/*	$val = $_GET['dept'];
								$dept="";
								if($val==1)$dept="CP";
								if($val==2)$dept="IT";
								if($val==3)$dept="ME";
								if($val==4)$dept="MC";
								if($val==5)$dept="CL";
								if($val==6)$dept="EC";
*/
								$dept=$_GET['dept'];

								$min_length = 1;
						    if(strlen($dept) >= $min_length){
						        $dept = htmlspecialchars($dept);
										$raw_results = mysqli_query($con,"SELECT * FROM `book_details` where (`dept` LIKE '".$dept."')");

						        if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following


						     		while($results = mysqli_fetch_array($raw_results)){
											$uid=$results['uid'];
											$res = mysqli_query($con, "SELECT * FROM credentials WHERE id=".$uid);
											$result2=mysqli_fetch_array($res);
											$name=$results[1];
									    $author=$results[2];
									    $category=$results[3];
									    $price=$results[4];

											$uname=$result2[1];

											echo '<div class="container">
									        <div class="hostel-card">
									        <img src="https://picsum.photos/200/200/?random" class="hostel-img" />
											<h2 class="hostel-name">'.$name.'</h3>
											<h4>Added by: '.$uname.'</h3>
											<h4>Author: '.$author.'</h4>
											<h4>Category: '.$category.'</h4>
											<h4>Price: '.$price,'</h4>
											<button  onclick="myFunction()">Apply</button>
											</div>
											</div>';


										unset($_POST['dept']);
						            }
									//echo '<a href = "hostels3.php"><button id = "clear" type="button">Clear</button></a>';

						        }

							}}

					if(isset($_GET['cat']) && $_GET['dept']==0){
							/*$val = $_GET['cat'];
						$t="";
						if($val==1)$t="technical";
						if($val==2)$t="notes";
						if($val==3)$t="journal";
						if($val==4)$t="novel";
						if($val==5)$t="bio";*/
						$t=$_GET['cat'];

						$min_length = 1;
						if(strlen($t) >= $min_length){
								$t = htmlspecialchars($t);
								$raw_results = mysqli_query($con,"SELECT * FROM `book_details` where (`category` LIKE '".$t."')") or die(mysql_error());

								if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following


								while($results = mysqli_fetch_array($raw_results)){
									$uid=$results['uid'];
									$res = mysqli_query($con, "SELECT * FROM credentials WHERE id=".$uid);
									$result2=mysqli_fetch_array($res);
									$name=$results[1];
									$author=$results[2];
									$category=$results[3];
									$price=$results[4];

									$uname=$result2[1];

									echo '<div class="container">
											<div class="hostel-card">
											<img src="https://picsum.photos/200/200/?random" class="hostel-img" />
									<h2 class="hostel-name">'.$name.'</h3>
									<h4>Added by: '.$uname.'</h3>
									<h4>Author: '.$author.'</h4>
									<h4>Category: '.$category.'</h4>
									<h4>Price: '.$price,'</h4>
									<button  onclick="myFunction()">Apply</button>
									</div>
									</div>';
							}}}}
}
}
else{
			$raw_results = mysqli_query($con, "SELECT * FROM book_details") or die(mysql_error());

			if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following


			while($results = mysqli_fetch_array($raw_results)){
				$uid=$results['uid'];
				$res = mysqli_query($con, "SELECT * FROM credentials WHERE id=".$uid);
				$result2=mysqli_fetch_array($res);
				$name=$results[1];
				$author=$results[2];
				$category=$results[3];
				$price=$results[4];

				$uname=$result2[1];

				echo '<div class="container">
						<div class="hostel-card">
						<img src="https://picsum.photos/200/200/?random" class="hostel-img" />
				<h2 class="hostel-name">'.$name.'</h3>
				<h4>Added by: '.$uname.'</h3>
				<h4>Author: '.$author.'</h4>
				<h4>Category: '.$category.'</h4>
				<h4>Price: '.$price,'</h4>
				<button  onclick="myFunction()">Apply</button>
				</div>
				</div>';
}
}}
		//	echo '<a href = "hostels3.php"><button id = "clear" type="button">Clear</button></a>';
?>


    </div>
  <script type="text/javascript">
	function fun(cid){

		window.location="jobinfo1.php?cid="+cid;

	}
	</script>
	  </body>
</html>
