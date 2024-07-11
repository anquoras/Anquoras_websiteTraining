<?php

include 'config.php';

if (isset($_POST['post_feedback'])) {
    // Lấy dữ liệu từ form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $feedback = $_POST['feedback'];

    // Chuẩn bị câu lệnh SQL để chèn dữ liệu vào bảng
    $sql = "INSERT INTO feedback (name, email, feedback) VALUES (?, ?, ?)";

    // Sử dụng prepared statement để ngăn chặn SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $feedback);

    // Thực thi câu lệnh
    if ($stmt->execute()) {
        echo "Feedback submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Đóng kết nối
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Responsive Form Card</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/feedback.css">
</head>

<body>
    <?php

    if (isset($message)) {
        foreach ($message as $message) {
            echo '<div class="message"><span>' . $message . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
        };
    };

    ?>
    <h1>Anquoras Online Store</h1>
    <div class="form-box">
        <div class="textup">
            <i class="fa fa-solid fa-clock"></i>
            It only takes two minutes!!
        </div>
        <form method="post">
            <label for="uname">
                <i class="fa fa-solid fa-user"></i>
                Name
            </label>
            <input type="text" id="uname" name="name" required>

            <label for="email">
                <i class="fa fa-solid fa-envelope"></i>
                Email Address
            </label>
            <input type="email" id="email" name="email" required>

            <label for="msg">
                <i class="fa-solid fa-comments" style="margin-right: 3px;"></i>
                Write your Suggestions:
            </label>
            <textarea id="msg" name="feedback" rows="4" cols="10" required>
			</textarea>
            <button type="submit" value="post feedback" name="post_feedback" class="btn">
                Submit
            </button>
        </form>
    </div>
</body>


</html>