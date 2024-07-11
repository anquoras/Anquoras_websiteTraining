<?php
session_start();
define('SERVER', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DATABASE', 'onlinestore');
$conn = mysqli_connect('localhost', 'root', '', 'onlinestore') or die('connection failed');
