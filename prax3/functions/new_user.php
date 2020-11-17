<?php
require_once("includes/db.php");

    if (isset($_POST["registration"])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $pass = $_POST['password'];
        $repeat_pass = $_POST['repeat_password'];
        $email = $_POST['email'];
        $town = $_POST['town'];
        $picture = "image/pep.jpg";



    if(strlen($pass) < 5){
        echo"<script>alert('Password should contain minimum 5 characters!')</script>";
        exit();
    }

    if($pass != $repeat_pass){
        echo"<script>alert('Passwords do not match!')</script>";
        exit();
    }


    if (preg_match('/[^A-Za-z]/', $first_name)) {
        echo "<script>alert('First name should contain only letters!')</script>";
        exit();
    }

    if (preg_match('/[^A-Za-z]/', $last_name)) {
        echo "<script>alert('Last name should contain only letters!')</script>";
        exit();
    }

    if (preg_match('/[^A-Za-z]/', $town)) {
            echo "<script>alert('Town name should contain only letters!')</script>";
            exit();
    }


    $password = sha1($pass);


    $stmt = db()->prepare("SELECT email FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows === 1){
        echo "<script>alert('Email already exist, Please try using another email')</script>";
        echo "<script>window.open('registration.php', '_self')</script>";
        $stmt->close();
        exit();
    } else {
        $stmt->close();
        $stmt = db()->prepare("INSERT INTO users (name,surname,email,password,town,photo) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("ssssss", $first_name,$last_name,$email,$password,$town,$picture);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows !== 0){
            echo "<script>alert('Page created.')</script>";
            echo "<script>window.open('login.php', '_self')</script>";
            $stmt->close();
        }
        else{
            echo "<script>alert('Something went wrong, please try again!')</script>";
            echo "<script>window.open('registration.php', '_self')</script>";
            $stmt->close();
        }
    }
}