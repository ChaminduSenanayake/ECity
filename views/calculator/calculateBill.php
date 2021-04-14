<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="../../assets/css/calStyle.css">
        <link rel="stylesheet" href="../../assets/css/navBarStyle.css">
    </head>
    <body>
        <?php
            if(isset($_GET['msg']) && $_GET['msg']==2){
            echo '<script>  alert("Empty fields can not be added") </script>';
            }
        ?>
        <div class="topnav" id="myTopnav">
            <a href="../../index.php #" ><h4>Home</h4></a>
            <a href="../../index.php #services"><h4>Services</h4></a>
            <a href="../../index.php #contact"><h4>Contact us</h4></a>
            <a href="../../index.php #about"><h4>About us</h4></a>
            <a class="btn-nav" href="../../loginPage.php"><h3 id="btn-nav-text">Log In</h3></a>
	    </div>
        <form method="POST"action="calculate.php"> 
            <div class="mid-box">
                <h3 id="title">Calculate Your Bill Here</h3>
                <table>
                    <tr>
                        <td><h5>Category<h5></td>
                        <td>
                            <select name="category" style="width: 122px">
                                <option>Residential</option>
                                <option>Hotel</option>
                                <option>Religious</option>
                                <option>Industrial</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><h5>Number of Unites<h5></td>
                        <td><input style="width: 120px" type="number" name="units"></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <button id="btn-cal" name="cal">Calculate</button>
                            <button id="btn-reset" name="reset">Reset</button> 
                        </td>
                    </tr>
                </table>
                <br>
                <?php
                    if(isset($_GET['msg']) && $_GET['msg']!=2 && isset($_GET['type'])){
                        echo '<table>
                                <tr>
                                    <td> <h5> Units:</h5></td><td><h5 id="setvalo">'.$_GET['used'].'</h5> </td>
                                </tr>
                                <tr>
                                    <td> <h5> Price:</h5></td><td><h5 id="setvalo">Rs. '.$_GET['msg'].'/=</h5> </td>
                                </tr>
                                <tr> 
                                    <td> <h5> Type:</h5></td><td><h5 id="setvalo">'.$_GET['type'].'</h5> </td>
                                </tr>
                                <tr>  
                                    <td> <h5> Tax:</h5></td><td><h5 id="setvalo">'.$_GET['tax'].'</h5> </td>
                                </tr>  
                            </table>';
                    }
                ?>
            </div>
        </form>
    </body>
</html>