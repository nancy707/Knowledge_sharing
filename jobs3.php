<?php
	session_start();
   $con =  mysqli_connect("localhost", "root", "") or die("Error connecting to database: ".mysql_error());
    mysqli_select_db($con,"testdb") or die(mysql_error());
	$uid=$_SESSION['usr_id'];

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
	        <a class="navbar-brand" href="index.php"><img class="logo" src="images/job.png" alt="logo" /></a>
	      </div>
	      <ul class="nav navbar-nav">
	        <li><a href="index.php">Home</a></li>
	        <li><a href="faqs.php">FAQs</a></li>
	        <li><a href="sitemap.php">Sitemap</a></li>
	        <li><a href="contact.php">Contact</a></li>
					<li><a href="cancel_reg.php">Cancel application</a></li>
	      </ul>
				<ul class="nav navbar-nav navbar-right">
          <li style="color: white"><a href="edituserprofile1.php"><span class="glyphicon glyphicon-user"></span> <?php echo  $_SESSION['usr_name']; ?></a></li>
          <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
        </ul>
	    </div>
	  </nav>


	<form class="form relative" id="jobs-filter" action="/jobsearch" accept-charset="UTF-8" method="get">
	<input name="utf8" type="hidden" value="✓">
	<div class="job-filter">
	<div class="job-filter-title">Date Posted</div>
	<div class="job-filter-content">
	<ul class="field">
	<li>
	<input type="radio" name="posted" id="posted_1" value="1">
	<label for="posted_1">24 hours</label>
	</li>
	<li>
	<input type="radio" name="posted" id="posted_3" value="3">
	<label for="posted_3">3 days</label>
	</li>
	<li>
	<input type="radio" name="posted" id="posted_7" value="7">
	<label for="posted_7">7 days</label>
	</li>
	<li>
	<input type="radio" name="posted" id="posted_30" value="30" checked="checked">
	<label for="posted_30">30 days</label>
	</li>
	</ul>
	</div>
	</div>
	<div class="job-filter">
	<div class="job-filter-title">Job Type</div>
	<div class="job-filter-content">
	<ul class="field" id="check_emp">
	<li>
	<input type="checkbox" name="front_emp" id="emp_all" value="" checked="checked">
	<label for="emp_all">All</label>
	</li>
	<li>
	<input type="checkbox" name="front_emp" id="emp_jtft" value="jtft">
	<label class="with-span" for="emp_jtft">
	Full-Time Employee
	<span>(8430)</span>
	</label>
	</li>
	<li>
	<input type="checkbox" name="front_emp" id="emp_jtpt" value="jtpt">
	<label class="with-span" for="emp_jtpt">
	Part-Time Employee
	<span>(1)</span>
	</label>
	</li>
	<input type="hidden" name="emp" id="emp">
	</ul>

	</div>
	</div>
	<div class="job-filter" id="filter-categories">
	<div class="job-filter-title">Categories</div>
	<div class="job-filter-content">
	<ul class="field">
	<li>
	<input type="radio" name="filter_category" id="filter_category_other" value="jn010">
	<label class="with-span" for="filter_category_other">
	Other
	<span>(8332)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_category" id="filter_category_information-technology" value="jn008">
	<label class="with-span" for="filter_category_information-technology">
	Information Technology
	<span>(2363)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_category" id="filter_category_sales" value="jn011">
	<label class="with-span" for="filter_category_sales">
	Sales
	<span>(1811)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_category" id="filter_category_management" value="jn037">
	<label class="with-span" for="filter_category_management">
	Management
	<span>(1310)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_category" id="filter_category_business-development" value="jn019">
	<label class="with-span" for="filter_category_business-development">
	Business Development
	<span>(644)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_category" id="filter_category_design" value="jn021">
	<label class="with-span" for="filter_category_design">
	Design
	<span>(623)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_category" id="filter_category_marketing" value="jn009">
	<label class="with-span" for="filter_category_marketing">
	Marketing
	<span>(609)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_category" id="filter_category_engineering" value="jn004">
	<label class="with-span" for="filter_category_engineering">
	Engineering
	<span>(468)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_category" id="filter_category_customer-service" value="jn003">
	<label class="with-span" for="filter_category_customer-service">
	Customer Service
	<span>(416)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_category" id="filter_category_general-business" value="jn006">
	<label class="with-span" for="filter_category_general-business">
	General Business
	<span>(288)</span>
	</label>
	</li>
	<a class="link-blue dn jobs-filter-reset" id="filter-category" href="#">Reset location</a>
	</ul>
	</div>
	</div>

	<div class="job-filter">
	<div class="job-filter-title">States</div>
	<div class="job-filter-content">
	<ul class="field">
	<li>
	<input type="radio" name="filter_state" id="filter_state_karnataka" value="karnataka">
	<label class="with-span" for="filter_state_karnataka">
	Karnataka
	<span>(31)</span>
	</label>
	</li>
	<li><a class="link-blue dn jobs-filter-reset" id="filter-state" href="#">Reset location</a></li>
	<li>
	<input type="radio" name="filter_state" id="filter_state_maharashtra" value="maharashtra">
	<label class="with-span" for="filter_state_maharashtra">
	Maharashtra
	<span>(29)</span>
	</label>
	</li>
	<li><a class="link-blue dn jobs-filter-reset" id="filter-state" href="#">Reset location</a></li>
	<li>
	<input type="radio" name="filter_state" id="filter_state_goa" value="goa">
	<label class="with-span" for="filter_state_goa">
	Goa
	<span>(16)</span>
	</label>
	</li>
	<li><a class="link-blue dn jobs-filter-reset" id="filter-state" href="#">Reset location</a></li>
	<li>
	<input type="radio" name="filter_state" id="filter_state_haryana" value="haryana">
	<label class="with-span" for="filter_state_haryana">
	Haryana
	<span>(10)</span>
	</label>
	</li>
	<li><a class="link-blue dn jobs-filter-reset" id="filter-state" href="#">Reset location</a></li>
	<li>
	<input type="radio" name="filter_state" id="filter_state_rajasthan" value="rajasthan">
	<label class="with-span" for="filter_state_rajasthan">
	Rajasthan
	<span>(4)</span>
	</label>
	</li>
	<li><a class="link-blue dn jobs-filter-reset" id="filter-state" href="#">Reset location</a></li>
	<li>
	<input type="radio" name="filter_state" id="filter_state_tamil-nadu" value="tamil nadu">
	<label class="with-span" for="filter_state_tamil-nadu">
	Tamil Nadu
	<span>(4)</span>
	</label>
	</li>
	<li><a class="link-blue dn jobs-filter-reset" id="filter-state" href="#">Reset location</a></li>
	<li>
	<input type="radio" name="filter_state" id="filter_state_kerala" value="kerala">
	<label class="with-span" for="filter_state_kerala">
	Kerala
	<span>(3)</span>
	</label>
	</li>
	<li><a class="link-blue dn jobs-filter-reset" id="filter-state" href="#">Reset location</a></li>
	<li>
	<input type="radio" name="filter_state" id="filter_state_uttar-pradesh" value="uttar pradesh">
	<label class="with-span" for="filter_state_uttar-pradesh">
	Uttar Pradesh
	<span>(3)</span>
	</label>
	</li>
	<li><a class="link-blue dn jobs-filter-reset" id="filter-state" href="#">Reset location</a></li>
	</ul>
	</div>
	</div>

	<div class="job-filter" id="filter-cities">
	<div class="job-filter-title">City</div>
	<div class="job-filter-content">
	<ul class="field">
	<li>
	<input type="radio" name="filter_city" id="filter_city_bengaluru" value="bengaluru">
	<label class="with-span" for="filter_city_bengaluru">
	Bengaluru
	<span>(2053)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_city" id="filter_city_mumbai" value="mumbai">
	<label class="with-span" for="filter_city_mumbai">
	Mumbai
	<span>(889)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_city" id="filter_city_delhi" value="delhi">
	<label class="with-span" for="filter_city_delhi">
	Delhi
	<span>(712)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_city" id="filter_city_hyderabad" value="hyderabad">
	<label class="with-span" for="filter_city_hyderabad">
	Hyderabad
	<span>(565)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_city" id="filter_city_chennai" value="chennai">
	<label class="with-span" for="filter_city_chennai">
	Chennai
	<span>(552)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_city" id="filter_city_pune" value="pune">
	<label class="with-span" for="filter_city_pune">
	Pune
	<span>(449)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_city" id="filter_city_noida" value="noida">
	<label class="with-span" for="filter_city_noida">
	Noida
	<span>(351)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_city" id="filter_city_gurugram" value="gurugram">
	<label class="with-span" for="filter_city_gurugram">
	Gurugram
	<span>(345)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_city" id="filter_city_ahmedabad" value="ahmedabad">
	<label class="with-span" for="filter_city_ahmedabad">
	Ahmedabad
	<span>(251)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_city" id="filter_city_kolkata" value="kolkata">
	<label class="with-span" for="filter_city_kolkata">
	Kolkata
	<span>(210)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_city" id="filter_city_kochi" value="kochi">
	<label class="with-span" for="filter_city_kochi">
	Kochi
	<span>(118)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_city" id="filter_city_coimbatore" value="coimbatore">
	<label class="with-span" for="filter_city_coimbatore">
	Coimbatore
	<span>(115)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_city" id="filter_city_jaipur" value="jaipur">
	<label class="with-span" for="filter_city_jaipur">
	Jaipur
	<span>(114)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_city" id="filter_city_indore" value="indore">
	<label class="with-span" for="filter_city_indore">
	Indore
	<span>(109)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_city" id="filter_city_sahibzada-ajit-singh-nagar" value="sahibzada ajit singh nagar">
	<label class="with-span" for="filter_city_sahibzada-ajit-singh-nagar">
	Sahibzada Ajit Singh Nagar
	<span>(104)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_city" id="filter_city_thane" value="thane">
	<label class="with-span" for="filter_city_thane">
	Thane
	<span>(83)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_city" id="filter_city_lucknow" value="lucknow">
	<label class="with-span" for="filter_city_lucknow">
	Lucknow
	<span>(77)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_city" id="filter_city_chandigarh" value="chandigarh">
	<label class="with-span" for="filter_city_chandigarh">
	Chandigarh
	<span>(70)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_city" id="filter_city_surat" value="surat">
	<label class="with-span" for="filter_city_surat">
	Surat
	<span>(63)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_city" id="filter_city_thiruvananthapuram" value="thiruvananthapuram">
	<label class="with-span" for="filter_city_thiruvananthapuram">
	Thiruvananthapuram
	<span>(56)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_city" id="filter_city_ghaziabad" value="ghaziabad">
	<label class="with-span" for="filter_city_ghaziabad">
	Ghaziabad
	<span>(52)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_city" id="filter_city_vadodara" value="vadodara">
	<label class="with-span" for="filter_city_vadodara">
	Vadodara
	<span>(48)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_city" id="filter_city_bhubaneswar" value="bhubaneswar">
	<label class="with-span" for="filter_city_bhubaneswar">
	Bhubaneswar
	<span>(35)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_city" id="filter_city_faridabad" value="faridabad">
	<label class="with-span" for="filter_city_faridabad">
	Faridabad
	<span>(33)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_city" id="filter_city_mysuru" value="mysuru">
	<label class="with-span" for="filter_city_mysuru">
	Mysuru
	<span>(32)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_city" id="filter_city_bhopal" value="bhopal">
	<label class="with-span" for="filter_city_bhopal">
	Bhopal
	<span>(31)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_city" id="filter_city_nagpur" value="nagpur">
	<label class="with-span" for="filter_city_nagpur">
	Nagpur
	<span>(30)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_city" id="filter_city_lonavala" value="lonavala">
	<label class="with-span" for="filter_city_lonavala">
	Lonavala
	<span>(27)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_city" id="filter_city_ernakulam" value="ernakulam">
	<label class="with-span" for="filter_city_ernakulam">
	Ernakulam
	<span>(26)</span>
	</label>
	</li>
	<li>
	<input type="radio" name="filter_city" id="filter_city_visakhapatnam" value="visakhapatnam">
	<label class="with-span" for="filter_city_visakhapatnam">
	Visakhapatnam
	<span>(26)</span>
	</label>
	</li>
	<a class="link-blue dn jobs-filter-reset" id="filter-city" href="#">Reset location</a>
	</ul>
	<a class="btn btn-small btn-clear btn-clear-blue btn-block btn-top-small-seperate" id="filter-more-cities" href="#">view more</a>
	</div>
	</div>

	<div class="job-filter col-2 field half-mobile">
	<div class="filter-fixed fixed" style="top: 618px;">
	<div class="col large"><input type="submit" value="Filter jobs" class="btn btn-primary btn-block" id="submit-jobs-filter"></div>
	<div class="col show-mobile"><a class="btn btn-neutral btn-block btn-np" id="cancel-jobs-filter" href="#">Cancel</a></div>
	</div>
	</div>
	</form>
  <script type="text/javascript">
	function fun(hid,uid){

		window.location="jobinfo1.php?hid="+hid+"&uid="+uid;

	}
	</script>
<script type="text/javascript">
function myFunction1(){
	window.location = "cancel_reg.php";
}

</script>
 <!--
  function myFunction(){u
var r = confirm("Are you sure you want to cancel your admission?");
if (r == true) {
    window.location = 'cancel_reg.php';
} else {
   document.location.href = 'login.php';
}
  }
	<!?php-->
	  </body>
</html>
