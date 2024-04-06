<?php
 $serverName = "localhost";
 $userNme = 'root';
 $password = '';
 $user_db = "login_system";

 $conn = new mysqli($serverName, $userNme, $password, $user_db);
 if (!$conn) {
     die("Connection failed: ". $conn->connect_error);
 }
?>