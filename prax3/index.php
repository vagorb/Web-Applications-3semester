<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mini Facebook</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="includes/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<meta charset="UTF-8">
</head
<body>
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <div><h1>Mini Facebook</h1></div>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-sm-12">
        <form method="post" action="">
            <button id="registration" class="btn btn-info btn-lg" name="reg">Registration</button><br>
            <?php
            if(isset($_POST['reg'])){
                echo "<script>window.open('registration.php','_self')</script>";
            }
            ?>
            <button id="login" class="btn btn-info btn-lg" name="login">Log in</button><br>
            <?php
            if(isset($_POST['login'])){
                echo "<script>window.open('login.php','_self')</script>";
            }
            ?>
        </form>
    </div>
    </div>
</body>
</html>