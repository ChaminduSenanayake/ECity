<?php
    session_start();
    include '../db/connection.php';
    if(!isset($_SESSION['admin_currentPanel'])){
        $_SESSION['admin_currentPanel']="users";
    }
    if($_SESSION['userName']==""){
        die(header("Location:../loginPage.php"));
    }else if($_SESSION['userType']=="user"){
        die(header("Location:../loginPage.php"));
    }
    if(isset($_POST['btn-saveUser'])){
        $userName=$_POST['userName'];
        $fullName=$_POST['fullName'];
        $email=$_POST['email'];
        $nic=$_POST['nic'];
        $address=$_POST['address'];
        $tp=$_POST['tp'];
        $userType=$_POST['userType'];
        $password=$_POST['password'];
        $sql="insert into user values('$userName','$fullName','$email','$nic','$address','$tp','$userType','$password');";
        $result=mysqli_query($conn,$sql); 
        if($result){
            echo '<script> alert("User Saved"); </script>';
            $_SESSION['admin_currentPanel']="users";
        }   
    }
    
    

    if(isset($_POST['btn-saveAccount'])){
        $accountNumber=(int)($_POST['accountNumber']);
        $fullName=$_POST['fullName'];
        $nic=$_POST['nic'];
        $address=$_POST['address'];
        $tp=$_POST['tp'];
        $accType=$_POST['accType'];
        $userName=$_POST['userName'];
        $sql="insert into account values('$accountNumber','$fullName','$nic','$address','$tp','$accType','$userName');";
        $result=mysqli_query($conn,$sql);    
        if($result){
            echo '<script> alert("Account Saved"); </script>';
            $_SESSION['admin_currentPanel']="accounts";
        }
    }
    
    

    if(isset($_POST['btn-saveBill'])){
        $billNumber=$_POST['billNumber'];
        $accountNumber=(int)($_POST['accountNumber']);
        $billingCycle=$_POST['billingCycle'];
        $units=(int)($_POST['units']);
        $totalUnitsCharge=(float)($_POST['totalUnitsCharge']);
        $fixedCharge =(float)($_POST['fixedCharge']);
        $totalAmount=(float)($_POST['totalAmount']);
        $sql="insert into bill values('$billNumber','$accountNumber','$billingCycle','$units','$totalUnitsCharge','$fixedCharge','$totalAmount');";
        $result=mysqli_query($conn,$sql);
        if($result){
            echo '<script> alert("Bill Saved"); </script>';
            $_SESSION['admin_currentPanel']="bills";
        }
    }
    
    

    

    
    
?>


<html>

<head>
    <link rel="stylesheet" href="../assets/css/adminStyle.css">
    <script>
    function loadUsersPanel() {
        loadPanel("users-panel", "bill-panel", "accounts-panel");
        setBackgroundColor("btn-User", "btn-account", "btn-bill");

    }

    function loadAccountsPanel() {
        loadPanel("accounts-panel", "users-panel", "bill-panel");
        setBackgroundColor("btn-account", "btn-bill", "btn-User");
    }

    function loadBillPanel() {
        loadPanel("bill-panel", "accounts-panel", "users-panel");
        setBackgroundColor("btn-bill", "btn-User", "btn-account");
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

    function logOut() {
        location.href = "../loginPage.php";

    }
    </script>
</head>

<body>
    <div class="dashboard">
        <h2><?php echo $_SESSION['userName'] ?></h2>
        <h4 onclick="logOut()">log out</h4>
        <button id="btn-User" onclick="loadUsersPanel()">Users</button>
        <button id="btn-account" onclick="loadAccountsPanel()">Accounts</button>
        <button id="btn-bill" onclick="loadBillPanel()">Bill</button>
    </div>

    <div class="users-panel" id="users-panel">
        <form method="post" action="admin.php" id="form-add">
            <h1>Create a new user</h1>
            <table>
                <tr>
                    <th>User Name</th>
                    <td><input name="userName" type="text"></td>
                </tr>
                <tr>
                    <th>Full Name</th>
                    <td><input name="fullName" type="text"></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input name="email" type="text"></td>
                </tr>
                <tr>
                    <th>NIC number</th>
                    <td><input name="nic" type="text"></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><input name="address" type="text"></td>
                </tr>

                <tr>
                    <th>Telephone </th>
                    <td><input name="tp" type="text"></td>
                </tr>

                <tr>
                    <th>User Type</th>
                    <td>
                        <select name="userType" id="userType">
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Password</th>
                    <td><input name="password" type="text"></td>
                </tr>
            </table>
            <button id="btn-cancel" onclick="location.reload();">Cancel</button>
            <button id="btn-save" name="btn-saveUser">Save</button>
        </form>
        <div class="div-view">
            <h1>All Users</h1>
            <div>
                <table>
                    <tr>
                        <th>User Name</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>NIC</th>
                        <th>Address</th>
                        <th>Telephone</th>
                        <th>User Type</th>
                    </tr>
                    <?php 
                            $viewAll ="select * from user;";
                            $result = mysqli_query($conn,$viewAll);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>".$row['userName']."</td><td>".$row['fullName']."</td><td>".$row['email']."</td><td>".$row['NIC']."</td><td>".$row['address']."</td><td>".$row['telephone']."</td><td>".$row['type']."</td>";
                                    echo "</tr>";
                                }
                            }
                        ?>
                </table>
            </div>
        </div>                   
        <iframe src="updateFrames/userUpdateFrame.php" frameborder="0" scrolling="no"></iframe>            
    </div>

    <div class="accounts-panel" id="accounts-panel">
        <form method="post" action="admin.php" id="form-add">
            <h1>Create a new account</h1>
            <table>
                <tr>
                    <th>Account Number</th>
                    <td><input name="accountNumber" type="text"></td>
                </tr>
                <tr>
                    <th>Full Name</th>
                    <td><input name="fullName" type="text"></td>
                </tr>
                <tr>
                    <th>NIC number</th>
                    <td><input name="nic" type="text"></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><input name="address" type="text"></td>
                </tr>

                <tr>
                    <th>Telephone </th>
                    <td><input name="tp" type="text"></td>
                </tr>

                <tr>
                    <th>account Type</th>
                    <td>
                        <select name="accType" id="accType">
                            <option value="Domestic">Domestic</option>
                            <option value="Industrial">Industrial</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>User Name</th>
                    <td><input name="userName" type="text"></td>
                </tr>
            </table>
            <button id="btn-cancel" onclick="location.reload();">Cancel</button>
            <button id="btn-save" name="btn-saveAccount">Save</button>
        </form>
        <div class="div-view">
            <h1>All Accounts</h1>
            <div>
                <table>
                    <tr>
                        <th>Account Number</th>
                        <th>Full Name</th>
                        <th>NIC</th>
                        <th>Address</th>
                        <th>Telephone</th>
                        <th>Account Type</th>
                        <th>User Name</th>
                    </tr>
                    <?php 
                            $viewAll ="select * from account;";
                            $result = mysqli_query($conn,$viewAll);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>".$row['accountNumber']."</td><td>".$row['fullName']."</td><td>".$row['NIC']."</td><td>".$row['address']."</td><td>".$row['telephone']."</td><td>".$row['accType']."</td><td>".$row['userName']."</td>";
                                    echo "</tr>";
                                }
                            }
                        ?>
                </table>
            </div>
        </div>
        <iframe src="updateFrames/accountUpdateFrame.php" frameborder="0" scrolling="no"></iframe>                     
    </div>


    <div class="bill-panel" id="bill-panel">
        <form method="post" action="admin.php" id="form-add">
            <h1>Make a new Bill</h1>
            <table>
                <tr>
                    <th>Bill Number</th>
                    <td><input name="billNumber" type="text"></td>
                </tr>
                <tr>
                    <th>Account Number</th>
                    <td><input name="accountNumber" type="text"></td>
                </tr>
                <tr>
                    <th>Billing Cycle</th>
                    <td><input name="billingCycle" type="month"></td>
                </tr>
                <tr>
                    <th>units</th>
                    <td><input name="units" type="number"></td>
                </tr>
                <tr>
                    <th>Total Units Charge</th>
                    <td><input name="totalUnitsCharge" type="text"></td>
                </tr>
                <tr>
                    <th>Fixed Charge</th>
                    <td><input name="fixedCharge" type="text"></td>
                </tr>

                <tr>
                    <th>Total Amount</th>
                    <td><input name="totalAmount" type="text"></td>
                </tr>
            </table>
            <button id="btn-cancel" onclick="location.reload();">Cancel</button>
            <button id="btn-save" name="btn-saveBill">Save</button>
        </form>
        <div class="div-view">
            <h1>All Bills</h1>
            <iframe id="viewFrame" name="viewFrame" src='billFrames/viewBills.php' scrolling='no'></iframe>
        </div>
        <iframe src="updateFrames/billUpdateFrame.php" frameborder="0" scrolling="no"></iframe>
    </div>
    <?php
        $currentPanel=$_SESSION['admin_currentPanel'];
        if($currentPanel=="users"){
            echo "<script>loadUsersPanel();</script>";
        }else if($currentPanel=="accounts"){
            echo "<script>loadAccountsPanel();</script>";
        }else if($currentPanel=="bills"){
            echo "<script>loadBillPanel();</script>";
        }
    ?>
</body>

</html>