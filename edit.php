<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");

if(!isset($_SESSION['email'])){
    header("Location: ../prax3/index.php");
}
?>
<html lang="en">
<head>
    <title>Edit Profile</title>
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
                <h3>Edit your Mini Facebook profile</h3>
            </div>
            <div >
                <form method="post" id="f" enctype="multipart/form-data">
                    <div class="group">
                        <label for="description">Description</label><textarea id="description" rows="4" class="form-control" placeholder="Description" name="description" required="required"></textarea>
                    </div><br>
                    <div class="group">
                        <label for="town">Town</label><input id = "town" type="text" class="form-control" placeholder="Town" name="town" required="required">
                    </div><br>
                    <button id="edit" class="btn btn-info btn-lg" name="edit">Send changes</button>
                </form>
                <?php include("../prax3/functions/editprofile.php"); ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>

