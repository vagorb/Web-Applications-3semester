<?php

include_once("../includes/db.php");
session_start();
if (isset($_GET['friend_id'])) {
    $get_f_id = $_GET['friend_id'];
    $user_id = $_GET['user_id'];
    $friends = db()->prepare("SELECT * FROM friends WHERE user_id= ? AND friend_id= ?");
    $friends->bind_param("ii", $user_id, $get_f_id);
    $friends->execute();
    $result = $friends->get_result();

    if($result->num_rows == 1) {
        $friends->close();
        header("Location:../alerts/alreadyFriends.php");


    } else {
        $friends->close();
        $stmt = db()->prepare("INSERT INTO friends (user_id, friend_id) VALUES (?,?)");
        $stmt->bind_param("ii", $user_id,$get_f_id);
        $stmt->execute();
        $stmt->close();
        $stmt = db()->prepare("INSERT INTO friends (user_id, friend_id) VALUES (?,?)");
        $stmt->bind_param("ii", $get_f_id,$user_id);
        $stmt->execute();
        $stmt->close();
        header("Location:../alerts/newFriend.php");

    }

}