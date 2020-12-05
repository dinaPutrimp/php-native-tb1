<?php
    $conn = new mysqli("localhost","root","","book");
    if($conn->connect_error){
        die("Connection Failed!" .$conn->connect_error);
    }
?>