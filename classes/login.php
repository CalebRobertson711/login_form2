<?php
require "../database/database.php";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    $number_errors = 0;
    $error_messages = array();

    if ($email == '' || !isset($email))
    {
        $message['email'] = "Email is required";
        $number_errors ++;
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $message['email'] = "Email is not valid";
        $number_errors ++;
    }
    
    if ($password == '' ||!isset($password))
    {
        $message['password'] = "Password is required";
        $number_errors ++;
    }

    if ($number_errors == 0)
    {
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        if (mysqli_num_rows($result) == 0)
        {
            $message['email'] = "Email does not exist";
            $number_errors ++;
        }
        if (password_verify($password, $row['password_hash']) == false)
        {
            $message['password'] = "Password is incorrect";
            $number_errors ++;
        }

        if ($number_errors == 0)
        {
            session_start();
            $_SESSION['id'] = $row['id'];
            header("Location: ../index.php");
        }
        else
        {
            header("Location: ../login.php?error=" . urlencode(json_encode($message)));
            exit(); // Ensure that the script stops execution after redirection
        }
    }
    

}
?>