<?php

include_once("../includes/db.php");

  if($_GET['like']) {
      $get_p_id = $_GET['like'];
      $get_u_id = $_GET['us_id'];
      $stmt = db()->prepare("SELECT * FROM likes WHERE user_id= ? AND post_id= ?");
      $stmt->bind_param("ii", $get_u_id , $get_p_id);
      $stmt->execute();
      $res = $stmt->get_result();
      if ($res->num_rows > 0) {
          $stmt->close();
        $stmt = db()->prepare("DELETE FROM likes WHERE user_id= ? AND post_id= ?");
        $stmt->bind_param("ii", $get_u_id , $get_p_id);
        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();
      } else {
          $stmt = db()->prepare("INSERT INTO likes (user_id, post_id) VALUES (?,?)");
          $stmt->bind_param("ii", $get_u_id, $get_p_id);
          $stmt->execute();
          $result = $stmt->get_result();
          $stmt->close();
      }
      echo "<script>window.open('../chosenPost.php?post_id=$get_p_id;', '_self')</script>";

  }



