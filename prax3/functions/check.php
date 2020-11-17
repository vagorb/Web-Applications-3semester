<?php
require_once("includes/db.php");

session_start();

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $pass = $_POST['password'];
    $password =sha1($pass);

    $stmt = db()->prepare("SELECT * FROM users WHERE email= ? AND password= ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows == 1) {
        $_SESSION['email'] = $email;
        echo "<script>window.open('home.php', '_self')</script>";
    } else {
        echo "<script>alert('Your Email or Password is incorrect')</script>";
    }
}