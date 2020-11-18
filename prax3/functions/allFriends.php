 <?php
include_once("includes/db.php");

$stmt = db()->prepare("SELECT * FROM friends WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$res = $stmt->get_result();


while($row = $res->fetch_assoc()) {

    $friend_id = $row['friend_id'];
    $friendship_id = $row['friendship_id'];
    $friend = db()->prepare("SELECT * FROM users WHERE id = ?");
    $friend->bind_param("i", $friend_id);
    $friend->execute();
    $run_friend = $friend->get_result();
    $row_friends = $run_friend->fetch_assoc();
    $friend_first_name = $row_friends['name'];
    $friend_last_name = $row_friends['surname'];
    $friend_describe = $row_friends['description'];
    $friend_country = $row_friends['town'];
    $friend_registration = $row_friends['created_at'];
    $text = substr($friend_describe, 0, 80);
    $text1 = substr($friend_describe, 80, 160);
    $text2= substr($friend_describe, 160, 250);
        echo "
        <div class='row' style=' background-color:#c7e0e9; text-align: center;border-radius: 50px; margin-bottom: 5px' >
			<h4><strong>$friend_first_name $friend_last_name</strong></h4>
			<div><img class='img-circle' src='../prax3/image/pep.jpg' alt='img' style='height: 60px;width: 60px'></div>
			";
        echo" 
			$text<br>
			$text1<br>
			$text2<br>
			<p>Lives In: </strong> $friend_country</p><br>
			<p>Member Since: </strong> $friend_registration</p><br>
			<a href='../prax3/profilePage.php?person_id=$friend_id' ><button>See Page</button></a>
			<a href='functions/deleteFriend.php?friendship_id=$friendship_id'><button>Delete Friend</button></a>
			</div>
			
			";


}