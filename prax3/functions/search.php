<?php
include_once("includes/db.php");

if (isset($_POST['search'])) {

    if(strlen($_POST['town']) == 0 && strlen($_POST['first_name']) == 0 && strlen($_POST['last_name']) == 0) {
        echo "<script>alert('Write something!')</script>";
        exit();
    }

    if (preg_match('/[^A-Za-z]/', $_POST['first_name'])) {
        echo "<script>alert('Text should contain only letters!')</script>";
        exit();
    }

    if (preg_match('/[^A-Za-z]/', $_POST['last_name'])) {
        echo "<script>alert('Text should contain only letters!')</script>";
        exit();
    }

    if (preg_match('/[^A-Za-z]/', $_POST['town'])) {
        echo "<script>alert('Text should contain only letters!')</script>";
        exit();
    }

    if(strlen($_POST['first_name']) > 0) {
        $search_name = "%{$_POST['first_name']}%";
    }

    if(strlen($_POST['last_name']) > 0) {
        $search_last_name = "%{$_POST['last_name']}%";
    }

    if(strlen($_POST['town']) > 0) {
        $search_town = "%{$_POST['town']}%";
    }

    if (strlen($_POST['town']) > 0 && strlen($_POST['first_name']) > 0 && strlen($_POST['last_name']) > 0) {
        $stmt = db()->prepare("SELECT * FROM users WHERE name LIKE ? OR surname LIKE ? OR town LIKE ?");

        $stmt->bind_param("sss", $search_name,$search_last_name,$search_town);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            get_results($row, $user_id);
        }
        $stmt->close();
    } else if (strlen($_POST['first_name']) > 0 && strlen($_POST['last_name']) > 0) {
        $stmt = db()->prepare("SELECT * FROM users WHERE name LIKE ? OR surname LIKE ?");
        $stmt->bind_param("ss", $search_name, $search_last_name);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            get_results($row, $user_id);
        }
        $stmt->close();
    } else if (strlen($_POST['first_name']) > 0 && strlen($_POST['town']) > 0) {
        $stmt = db()->prepare("SELECT * FROM users WHERE name LIKE ? OR town LIKE ?");
        $stmt->bind_param("ss", $search_name, $search_town);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            get_results($row, $user_id);
        }
        $stmt->close();
    } else if (strlen($_POST['town']) > 0 && strlen($_POST['last_name']) > 0) {
        $stmt = db()->prepare("SELECT * FROM users WHERE surname LIKE ? OR town LIKE ?");
        $stmt->bind_param("ss", $search_last_name, $search_town);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            get_results($row, $user_id);
        }
        $stmt->close();
    }else if (strlen($_POST['first_name']) > 0) {
        $stmt = db()->prepare("SELECT * FROM users WHERE name LIKE ?");
        $stmt->bind_param("s", $search_name);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            get_results($row, $user_id);
        }
        $stmt->close();
    } else if (strlen($_POST['last_name']) > 0) {
        $stmt = db()->prepare("SELECT * FROM users WHERE surname LIKE ?");
        $stmt->bind_param("s", $search_last_name);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            get_results($row, $user_id);
        }
        $stmt->close();
    } else if (strlen($_POST['town']) > 0) {
        $stmt = db()->prepare("SELECT * FROM users WHERE town LIKE ?");
        $stmt->bind_param("s", $search_town);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            get_results($row, $user_id);
        }
        $stmt->close();
    }



}


function get_results($row, $user_id) {
    if ($user_id != $row['id']) {

        $friend_first_name = $row['name'];
        $friend_last_name = $row['surname'];
        $friend_describe = $row['description'];
        $friend_country = $row['town'];
        $friend_registration = $row['created_at'];
        $friend_id = $row['id'];
        $text = substr($friend_describe, 0, 80);
        $text1 = substr($friend_describe, 80, 160);
        $text2 = substr($friend_describe, 160, 250);
        $friends = db()->prepare("SELECT * FROM friends WHERE user_id= ? AND friend_id= ?");
        $friends->bind_param("ii", $user_id, $row['id']);
        $friends->execute();
        $result = $friends->get_result();

        if ($result->num_rows == 1) {
            $friends->close();
            echo "
        <div class='row' style=' background-color:#c7e0e9; text-align: center;border-radius: 50px; margin-top: 5px' >
			<h4><strong>$friend_first_name $friend_last_name (You are already friends)</strong></h4>
			<div><img class='img-circle' src='../prax3/image/pep.jpg' alt='img' style='height: 60px;width: 60px'></div>
			
			";
            echo "
			$text<br>
			$text1<br>
			$text2<br>
			<p>Lives In: </strong> $friend_country</p><br>
			<p>Member Since: </strong> $friend_registration</p><br>
		    <a href='../prax3/profilePage.php?person_id=$friend_id' ><button>See Page</button></a>
			<a href='../prax3/functions/addFriend.php?friend_id=$friend_id&user_id=$user_id' ><button>Add friend</button></a>
			</div>

			";

        } else {
            echo "
        <div class='row' style=' background-color:#c7e0e9; text-align: center;border-radius: 50px; margin-top: 5px' >
			<h4><strong>$friend_first_name $friend_last_name</strong></h4>
			<div><img class='img-circle' src='../prax3/image/pep.jpg' alt='img' style='height: 60px;width: 60px'></div>
			";
            echo "
			$text<br>
			$text1<br>
			$text2<br>
			<p>Lives In: </strong> $friend_country</p><br>
			<p>Member Since: </strong> $friend_registration</p><br>
			<a href='../prax3/profilePage.php?person_id=$friend_id' ><button>See Page</button></a>
			<a href='../prax3/functions/addFriend.php?friend_id=$friend_id&user_id=$user_id' ><button>Add friend</button></a>
			</div>

			";
        }
    }

}