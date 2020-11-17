<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");

if(!isset($_SESSION['email'])){

    header("Location: index.php");
}
?>
<html lang="en">
<head>
    <title>View Post</title>
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
                <h3>Post info</h3>

            </div>
            <div >
                <?php
                include_once("functions/comment.php")
                ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>