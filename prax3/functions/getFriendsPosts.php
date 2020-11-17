<?php
include_once("includes/db.php");

    $stmt = db()->prepare("SELECT * FROM friends WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows > 0) {
        $array_of_id = array();
        while ($row = $res->fetch_assoc()) {
            $friend_id = $row['friend_id'];
            $array_of_id[] = $friend_id;

        }
        $stmt->close();
        $stmt = db()->prepare("SELECT * FROM posts WHERE user_id IN (" . implode(',', $array_of_id) . ") ORDER BY created_at DESC");
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $post_id = $row['post_id'];
                $content = substr($row['post_content'], 0, 90);
                $content2 = substr($row['post_content'], 90, 180);
                $content3 = substr($row['post_content'], 180, 250);
                $post_date = $row['created_at'];
                $post_user_id = $row['user_id'];

                $user = db()->prepare("SELECT * FROM users WHERE id = ?");
                $user->bind_param("i", $post_user_id);
                $user->execute();
                $result = $user->get_result();
                $row_res = $result->fetch_assoc();
                $post_first_name = $row_res['name'];
                $post_last_name = $row_res['surname'];

                echo "
			<div class='row' style=' background-color:lightsteelblue; text-align: center;left: 0.9%;border-radius: 5px;' >
					<h4>$content</h4>
					<h4>$content2</h4>
					<h4>$content3</h4>
					<h4><small>Post created on <strong>$post_date by $post_first_name $post_last_name</strong></small></h4>
					
            <a href='chosenPost.php?post_id=$post_id' ><button>Post info</button></a>
                        
			</div><br>
			";


            }
        }
        $stmt->close();
    }
