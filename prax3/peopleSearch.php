<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");

if(!isset($_SESSION['email'])){
    header("location: index.php");
}
?>
<html lang="en">
<head>
    <title><?php echo "Search for friends"; ?></title>
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
                <h3>Friend search</h3>
            </div>

            <div >
                <form method="post" id="f" enctype="multipart/form-data">
                    <div class="group">
                        <label for="first_name">First Name</label><input id = "first_name" type="text" class="form-control" placeholder="Name" name="first_name" >
                    </div><br>
                    <div class="group">
                        <label for="last_name">Last Name</label><input id = "last_name" type="text" class="form-control" placeholder="Last name" name="last_name">
                    </div><br>
                    <div class="group">
                        <label for="town">Town</label><input id = "town" type="text" class="form-control" placeholder="Town" name="town" >
                    </div><br>
                    <button id="search" class="btn btn-info btn-lg" name="search">Search</button>
                </form>
                <?php include("../prax3/functions/search.php"); ?>
            </div>
    </div>
        </div>
</div>


</body>
</html>


