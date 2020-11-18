<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="includes/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<meta charset="UTF-8">
</head>
<body>
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <div><h1>Mini Facebook</h1></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12"></div>
        <div class=main-content>
            <div class="header">
                <h3>Log in to Mini Facebook</h3>
            </div>
            <div >
                <form method="post">

                    <label for="email">E-mail</label><input id="email" type="email" name="email" placeholder="Email" required="required" class="form-control input-md">
                    <br>
                    <div class="overlap-text">
                        <label for="password">Password</label><input id="password" type="password" name="password" placeholder="Password" required="required" class="form-control input-md">
                        <br>
                    </div>
                    <a style="text-decoration: none;float: right;color: #187FAB;" data-toggle="tooltip" href="index.php">Back to first page</a><br>
                    <button id="login" class="btn btn-info btn-lg" name="login">Login</button>
                    <?php include("functions/check.php"); ?>
                </form>
            </div>
        </div>

    </div>
</body>
</html>