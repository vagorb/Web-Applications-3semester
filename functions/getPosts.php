<?php
include_once("includes/db.php");

    $stmt = db()->prepare("SELECT * FROM posts WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->bind_param("i", $user_id );
    $stmt->execute();
    $res = $stmt->get_result();

    while($row = $res->fetch_assoc()) {

        $post_id = $row['post_id'];
        $content = substr($row['post_content'], 0, 90);
        $content2 = substr($row['post_content'], 90, 180);
        $content3 = substr($row['post_content'], 180, 250);
        $post_date = $row['created_at'];


        if (strlen($content) >= 1) {
            echo "
			<div class='row' style=' background-color:lightsteelblue; text-align: center;left: 0.9%;border-radius: 5px;' >
					<h4>$content</h4>
					<h4>$content2</h4>
					<h4>$content3</h4>
					<h4><small>Post created on <strong>$post_date by $first_name $last_name</strong></small></h4>
					
            <a href='chosenPost.php?post_id=$post_id' ><button>Post info</button></a>
                        
			</div><br>
			";
        }

    }
    $stmt->close();



