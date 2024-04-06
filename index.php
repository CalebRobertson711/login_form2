<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php
require "database/database.php";
session_start();
$user_id = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>
<body>
    welcome <?php echo $user['first_name'] . " " . $user['last_name'];?>
</body>
</html>