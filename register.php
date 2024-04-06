<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Register</title>
    <script>
        // Simple JavaScript function to toggle password visibility
        function togglePassword(field) {
            var input = document.getElementsByName(field)[0];
            if (input.type === "password") {
                input.type = "text";
            } else {
                input.type = "password";
            }
        }
    </script>

    <?php
    $error_messages = []; // Initialize an empty array to hold error messages

    if (isset($_GET['error'])) {
        $error_messages = json_decode(urldecode($_GET['error']), true);
    }
    ?>

</head>
<body>
    <div class="container">
        <div class="form-container">
            <form method="post" action="classes/register.php">
                <div class="header">Register</div>

                <div class="form-group">
                    <label for="email" class="label">Email:</label>
                    <input type="text" name="email" class="input">
                    <?php if (isset($error_messages['email'])): ?>
                        <div><?php echo $error_messages['email']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="first-name" class="label">First name:</label>
                    <input type="text" name="first-name" class="input">
                    <?php if (isset($error_messages['first-name'])): ?>
                        <div><?php echo $error_messages['first-name']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="last-name" class="label">Last name:</label>
                    <input type="text" name="last-name" class="input">
                    <?php if (isset($error_messages['last-name'])): ?>
                        <div><?php echo $error_messages['last-name']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <div class="label-container">
                        <label for="password" class="label">Password:</label>
                        <input type="checkbox" onclick="togglePassword('password')" style="margin-left: 10px;">
                    </div>
                    <input type="password" name="password" class="input">
                    <?php if (isset($error_messages['password'])): ?>
                        <div><?php echo $error_messages['password']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="repeat-password" class="label">Repeat password:</label>
                    <input type="password" name="repeat-password" class="input">
                    <?php if (isset($error_messages['repeat-password'])): ?>
                        <div><?php echo $error_messages['repeat-password']; ?></div>
                    <?php endif; ?>
                </div>

                <button type="submit">Register</button>

                <a href="login.php">Already have an account? Login</a>
            </form>
        </div>
    </div>
</body>
</html>
