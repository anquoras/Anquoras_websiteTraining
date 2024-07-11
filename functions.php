<?php
require "config.php";

function connect()
{
    $mysqli = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
    if ($mysqli->connect_errno != 0) {
        $error = $mysqli->connect_error;
        $error_date = date("F j, Y, g:i a");
        $message = "{$error} | {$error_date} \r \n";
        file_put_contents('db-log.txt', $message, FILE_APPEND);
        return false;
    } else {
        return $mysqli;
    }
}

function registerUser($username, $email, $password, $confirm_password)
{
    $mysqli = connect();
    $args = func_get_args();
    $arg = array_map(function ($value) {
        return trim($value);
    }, $args);
    # required user fill all the field
    foreach ($args as $value) {
        if (empty($value)) {
            return "All field is required";
        }
    }
    # prevent malicious javascript code
    foreach ($args as $value) {
        if (preg_match("/([<|>])/", $value)) {
            return "<> Character are not allowed";
        }
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Email is not valid";
    }

    $stmt = $mysqli->prepare("SELECT email FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    if ($data != null) {
        return "Email has already exists, please use a different email";
    }

    if (strlen($username) > 50) {
        return "Username is too long";
    }

    $stmt = $mysqli->prepare("SELECT username FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    if ($data != null) {
        return "Ussername has already exists, please use a different username";
    }

    if ($password != $confirm_password) {
        return "Passwords dont match";
    }

    $hashed_passwd = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $mysqli->prepare("INSERT INTO users(username,password,email) VALUES (?,?,?)");
    $stmt->bind_param("sss", $username, $hashed_passwd, $email);
    $stmt->execute();
    if ($stmt->affected_rows != 1) {
        return "An error occured. Please try again !";
    } else {
        return "Success";
    }
}
#admin:061103
function loginUser($username, $password)
{
    $mysqli = connect();
    $username = trim($username);
    $password = trim($password);

    if ($username == "" || $password == "") {
        return "Both field are required";
    }
    $username = filter_var($username, FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS);

    $sql = "SELECT username,password FROM users WHERE username = ? ";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if ($data == NULL) {
        return "Wrong username or password";
    }
    if (password_verify($password, $data["password"]) == FALSE) {
        return "Wrong username or password";
    } else {
        session_start();
        $_SESSION["user"] = $username;
        if ($_SESSION['user'] == "admin") {
            header("location: admin/admin_page.php");
        } else {
            header("location: account.php");
        }
        exit();
    }
}

function logoutUser()
{
    session_destroy();
    header("location: login.php");
    exit();
}

function addProduct($name, $price, $image)
{
    $mysqli = connect();
    $sql = "INSERT INTO `products`(name, price, image) VALUES('$name', '$price', '$image')";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sss", $name, $price, $image);
    $stmt->execute();
}

function passwordReset()
{
}

function deleteAccount()
{
}
