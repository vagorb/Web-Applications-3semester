<?php
include("includes/db.php");

?>
<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    <div class="container-fluid">
        <div >
            <ul class="nav navbar-nav">
                <?php
                $user = $_SESSION['email'];
                $stmt = db()->prepare("SELECT * FROM users WHERE email = ?");
                $stmt->bind_param("s", $user);
                $stmt->execute();
                $res = $stmt->get_result();
                $row = $res->fetch_assoc();
                $stmt->close();


                $user_id = $row['id'];

                $first_name = $row['name'];
                $last_name = $row['surname'];
                $describe_user = $row['description'];
                $user_pass = $row['password'];
                $user_email = $row['email'];
                $user_country = $row['town'];
                $user_image = $row['photo'];
                $register_date = $row['created_at'];

                ?>
                <li><a href="../prax3/home.php">Home</a></li>
                <li><a href="../prax3/friends.php">Friends</a></li>
                <li><a href='../prax3/peopleSearch.php'>Search People</a></li>
                <li><a href="../prax3/post.php">Add post</a></li>
                <li><a href='../prax3/edit.php'>Edit profile</a></li>
                <li><a href='../prax3/feed.php'>Feed</a></li>
                <li><a href='../prax3/logout.php'>Logout</a></li>


            </ul>
        </div>
    </div>
</nav>


