<?php
    session_start();
    include '../../db/connection.php';
    $_SESSION['search-month']="";
    if(isset($_POST['btn-search'])){
        $_SESSION['search-month']=$_POST['search-month'];
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
                color: white;
            }
            

        </style>
   </head>
    <body>
        
        <form action="viewUserBills.php" method="post">
                Select Month : <input type="month" name="search-month" placeholder="Search By month">
                <button name="btn-search" >search</button>
        </form>
        <br>
        <table>
            <tr>
                <th>Bill Number</th>
                <th>Billing Cycle</th>
                <th>Units</th>
                <th>Total Units Charge</th>
                <th>Fixed Charge</th>
                <th>Total Amount</th>
            </tr>
            <?php 
                $accountNumber=$_SESSION['accNumberForViewBills'];
                
                $month=$_SESSION['search-month'];
                $sql ="select * from bill where accountNumber='$accountNumber';";
                if($month!="" and $accountNumber!=""){
                    $sql ="select * from bill where accountNumber='$accountNumber' and billingCycle='$month';";
                }
                
                $result = mysqli_query($conn,$sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$row['billNumber']."</td><td>".$row['billingCycle']."</td><td>".$row['units']."</td><td>".$row['totalUnitsCharge']."</td><td>".$row['fixedCharge']."</td><td>".$row['totalAmount']."</td>";
                        echo "</tr>";
                    }
                }
                $_SESSION['search-month']="";
              ?>
           </table>
    </body>
</html>
