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
    <title><?php echo "$first_name $last_name"; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="includes/style.css">
</head>

<body>
<div class="row">
    <div class="col-sm-3">
    </div>
    <div class="col-sm-6">
        <?php
        echo"
			<div id='profile-img'>
				<img src='image/pep.jpg' alt='Profile' class='img-circle' width='225px' height='225px'>
			</div><br>
			";
        ?>
    <div class="col-sm-3">
    </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
    </div>
    <div class="col-sm-6" style="background-color: lightgrey; text-align: center;left: 0.9%;border-radius: 5px;">
        <?php
        echo"
			<h2><strong>Profile</strong></h2>
			<h4><strong>$first_name $last_name</strong></h4>
			<h3><strong>About me</strong></h3><br>
			";
            $text = substr($describe_user, 0, 80);
            $text1 = substr($describe_user, 80, 160);
            $text2= substr($describe_user, 160, 250);
        echo" 
			<strong>$text</strong><br>
			<strong>$text1</strong><br>
			<strong>$text2</strong><br>
			<p><strong>Lives In: </strong> $user_country</p><br>
			<p><strong>Member Since: </strong> $register_date</p><br>
		";
        ?>
    </div>
</div>

<div class="row">
<div class="col-sm-3">
</div>
<div class="col-sm-6" style="text-align: center;left: 0.9%;border-radius: 5px;">
    <?php
    echo"
		<h2><strong>Your Posts</strong></h2>    
		";
    ?>
    <?php include_once("../prax3/functions/getPosts.php") ?>
</div>
</div>

</body>
</html>




