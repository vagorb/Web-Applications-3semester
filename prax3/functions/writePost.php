<?php
include_once("includes/db.php");

    if (isset($_POST["post"])) {
        $content = $_POST['postText'];
        $user = $_SESSION['email'];

        if (strlen($content) < 1) {
            echo "<script>alert('Please write something!')</script>";
            exit();
        }

        if (strlen($content) > 250) {
            echo "<script>alert('Your post is too big. Maximum post size is 250 characters!')</script>";
            exit();
        }

        if (preg_match('/[^A-Za-z0-9 !?,.\r\n|\r|\n]/', $content)) {
            echo "<script>alert('Text should contain only letters and numbers!')</script>";
            exit();
        }
        $stmt = db()->prepare("INSERT INTO posts (user_id, post_content) VALUES (?,?)");
        $stmt->bind_param("is", $user_id,$content);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        echo "<script>alert('Post created.')</script>";
        echo "<script>window.open('home.php', '_self')</script>";
        exit();

    }


