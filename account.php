<?php
require("functions.php");
if (!isset($_SESSION['user'])) {
    header("location: login.php");
    exit();
}
if (isset($_GET['logout'])) {
    logoutUser();
}
?>
<!DOCTYPE html>
<!-- Created By CodingNepal - www.codingnepalweb.com -->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Welcome Page</title>
    <link rel="stylesheet" href="css/account.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>

<body>
    <input type="checkbox" id="check">
    <label class="button bars" for="check"><i class="fas fa-bars"></i></label>
    <div class="side_bar">
        <div class="title">
            <div class="logo">Anquoras CodingLab</div>
            <label class=" button cancel" for="check"><i class="fas fa-times"></i></label>
        </div>
        <ul>
            <li><a href="home.php"><i class="fas fa-qrcode"></i>Store</a></li>
            <li><a href="about.html"><i class="fas fa-question-circle"></i>About</a></li>
            <li><a href="#"><i class="fas fa-comments"></i>Feedback</a></li>
        </ul>
        <div class="media_icons">
            <a href="https://www.facebook.com/AresQa0611"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/_quoanh.luu/"><i class="fab fa-instagram"></i></a>
        </div>

    </div>
    <div class="page">
        <h2>Welcome <?php echo $_SESSION["user"] ?></h2>
        <h4>This is welcome page</h4>

        <p>Let's discover some interesting features of my website. You can find it in the side bar</p>
        <a href="?logout"> Logout</a>
    </div>
</body>

</html>