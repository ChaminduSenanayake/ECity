<html>
<?php
        session_start();
        include '../../db/connection.php';
        if(!isset($_SESSION['billNumberForUpdate'])){
            $_SESSION['billNumberForUpdate']="";
        }
        if(isset($_POST['btn-updateBill'])){
            $billNumber= $_SESSION['billNumberForUpdate'];
            $billingCycle=$_POST['billingCycle'];
            $units=(int)$_POST['units'];
            $totalUnitsCharge=(float)$_POST['totalUnitsCharge'];
            $fixedCharge =(float)$_POST['fixedCharge'];
            $totalAmount=(float)$_POST['totalAmount'];
            $sql="update bill set billingCycle='$billingCycle',units='$units',totalUnitsCharge='$totalUnitsCharge',fixedCharge='$fixedCharge',totalAmount='$totalAmount' where billNumber='$billNumber';";
            $result=mysqli_query($conn,$sql);
            if($result){
                $_SESSION['admin_currentPanel']="bills";
                echo '<script>window.top.location.href = "../admin.php"; ;</script>';
                echo '<script> alert("Bill Updated"); </script>';
            }
        }
       
            
        if(isset($_POST['btn-deleteBill'])){
            $billNumber= $_SESSION['billNumberForUpdate'];
            $sql="delete from bill where billNumber='$billNumber';";
            $result=mysqli_query($conn,$sql);
            if($result){
                $_SESSION['admin_currentPanel']="bills";
                echo '<script>window.top.location.href = "../admin.php"; ;</script>';
                echo '<script> alert("Bill Deleted"); </script>';
            }
        }  
        
        if(isset($_POST['btn-searchBill'])){
            $_SESSION['billNumberForUpdate']=$_POST['billNumber'];
        }

        
    ?>

<head>
    <base target="_Self">
    <link rel="stylesheet" href="../../assets/css/updateFrameStyle.css">
</head>

<body>
    <h1>Update Bills</h1>
    <form action="billUpdateFrame.php" method="post" id="form-search">
        Bill Number
        <select name="billNumber">
            <?php 
                $allBills ="select billNumber from bill;";
                $result = mysqli_query($conn,$allBills);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        if($_SESSION['billNumberForUpdate']==$row['billNumber']){
                            echo "<option selected='selected'>".$row['billNumber']."</option>";
                        }else{
                            echo "<option>".$row['billNumber']."</option>";
                        }
                    }
                }
            ?>
        </select>
        <button name="btn-searchBill" id="btn-searchBill" >search</button>
    </form>
    <form method="post" action="billUpdateFrame.php" id="form-update">
        <table>
            <?php 
                $billNumber=$_SESSION['billNumberForUpdate'];
                $view ="select * from bill where billNumber='$billNumber';";
                $result = mysqli_query($conn,$view);
                if (mysqli_num_rows($result)==1) {
                    $row = mysqli_fetch_assoc($result);
                    echo "<tr><th>Account number</th><td><input value=".$row['accountNumber']." disabled></td></tr>";
                    echo "<tr><th>Billing Cycle</th><td><input id='editable' type='month' name='billingCycle' value=".$row['billingCycle']."></td></tr>";
                    echo "<tr><th>Units</th><td><input id='editable' name='units' value=".$row['units']." ></td></tr>";
                    echo "<tr><th>Total Units Charge</th><td><input id='editable' name='totalUnitsCharge' value=".$row['totalUnitsCharge']."></td></tr>";
                    echo "<tr><th>Fixed Charge</th><td><input id='editable' name='fixedCharge' value=".$row['fixedCharge']."></td></tr>";
                    echo "<tr><th>Total</th><td><input id='editable' name='totalAmount' value=".$row['totalAmount']." ></td></tr>";
                    echo "<tr><td colspan='2'><button id='btn-edit' name='btn-updateBill'>Edit</button>";
                    echo "<button id='btn-delete' name='btn-deleteBill'>Delete</button></td></tr>";
                }
            ?>

        </table>
        
        
    </form>
</body>

</html>
