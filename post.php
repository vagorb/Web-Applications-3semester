<?php
session_start();
include("includes/header.php");
?>
<html lang="en">
<head>
    <title>Post</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="includes/style.css">
</head>

<body>
<div class="row">
    <div class="col-sm-12">
        <div class="main-content">
            <div class="header">
                <h3>Post something to your Mini Facebook page</h3>
            </div>
            <div >
                <form method="post" id="f" enctype="multipart/form-data">
                    <div class="group">
                        <label for="postText">Your Post</label><textarea id="postText" type="text" class="form-control" placeholder="How are you today?" name="postText" rows="6" required="required"></textarea>
                    </div><br>
                    <button id="post" class="btn btn-info btn-lg" name="post">Post</button>
                </form>
                <?php include("../prax3/functions/writePost.php"); ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>