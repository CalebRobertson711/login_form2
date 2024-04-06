<?php
require "../database/database.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") // Use double equals (==) for comparison
{
    $email = $_POST['email'];
    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat-password'];

    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $number_errors = 0;
    $message = []; // Initialize an array to store error messages

    if ($email == '' || !isset($email))
    {
        $message['email'] = "Email is required";
        $number_errors++;
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $message['email'] = "Invalid email";
        $number_errors++;
    }

    else 
    {
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0)
        {
            $message['email'] = "Email already exists";
            $number_errors++;
        }
    }

    if ($first_name == '' || !isset($first_name))
    {
        $message['first-name'] = "First name is required";
        $number_errors++;
    }
    else if (strlen($first_name) < 3 || strlen($first_name) > 30)
    {
        $message['first-name'] = "First name must be between 3 and 30 characters";
        $number_errors++;
    }

    if ($last_name == '' || !isset($last_name))
    {
        $message['last-name'] = "Last name is required";
        $number_errors++;
    }
    else if (strlen($last_name) < 3 || strlen($last_name) > 30)
    {
        $message['last-name'] = "Last name must be between 3 and 30 characters";
        $number_errors++;
    }

    if ($password == '' || !isset($password))
    {
        $message['password'] = "Password is required";
        $number_errors++;
    }
    else if (strlen($password) < 8 || strlen($password) > 30 || !preg_match("/[0-9]/", $password) || !preg_match("/[a-z]/", $password) || !preg_match("/[A-Z]/", $password))
    {
        $message['password'] = "Password must be between 8 and 30 characters and contain at least one uppercase letter, one lowercase letter, and one number";
        $number_errors++;
    }

    if ($repeat_password == '' || !isset($repeat_password))
    {
        $message['repeat-password'] = "Repeat password is required";
        $number_errors++;
    }
    else if ($password != $repeat_password)
    {
        $message['repeat-password'] = "Passwords do not match";
        $number_errors++;
    }

    if ($number_errors == 0)
    {
        $sql1 = "INSERT INTO users (email, first_name, last_name, password_hash) VALUES ('$email' , '$first_name', '$last_name', '$password_hash')";
        mysqli_query($conn, $sql1);
    }
    else
    {
        // Redirect back to the registration page with error messages in the URL query string
        header("Location: ../register.php?error=" . urlencode(json_encode($message)));
        exit(); // Ensure that the script stops execution after redirection
    }
}
?>
