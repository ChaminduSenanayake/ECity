<?php
    session_start();
    include '../../db/connection.php';
    $_SESSION['search-billNumber']="";
    $_SESSION['search-accNumber']="";
    if(isset($_POST['btn-search'])){
        $_SESSION['search-billNumber']=$_POST['search-billNumber'];
        $_SESSION['search-accNumber']=$_POST['search-accNumber'];
    } 
?>
<html>

    <head>
        <style> 
            th{
                padding:10px;
                background-color: #ABA26F;
            }
            td{
                background-color: #F8F4DB  ;
                padding:5px;
                width: 150px;
            }
            input{
                width:200px;
                margin-right:20px;
            }
            button{
                border:none;
                width:100px;
                height:30px;
                background-color: #8A8A8A ;
                color:white;
            }

        </style>
   </head>
    <body>
        <form action="viewBills.php" method="post">
            <input type="text" name="search-billNumber" placeholder="Search By Bill Number">
            <input type="text" name="search-accNumber"  placeholder="Search By account Number">
            <button name="btn-search" >search</button>
        <br>
        </form>
        <table>
            <tr>
                <th>Bill Number</th>
                <th>Account Number</th>
                <th>Billing Cycle</th>
                <th>Units</th>
                <th>Total Units Charge</th>
                <th>Fixed Charge</th>
                <th>Total Amount</th>
            </tr>
            <?php 
                $billNumber=$_SESSION['search-billNumber'];
                $accNumber=$_SESSION['search-accNumber'];
                $sql ="select * from bill;";
                if($billNumber!="" and $accNumber==""){
                    $sql ="select * from bill where billNumber='$billNumber';";
                }else if($billNumber=="" and $accNumber!=""){
                    $sql ="select * from bill where accountNumber='$accNumber';";
                }else if($billNumber!="" and $accNumber!=""){
                    $sql ="select * from bill where accountNumber='$accNumber' and billNumber='$billNumber';";
                }
                
                $result = mysqli_query($conn,$sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$row['billNumber']."</td><td>".$row['accountNumber']."</td><td>".$row['billingCycle']."</td><td>".$row['units']."</td><td>".$row['totalUnitsCharge']."</td><td>".$row['fixedCharge']."</td><td>".$row['totalAmount']."</td>";
                        echo "</tr>";
                    }
                }
                $_SESSION['search-billNumber']="";
                $_SESSION['search-accNumber']="";
              ?>
           </table>
    </body>
</html>
