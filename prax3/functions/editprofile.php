<?php
include_once("includes/db.php");

    if (isset($_POST["edit"])) {
        $town = $_POST['town'];
        $description = $_POST['description'];



        if (strlen($description) < 1) {
            echo "<script>alert('Write something to description!')</script>";
            exit();
        }


        if (strlen($description) > 250) {
            echo "<script>alert('Description too big!')</script>";
            exit();
        }

        if (strlen($town) < 1) {
            echo "<script>alert('Please choose town!')</script>";
            exit();
        }

        if (strlen($town) > 40) {
            echo "<script>alert('Town name too big!')</script>";
            exit();
        }

        if (preg_match('/[^A-Za-z0-9 !?,.\r\n|\r|\n]/', $description)) {
            echo "<script>alert('Text should contain only letters and numbers!')</script>";
            exit();
        }

        $stmt = db()->prepare("UPDATE users SET description= ?, town= ? WHERE id = ?");
        $stmt->bind_param("ssi",$description ,$town, $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($stmt->affected_rows != 0) {
            $stmt->close();
            echo "<script>alert('Profile edited successfully!')</script>";
            echo "<script>window.open('home.php', '_self')</script>";
            exit();
        } else {
            echo "<script>alert('Something went wrong, please try again!')</script>";
            $stmt->close();
        }
    }
