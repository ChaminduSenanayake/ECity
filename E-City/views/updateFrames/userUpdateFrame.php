<html>
<?php
        session_start();
        include '../../db/connection.php';
        if(!isset($_SESSION['userNameForUpdate'])){
            $_SESSION['userNameForUpdate']="";
        }
        if(isset($_POST['btn-updateUser']) & $_SESSION['userNameForUpdate']!=""){
            $userName=$_SESSION['userNameForUpdate'];
            $email=$_POST['email'];
            $address=$_POST['address'];
            $tp=$_POST['telephone'];
            $password=$_POST['password'];
            $sql="update user set email='$email',address='$address',telephone='$tp',password='$password' where userName='$userName';";
            $result=mysqli_query($conn,$sql);
            if($result){
                $_SESSION['admin_currentPanel']="users";
                echo '<script>window.top.location.href = "../admin.php"; ;</script>';
                echo '<script> alert("User Updated"); </script>';
            }
        }

            
        if(isset($_POST['btn-deleteUser'])& $_SESSION['userNameForUpdate']!=""){
            $username=$_SESSION['userNameForUpdate'];
            $sql="delete from user where userName='$username';";
            $result=mysqli_query($conn,$sql);
            if($result){
                $_SESSION['admin_currentPanel']="users";
                echo '<script>window.top.location.href = "../admin.php"; ;</script>';
                echo '<script> alert("User Deleted"); </script>';
            }
        } 
        
        if(isset($_POST['btn-searchUser'])){
            $_SESSION['userNameForUpdate']=$_POST['userName'];
        }

        
    ?>

<head>
    <link rel="stylesheet" href="../../assets/css/updateFrameStyle.css">
</head>

<body>
    <h1>Update Users</h1>
    <form action="userUpdateFrame.php" method="post" id="form-search">
        User Name
        <select name="userName">
            <?php 
                $allUserNames ="select userName from user;";
                $result = mysqli_query($conn,$allUserNames);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        if($_SESSION['userNameForUpdate']==$row['userName']){
                            echo "<option selected='selected'>".$row['userName']."</option>";
                        }else{
                            echo "<option>".$row['userName']."</option>";
                        }
                    }
                }
            ?>
        </select>
        <button name="btn-searchUser" id="btn-searchUser" >search</button>
    </form>
    <form method="post" action="userUpdateFrame.php" id="form-update">

        <table>
            <?php 
                $username=$_SESSION['userNameForUpdate'];
                $view ="select * from user where username='$username';";
                $result = mysqli_query($conn,$view);
                if (mysqli_num_rows($result)==1) {
                    $row = mysqli_fetch_assoc($result);
                    echo "<tr><th>Full Name</th><td><input value=".$row['fullName']." disabled></td></tr>";
                    echo "<tr><th>Email</th><td><input id='editable' name='email' type='email' value=".$row['email']."></td></tr>";
                    echo "<tr><th>NIC</th><td><input value=".$row['NIC']." disabled></td></tr>";
                    echo "<tr><th>Address</th><td><input id='editable' name='address' value=".$row['address']."></td></tr>";
                    echo "<tr><th>Telephone</th><td><input id='editable' name='telephone' value=".$row['telephone']."></td></tr>";
                    echo "<tr><th>User Type</th><td><input value=".$row['type']." disabled></td></tr>";
                    echo "<tr><th>Password</th><td><input id='editable' name='password' value=".$row['password']."></td></tr>";
                    echo "<tr><td colspan='2'><button id='btn-edit' name='btn-updateUser'>Edit</button>";
                    echo "<button id='btn-delete' name='btn-deleteUser'>Delete</button></td></tr>";
                }
            ?>

        </table>
        
        
    </form>
</body>

</html>