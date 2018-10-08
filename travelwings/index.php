

<html>
<head>
<title>Travelwings</title>
<link rel="stylesheet" type="text/css" href="css/home.css"> 
<script src="js/home.js"></script>
<style>
button{
  background:#1AAB8A;
  color:#fff;
  border:none;
  position:relative;
  height:60px;
  font-size:1.6em;
  padding:0 2em;
  cursor:pointer;
  transition:800ms ease all;
  outline:none;
}
button:hover{
  background:#fff;
  color:#1AAB8A;
}
button:before,button:after{
  content:'';
  position:absolute;
  top:0;
  right:0;
  height:2px;
  width:0;
  background: #1AAB8A;
  transition:400ms ease all;
}
button:after{
  right:inherit;
  top:inherit;
  left:0;
  bottom:0;
}
button:hover:before,button:hover:after{
  width:100%;
  transition:800ms ease all;
}

</style>
</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
 <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img src="images/logo.png" alt="Apartment Ratings"></a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="home.php">Search Flights</a></li>
                     <li><a href="home.php">Log In</a></li>
            <li><a href="home.php">Sign Up</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

	<?php
    echo"</br></br></br></br></br>";
include"index.html"; include"index1.html";

?>
	<!-- ********** HEADER ********** -->
	<img src ="images/plane.jpg" width="1600" height="600">

	<!-- ********** GREEN - SECTION ********** -->
	<div id="g">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					
					<h4>Who We Are</h4>
					<p>Travelwings.com is a Dubai based privately owned leading Online travel agency with over 25 years of experience in the Travel Industry. The company is driven by the vision to take customers through a journey without boundaries or limitations.</p>
				</div>
				<div class="col-md-4">
					
					<h4>What We Mean</h4>
					<p>Simply put, we are a brand that exudes excitement, triggers joy and happiness and works diligently towards customer satisfaction with utmost transparency. What you see is what you get.</p>
				</div>
				<div class="col-md-4">
					
					<h4>Contact Us</h4>
					<p><b>Office Address:</b><br />
Shop No F11B,Nester Square, Airport City<br />
Phone: 0302 218000<br />
Email: <a mailto="ghana.care@travelwings.com">ghana.care@travelwings.com.gh</a>  </p>
				</div>
			</div><!--/row -->
		</div><!--/container -->
	</div><!--/G -->
		<!-- ********** SIDE IMAGE - SECTION ********** -->
	<section class="about-side-image"></section>
<div class="container">
  
  <div class="row">
  <div class="col-md-8">
<img class="background-image img-responsive" alt="Background Image" src="http://upload.wikimedia.org/wikipedia/commons/5/58/BlankMap-USA.png"></div>
  <div class="col-md-4"><h1>Welcome to Travelwings.com.gh</h1>
<p class="lead">Want to fly affordably to more than 100 destinations in Europe? Book a flight with Travelwings</p></div>
</div>
  
  
  
  
		</div><!--/container -->
	</section><!--Side Image Section -->
	
	

	
	<!-- ********** WHITE SECTION - CTA ********** -->
	<section id="contact"></section>
	<div class="container">
		<div class="row mtb2">
			<div class="col-md-8 col-md-offset-2 centered">
				
				<h2 class="bold mb" id="searchText">Start booking<br/>your flight now!</h2>
				<a class="btn btn-conf btn-green" href="home.php">Book Now!</a>
			</div>
		</div><!--/row -->
	</div><!--/container -->
	
	<!-- ********** FOOTER ********** -->
	<div id="f">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 centered">
          <nav class="footer-nav more-nav">
          <p style="color: white;">Copyright &copy; 2018 Travelwings All Rights Reserved
Design by Group 8 of the HCI class</p>
          </nav>
				</div>
			</div>
		</div>
	</div><!--/F -->

</html>
