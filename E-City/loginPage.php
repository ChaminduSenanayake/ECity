<?php

session_start();
$_SESSION['userName']="";
$_SESSION['userType']="";
$_SESSION['user_currentPanel']="";
$_SESSION['admin_currentPanel']="";

include 'db/connection.php';
if(isset($_POST['btn-login'])){
	$x=$_POST['Username']; 
	$y=$_POST['Password']; 
	$sql="select * from user where userName='$x' and password='$y';";
	$result=mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)==1){
		$row = mysqli_fetch_assoc($result);
		$_SESSION['userName']=$row['userName'];
		$_SESSION['userType']=$row['type'];
		if($row['type']=="user"){
			header("Location:views/user.php"); 
		}else{
			header("Location:views/admin.php"); 
		}
	}else{
		header("Refresh:0");
		echo "<script>alert('Invalid User name or Password');</script>";
	}
}





?>





<html>
<head>            
 <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <?php 
		require_once 'navBar.php' ;
	?>
	<script>
		document.getElementById("btn-nav-text").innerHTML="";
		document.getElementById("btn-nav-text").style.border="none";
	</script>
    <div class="login-box">
        <h1>LOGIN</h1>
        <form method="POST" action="loginPage.php">
            <input type="text" name="Username" placeholder="Username" onfocus="this.placeholder=''" onblur="this.placeholder='Username'"><br>
            <input type="password" name="Password" placeholder="Password" onfocus="this.placeholder=''" onblur="this.placeholder='Password'"><br>
            <button class="login-btn" name="btn-login" type="submit">Log In</button><br>
            <a href="mailto:abc@gamil.com" id="Forgotten">Forgotten account?</a>
        </form>
    </div>
</body>
</html>



