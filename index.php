<?php
require "functions.php";
if (isset($_POST['Submit'])) {
    $response = registerUser($_POST['username'], $_POST['email'], $_POST['password'], $_POST['confirm_password']);
}
?>

<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com-->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Registration Form</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="wrapper">
        <h2>Registration</h2>
        <form action="" method="POST">
            <div class="input-box">
                <input type="text" name="username" value="<?php @$_POST['username']; ?>" placeholder="Enter your name" required>
            </div>
            <div class="input-box">
                <input type="text" name="email" value="<?php @$_POST['email']; ?>" placeholder="Enter your email" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" value="<?php @$_POST['password']; ?>" placeholder="Create password" required>
            </div>
            <div class="input-box">
                <input type="password" name="confirm password" value="<?php @$_POST['confirm_password']; ?>" placeholder="Confirm password" required>
            </div>
            <div class="policy">
                <input type="checkbox">
                <h3>I accept all terms & condition</h3>
            </div>
            <div class="input-box button">
                <input type="submit" name="Submit" value="Register Now">
            </div>
            <div class="text">
                <h3>Already have an account? <a href="login.php">Login now</a></h3>
            </div>

            <?php
            if (@$response == "Success") {
                echo "Your Registration was successful !";
                header("location: login.php");
            } else {
                echo @$response;
            }
            ?>
        </form>
    </div>

</body>

</html>