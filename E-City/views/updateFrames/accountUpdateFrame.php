<html>
<?php
        session_start();
        include '../../db/connection.php';
        if(!isset($_SESSION['accountNumberForUpdate'])){
            $_SESSION['accountNumberForUpdate']="";
        }
        if(isset($_POST['btn-updateAccount'])){
            $accountNumber= $_SESSION['accountNumberForUpdate'];
            $tp=$_POST['telephone'];
            $userName=$_POST['userName'];
            $sql="update account set telephone='$tp',userName='$userName' where accountNumber='$accountNumber';";
            $result=mysqli_query($conn,$sql);
            if($result){
                $_SESSION['admin_currentPanel']="accounts";
                echo '<script>window.top.location.href = "../admin.php"; ;</script>';
                echo '<script> alert("Account Updated"); </script>';
            }
        }
       
            
        if(isset($_POST['btn-deleteAccount'])){
            $accountNumber= $_SESSION['accountNumberForUpdate'];
            $sql="delete from account where accountNumber='$accountNumber';";
            $result=mysqli_query($conn,$sql);
            if($result){
                $_SESSION['admin_currentPanel']="accounts";
                echo '<script>window.top.location.href = "../admin.php"; ;</script>';
                echo '<script> alert("Account Deleted"); </script>';
            }
        } 
        
        if(isset($_POST['btn-searchAcc'])){
            $_SESSION['accountNumberForUpdate']=$_POST['accountNumber'];
        }

        
    ?>

<head>
    <link rel="stylesheet" href="../../assets/css/updateFrameStyle.css">
</head>

<body>
    <h1>Update Accounts</h1>
    <form action="accountUpdateFrame.php" method="post" id="form-search">
        Account Number
        <select name="accountNumber">
            <?php 
                    $allaccountNumbers ="select accountNumber from account;";
                    $result = mysqli_query($conn,$allaccountNumbers);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if($_SESSION['accountNumberForUpdate']==$row['accountNumber']){
                                echo "<option selected='selected'>".$row['accountNumber']."</option>";
                            }else{
                                echo "<option>".$row['accountNumber']."</option>";
                            }
                        }
                    }
            ?>
 
        </select>
        <button name="btn-searchAcc" id="btn-searchAcc">search</button>
    </form>
    <form method="post" action="accountUpdateFrame.php" id="form-update">

        <table>
            <?php 
                $accNumber=$_SESSION['accountNumberForUpdate'];
                $view ="select * from account where accountNumber='$accNumber';";
                $result = mysqli_query($conn,$view);
                if (mysqli_num_rows($result)==1) {
                    $row = mysqli_fetch_assoc($result);
                    echo "<tr><th>Full Name</th><td><input value=".$row['fullName']." disabled></td></tr>";
                    echo "<tr><th>NIC</th><td><input value=".$row['NIC']." disabled></td></tr>";
                    echo "<tr><th>Address</th><td><input value=".$row['address']." disabled></td></tr>";
                    echo "<tr><th>Telephone</th><td><input id='editable' name='telephone' value=".$row['telephone']."></td></tr>";
                    echo "<tr><th>Account Type</th><td><input value=".$row['accType']." disabled></td></tr>";
                    echo "<tr><th>User Name</th><td><input id='editable' name='userName' value=".$row['userName']."></td></tr>";
                    echo "<tr><td colspan='2'><button id='btn-edit' name='btn-updateAccount'>Edit</button>";
                    echo "<button id='btn-delete' name='btn-deleteAccount'>Delete</button></td></tr>";
                }
            ?>

        </table>


    </form>
</body>

</html>