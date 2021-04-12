<?php
    $host="localhost";
    $user="root";
    $password="26010";
    $db="ecity";
    $conn = mysqli_connect($host,$user,$password,$db);
    
    if(!$conn){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
            
?>