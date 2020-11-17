<?php
include_once("../includes/db.php");

if (isset($_GET['friendship_id'])) {
    $get_f_id = $_GET['friendship_id'];
    $friends =db()->prepare("SELECT * FROM friends WHERE friendship_id = ?");
    $friends->bind_param("i", $get_f_id);
    $friends->execute();
    $result = $friends->get_result();
    $row_result = $result->fetch_assoc();
    $friend_id_to_delete = $row_result['friend_id'];
    $user_id_to_del = $row_result['user_id'];
    $friends->close();

    $second = db()->prepare("SELECT * FROM friends WHERE user_id = ? AND friend_id= ?");
    $second->bind_param("ii", $friend_id_to_delete,$user_id_to_del);
    $second->execute();
    $second_friendship = $second->get_result();
    $row_second_friendship = $second_friendship->fetch_assoc();
    $second_id_to_delete = $row_second_friendship['friendship_id'];
    $second->close();

    $stmt = db()->prepare("DELETE FROM friends WHERE friendship_id = ?");
    $stmt->bind_param("i", $second_id_to_delete);
    $stmt->execute();
    $stmt->close();

    $stmt = db()->prepare("DELETE FROM friends WHERE friendship_id = ?");
    $stmt->bind_param("i", $get_f_id);
    $stmt->execute();
    $stmt->close();
    header("Location:../alerts/delete.php");
    exit();
}