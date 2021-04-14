<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="assets/css/indexStyle.css">
	</head>
<body>

	<?php 
		require_once 'navBar.php';
	?>

	<div class="main-div">
		<h1>Lighting up Lives<br>  in Sri Lanka</h1><br>
		<button onclick=" location.href = 'views/news/news.php'">NEWS</button>
		<button onclick=" location.href = 'views/calculator/calculateBill.php'">BILL CALCULATOR</button>
	</div>


	<div class="about-div" id="about">
		<h1 >About E-City</h1>
		<p>eLEC is a Company incorporated in 1990 for the purpose of electricity distribution in Sri Lanka. The formation of the company is by acquiring assets of local authorities to create a modern and efficient distribution network. This objective is achieved even above the expectations when evaluated after 29 years of operations. The company has throughout attracted foreign funding from the Asian Development Bank and is highly benefited by the consultancies of utility consultants such as Becca Worely International in setting up their efficient network. LECO as a utility is benchmarked very high in the South East Asian region.
		</p>
		<br><br><br><br>
		<h2>Our Vision</h2>
		<p>Enjoy being the light for lives of people through innovative eco-friendly business</p>
		<br><br><br><br>
		<h2>Our Mission</h2>
		<p>To develop and maintain an efficient, coordinated and economical system of electricity supply to the whole of Sri Lanka, while adhering to our core values</p>
	
	</div>
	<div class="services-div" id="services">
		<h1>SERVICES</h1>
		<div id="firstCard" class="card">
			
			<h1>LOG IN</h1>
			<p >Log in and view your bill online</p><br> 
			<button id="btn-first" onclick=" location.href = 'views/loginPage.php'">Log In</button>
		</div>

		<div id="secondCard" class="card">
			<h1>BILL CALCULATOR</h1>
			<p>Calculate your bill correctly</p><br> 
			<button id="btn-second" onclick=" location.href = 'views/calculator/calculateBill.php'">Calculate</button>
		</div>
	</div>
	
	<div class="footer" id="contact">
        <div>
			<p>We are ............................................</p>
		</div>
		<div class="links-div">
			<h4>Links</h4>
			<a href="index.php #" >Home</a><br><br>
			<a href="index.php #services">Services</a>
			<a href="index.php #about">About us</a>
		</div>  
    	<div class="contacts-div">
			<h4>Contacts</h4> 
			<h5>Address</h5>
			<p>798 South Park Avenue, Jaipur, Raj</p>
			<h5>Email</h5>
			<p>eCity@gmail.com</p>
			<h5>Phone/Fax</h5>
			<p>0912267679</p>
		</div>  
    </div>
	

</body>
</html>
