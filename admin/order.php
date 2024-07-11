<?php

@include 'config.php';

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
    <link rel="stylesheet" href="../css/order.css">

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
                    <th>id</th>
                    <th>Customer name</th>
                    <th>Phone number</th>
                    <th>Email</th>
                    <th>Method</th>
                    <th>Street</th>
                    <th>City</th>
                    <th>Country</th>
                    <th>Total Products</th>
                    <th>Total price</th>
                </thead>

                <tbody>
                    <?php

                    $select_products = mysqli_query($conn, "SELECT * FROM `order`");
                    if (mysqli_num_rows($select_products) > 0) {
                        while ($row = mysqli_fetch_assoc($select_products)) {
                    ?>

                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['number']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['method']; ?></td>
                                <td><?php echo $row['street']; ?></td>
                                <td><?php echo $row['city']; ?></td>
                                <td><?php echo $row['country']; ?></td>
                                <td><?php echo $row['total_products']; ?></td>
                                <td>$<?php echo $row['total_price']; ?></td>

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
                $edit_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = $edit_id");
                if (mysqli_num_rows($edit_query) > 0) {
                    while ($fetch_edit = mysqli_fetch_assoc($edit_query)) {
            ?>

                        <form action="" method="post" enctype="multipart/form-data">
                            <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
                            <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
                            <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['name']; ?>">
                            <input type="number" min="0" class="box" required name="update_p_price" value="<?php echo $fetch_edit['price']; ?>">
                            <input type="file" class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
                            <input type="submit" value="update the prodcut" name="update_product" class="btn">
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