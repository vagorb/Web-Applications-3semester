<?php
include_once("includes/db.php");

if (isset($_POST["writeComment"])) {

    $comment = $_POST['placeCom'];
    if (strlen($comment) < 1) {
        echo "<script>alert('Write something to comment!')</script>";
        exit();
    }


    if (strlen($comment) > 250) {
        echo "<script>alert('Comment too big!')</script>";
        exit();
    }


    if (preg_match('/[^A-Za-z0-9 !?,.\r\n|\r|\n]/', $comment)) {
        echo "<script>alert('Text should contain only letters and numbers!')</script>";
        exit();
    }


    $stmt = db()->prepare("INSERT INTO comments (user_id,post_id,comment) VALUES (?,?,?)");
    $stmt->bind_param("iis", $user_id, $post_id, $comment);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    echo "<script>alert('Comment added successfully!')</script>";
    echo "<script>window.open('chosenPost.php?post_id=$post_id', '_self')</script>";
    exit();



}