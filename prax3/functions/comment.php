<?php
include_once("includes/db.php");

if (isset($_GET['post_id'])) {
    $get_p_id = $_GET['post_id'];

    $get_posts = db()->prepare("SELECT * FROM posts WHERE post_id = ?");
    $get_posts->bind_param("i", $get_p_id);
    $get_posts->execute();
    $run_posts = $get_posts->get_result();

    $row_posts = $run_posts->fetch_assoc();

    $post_id = $row_posts['post_id'];
    $post_user_id = $row_posts['user_id'];
    $post_content = substr($row_posts['post_content'], 0, 90);
    $post_content2 = substr($row_posts['post_content'], 90, 180);
    $post_content3 = substr($row_posts['post_content'], 180, 250);
    $post_date = $row_posts['created_at'];
    $get_posts->close();

    $user = db()->prepare("SELECT * FROM users WHERE id =?");
    $user->bind_param("i", $post_user_id);
    $user->execute();
    $run_user = $user->get_result();

    $row_user = $run_user->fetch_assoc();
    $post_user_name = $row_user['name'];
    $post_user_surname = $row_user['surname'];
    $user->close();

    $stmt = db()->prepare("SELECT * FROM likes WHERE post_id = ?");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $res = $stmt->get_result();
    if($user_id != $post_user_id) {
        echo "
			<div class='row' style=' background-color:#b0c4de; text-align: center;left: 0.9%; border: 5px;' >
					<h4>$post_content</h4>
					<h4>$post_content2</h4>
					<h4>$post_content3</h4>
					Likes $res->num_rows
					<h4><small>Post created on <strong>$post_date by $post_user_name $post_user_surname </strong></small></h4>
				     <a href='functions/like.php?like=$post_id&us_id=$user_id' ><button>Like</button></a>
				     
			 </div><br>
			 <h3>Comments</h3><br>
			";
    } else {
        echo "
			<div class='row' style=' background-color:#b0c4de; text-align: center;left: 0.9%; border: 5px;' >
					<h4>$post_content</h4>
					<h4>$post_content2</h4>
					<h4>$post_content3</h4>
					 Likes $res->num_rows
					<h4><small>Post created on <strong>$post_date by $post_user_name $post_user_surname </strong></small></h4>
				   
			 </div><br>
			 <h3>Comments</h3><br>
			";
    }






    $stmt = db()->prepare("SELECT * FROM comments WHERE post_id = ?");
    $stmt->bind_param("i", $get_p_id);
    $stmt->execute();
    $res = $stmt->get_result();

    while($row_com = $res->fetch_assoc()) {

        $comment_id = $row_com['comment_id'];
        $content = substr($row_com['comment'], 0, 90);
        $content2 = substr($row_com['comment'], 90, 180);
        $content3 = substr($row_com['comment'], 180, 250);
        $comment_date = $row_com['created_at'];
        $user_commented = $row_com['user_id'];

        $user_com = db()->prepare("SELECT * FROM users WHERE id = ?");
        $user_com->bind_param("i", $user_commented);
        $user_com->execute();
        $response1 = $user_com->get_result();
        $response = $response1->fetch_assoc();
        $user_commented_name = $response['name'];
        $user_commented_surname = $response['surname'];
        $user_com->close();

        if (strlen($content) >= 1) {
            echo "
			<div class='row' style=' background-color:gainsboro; text-align: center;left: 0.9%;border-radius: 5px;' >
					<h4>$content</h4>
					<h4>$content2</h4>
					<h4>$content3</h4>
					<h4><small>Comment created on <strong>$comment_date by $user_commented_name $user_commented_surname</strong></small></h4>
					
			</div><br>
			";
        }
    }

    echo'
            <div>
                <form action="" method="post">
                    <div class="group">
                        <label for="placeCom">Your comment</label><textarea id="placeCom"  class="form-control" placeholder="Write your comment here" name="placeCom" required="required"></textarea>
                    </div><br>
                    <button id="writeComment" class="btn btn-info btn-lg" name="writeComment">Submit</button>';
                    include_once("writeComment.php");
              echo'
                </form>
            </div>

';
    $stmt->close();


}