<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration</title>
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
        <div class="main-content">
            <div class="header">
                <h3>Register to Mini Facebook</h3>
            </div>
            <div>
                <form action="" method="post">
                    <div class="group">
                        <label for="name">First name</label><input id="name" type="text" class="form-control" placeholder="First Name" name="first_name" required="required">
                    </div><br>
                    <div class="group">
                        <label for="surname">Last name</label><input id="surname" type="text" class="form-control" placeholder="Last Name" name="last_name" required="required">
                    </div><br>
                    <div class="group">
                        <label for="password">Password</label><input id="password" type="password" class="form-control" placeholder="Password" name="password" required="required">
                    </div><br>
                    <div class="group">
                        <label for="repeat_password">Repeat Password</label><input id="repeat_password" type="password" class="form-control" placeholder="Repeat Password" name="repeat_password" required="required">
                    </div><br>
                    <div class="group">
                        <label for="email">E-mail</label><input id="email" type="email" class="form-control" placeholder="Email" name="email" required="required">
                    </div><br>
                    <div class="group">
                        <label for="town">Town</label><input id = "town" type="text" class="form-control" placeholder="Town" name="town" required="required">
                    </div><br>
                    <a style="text-decoration: none;float: right;color: #187FAB;" data-toggle="tooltip" href="index.php">Back to first page</a><br>
                    <button id="registration" class="btn btn-info btn-lg" name="registration">Register</button>
                    <?php include("../prax3/functions/new_user.php"); ?>

                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>