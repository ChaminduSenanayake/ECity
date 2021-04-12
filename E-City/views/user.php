<?php 
    session_start();
    include '../db/connection.php';
    $_SESSION['accNumberForViewBills']="";
    if(isset($_SESSION['user_currentPanel'])){
        $_SESSION['user_currentPanel']="userDetails";
    }
    if($_SESSION['userName']==""){
        die(header("Location:../loginPage.php"));
    }else if($_SESSION['userType']=="admin"){
        die(header("Location:../loginPage.php"));
    }
    if(isset($_POST['btn-updateUser'])){
        $userName= $_SESSION['userName'];
        $email=$_POST['email'];
        $tp=$_POST['telephone'];
        $sql="update user set email='$email',telephone='$tp' where userName='$userName';";
        $result=mysqli_query($conn,$sql); 
        if($result){
                echo '<script> alert("User Updated"); </script>';
                $_SESSION['user_currentPanel']="userDetails";
        }
    }
    if(isset($_POST['btn-viewBills'])){
        $_SESSION['accNumberForViewBills']=$_POST['accountNumber']; 
        $_SESSION['user_currentPanel']="bills";
        
    }
    if(isset($_POST['btn-savePassword'])){
        $userName= $_SESSION['userName'];
        $oldPassword=$_POST['oldPassword'];
        $newPassword=$_POST['newPassword'];
        $confirmed=$_POST['confirmedPassword'];
        if($confirmed==$newPassword){
            $sql="update user set password='$newPassword' where userName='$userName';";
            $result=mysqli_query($conn,$sql); 
            if($result){
                echo '<script> alert("Password Changed"); </script>';
                $_SESSION['user_currentPanel']="changePassword";
            }
        }
    }
?>
<html>
    
    <head>
        <link href="../assets/css/userStyle.css" rel="stylesheet">
        
    </head>

    <body>
    <script>
       
        function swapToEdit(){
            document.getElementById("telephone").disabled=false;
            document.getElementById("email").disabled=false;
            document.getElementById("telephone").style.borderBottom="1px solid black";
            document.getElementById("email").style.borderBottom="1px solid black";
            document.getElementById("edit-img").style.display="none";   
            document.getElementById("btn-updateUser").style.display="block"; 
            document.getElementById("btn-cancel").style.display="block"; 
        }
              
        function loadBillPanel() {
            loadPanel("bills-panel","changePassword-panel","detail-panel");
            setBackgroundColor("btn-Bill","btn-changePassword","btn-userDetails");
        }
        function loadDetailPanel() {
            loadPanel("detail-panel", "bills-panel","changePassword-panel");
            setBackgroundColor("btn-userDetails","btn-Bill","btn-changePassword");
        }
        function loadChangePasswordPanel() {
            loadPanel("changePassword-panel", "detail-panel", "bills-panel");
            setBackgroundColor("btn-changePassword", "btn-Bill", "btn-userDetails");
        }

        function loadPanel(view, hide1, hide2) {
            document.getElementById(hide1).style.display = "none";
            document.getElementById(hide2).style.display = "none";
            document.getElementById(view).style.display = "block";
        }

        function setBackgroundColor(btn1, btn2, btn3) {
            document.getElementById(btn1).style.backgroundColor = "#844EA3";
            document.getElementById(btn2).style.backgroundColor = "#513561";
            document.getElementById(btn3).style.backgroundColor = "#513561";
        }

        function logOut(){
                 location.href ="../loginPage.php";
                
        }

    </script>
        <div class="dashboard">
            <h2><?php echo $_SESSION['userName'] ?><h2>
            <h4 onclick="logOut()">log out</h4>
            <button id="btn-userDetails" onclick="loadDetailPanel()">User Details</button>
            <button id="btn-Bill" onclick="loadBillPanel()">Bills</button>
            <button id="btn-changePassword" onclick="loadChangePasswordPanel()">Change Password</button>
            
        </div>

        <div class="bills-panel" id="bills-panel">
            <h1>User Bills</h1>   
            <form action="user.php" method="post">
                <span>Account number<span> <select name="accountNumber">    
                <?php 
                    $userName= $_SESSION['userName'];
                    $userAccounts ="select accountNumber from account where userName='$userName';";
                    $result = mysqli_query($conn,$userAccounts);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<option>".$row['accountNumber']."</option>";
                        }
                    }
                ?>
                </select>
                <button name="btn-viewBills">View Bills</button>
            </form>               
            <iframe id="viewFrame" name="viewFrame"src='billFrames/viewUserBills.php' scrolling='no'></iframe>
        </div>

        <div class="detail-panel" id="detail-panel">
            <h1>User Account Details</h1>
            <form action="user.php" method="post">
                <table>
                    <?php 
                        $userName= $_SESSION['userName'];
                        $user ="select * from user where userName='$userName';";
                        $result = mysqli_query($conn,$user);
                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result) ;
                            echo "<tr><th>Full Name</th><td><input value=".$row['fullName']." disabled></td></tr>";
                            echo "<tr><th>Email</th><td><input type='email' name='email' id='email' value='".$row['email']."' disabled></td></tr>";
                            echo "<tr><th>NIC</th><td><input value='".$row['NIC']."' disabled></td></tr>";
                            echo "<tr><th>Address</th><td><input value='".$row['address']."' disabled></td></tr>";
                            echo "<tr><th>Telephone Number</th><td><input name='telephone' id='telephone' value='".$row['telephone']."' disabled></td></tr>";
                            echo "<tr><th>User Type</th><td><input value='".$row['type']."' disabled></td></tr>";
                        }
                    ?>
                </table>
                    
                <img id="edit-img" src="../assets/images/edit.png" onclick="swapToEdit()">
                <button id="btn-cancel" onclick="location.reload();">Cancel</button>
                <button name="btn-updateUser" id="btn-updateUser">Save</button>
            </form>
            

            <div>
                <table>
                    <tr>
                        <th>Account Number</th>
                        <th>Full Name</th>
                        <th>NIC</th>
                        <th>Address</th>
                        <th>Telephone</th>
                        <th>Account Type</th>
                    </tr>
                    <?php 
                        $userName= $_SESSION['userName'];
                        $viewAll ="select * from account where userName='$userName';";
                        $result = mysqli_query($conn,$viewAll);
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>".$row['accountNumber']."</td><td>".$row['fullName']."</td><td>".$row['NIC']."</td><td>".$row['address']."</td><td>".$row['telephone']."</td><td>".$row['accType']."</td>";
                                echo "</tr>";
                            }
                        }
                    ?>
                </table>
            </div>
        </div>

        
        <div id="changePassword-panel" class="changePassword-panel">
            <h1>Change Password</h1><br>
            <form action="user.php" method="post">
                <h5>Old Password</h5><input name="oldPassword" type="password">
                <h5>New Password</h5><input name="newPassword" type="password">
                <h5>Confirmed-Password</h5><input name="confirmedPassword" type="password"><br><br>
                <button id="btn-save" name="btn-savePassword">Save</button>
                <button id="cancel" onclick="location.reload();">Cancel</button>
            </form>
        </div>
      
        <?php
            $currentPanel=$_SESSION['user_currentPanel'];
            if($currentPanel=="userDetails"){
                 echo "<script>loadDetailPanel();</script>";
            }else if($currentPanel=="bills"){
                echo "<script>loadBillPanel();</script>";
            }else if($currentPanel=="changePassword"){
                echo "<script>loadChangePasswordPanel();</script>";
            }
        ?>                    
    </body>
</html>		