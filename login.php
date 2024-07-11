<?php
require("functions.php");
if (isset($_POST['submit'])) {
    $response = loginUser($_POST['username'], $_POST['password']);
}
?>
<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>

<body>
    <div class="container">
        <div class="wrapper">
            <div class="title"><span>Login Form</span></div>
            <form action="" method="post">
                <div class="row">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Username" name="username" value="<?php echo @$_POST['username']; ?>" required>
                </div>
                <div class="row">
                    <i class="fas fa-lock"></i>
                    <input type="text" placeholder="Password" name="password" value="<?php echo @$_POST['passsword']; ?>" required>
                </div>
                <div class="pass"><a href="#">Forgot password?</a></div>
                <div class="row button">
                    <input type="submit" name="submit" value="Login">
                </div>
                <div class="signup-link">Not a member? <a href="index.php">Register now</a></div>
                <?php
                if (@$response == "success") {
                    echo "login successfully";
                } else {
                    echo @$response;
                }
                ?>
            </form>
        </div>
    </div>
</body>

</html>