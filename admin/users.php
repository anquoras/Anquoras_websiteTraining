<?php

@include 'config.php';


if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_query = mysqli_query($conn, "DELETE FROM `users` WHERE user_id = $delete_id ") or die('query failed');
    if ($delete_query) {
        header('location: users.php');
        $message[] = 'product has been deleted';
    } else {
        header('location: users.php');
        $message[] = 'product could not be deleted';
    };
};

if (isset($_POST['update_user'])) {
    $update_p_id = $_POST['update_p_id'];
    $update_p_name = $_POST['update_p_name'];
    $update_p_email = $_POST['update_p_email'];

    $update_query = mysqli_query($conn, "UPDATE `users` SET username = '$update_p_name', email = '$update_p_email' WHERE user_id = '$update_p_id'");

    if ($update_query) {
        $message[] = 'product updated succesfully';
        header('location: users.php');
    } else {
        $message[] = 'product could not be updated';
        header('location: users.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin panel</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/admin.css">

</head>

<body>

    <?php

    if (isset($message)) {
        foreach ($message as $message) {
            echo '<div class="message"><span>' . $message . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
        };
    };

    ?>

    <?php include 'header.php'; ?>

    <div class="container">

        <section class="display-product-table">

            <table>

                <thead>
                    <th>username</th>
                    <th>email</th>
                    <th>action</th>
                </thead>

                <tbody>
                    <?php

                    $select_products = mysqli_query($conn, "SELECT user_id,username,email FROM `users`");
                    if (mysqli_num_rows($select_products) > 0) {
                        while ($row = mysqli_fetch_assoc($select_products)) {
                    ?>

                            <tr>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td>
                                    <a href="users.php?delete=<?php echo $row['user_id']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
                                    <a href="users.php?edit=<?php echo $row['user_id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
                                </td>
                            </tr>

                    <?php
                        }
                        1;
                    } else {
                        echo "<div class='empty'>no product added</div>";
                    };
                    ?>
                </tbody>
            </table>

        </section>

        <section class="edit-form-container">

            <?php

            if (isset($_GET['edit'])) {
                $edit_id = $_GET['edit'];
                $edit_query = mysqli_query($conn, "SELECT username,email FROM `users` WHERE user_id = $edit_id");
                if (mysqli_num_rows($edit_query) > 0) {
                    while ($fetch_edit = mysqli_fetch_assoc($edit_query)) {
            ?>

                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['user_id']; ?>">
                            <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['username']; ?>">
                            <input type="number" min="0" class="box" required name="update_p_email" value="<?php echo $fetch_edit['email']; ?>">
                            <input type="submit" value="update the user" name="update_user" class="btn">
                            <input type="reset" value="cancel" id="close-edit" class="option-btn">
                        </form>

            <?php
                    };
                };
                echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
            };
            ?>

        </section>

    </div>















    <!-- custom js file link  -->
    <script src="../js/script.js"></script>

</body>

</html>