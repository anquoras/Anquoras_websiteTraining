<header class="header">

    <div class="flex">

        <a href="#" class="logo">Anquoras Pets shop</a>

        <nav class="navbar">
            <a href="admin_page.php">add products</a>
            <a href="products.php">view products</a>
            <a href="users.php">manage user</a>
        </nav>

        <?php

        $select_rows = mysqli_query($conn, "SELECT * FROM `order`") or die('query failed');
        $row_count = mysqli_num_rows($select_rows);

        ?>

        <a href="order.php" class="cart">order <span><?php echo $row_count; ?></span> </a>

        <div id="menu-btn" class="fas fa-bars"></div>

    </div>

</header>