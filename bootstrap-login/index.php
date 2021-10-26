<?php

session_start();

if (isset($_SESSION['id'])) {
  header("Location: dashboard.php");
}

$message = "";
  if (isset($_POST['btn'])) {
    require_once './Login.php';

    $login = new Login();
    $message = $login->adminLoginCheck($_POST);
  }
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  </head>
  <body>
    <div class="container" style="margin-top: 50px;">
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <div class="well">
            <h3 class="text-center text-success">Admin Login</h3>
            <hr/>
            <h3 class="text-center text-danger"><?php echo $message ?></h3>
            <form class="form-horizontal" action="" method="post">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox"> Remember me
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="btn" class="btn btn-success btn-block">Sign in</button>
                  </div>
                </div>
              </form>
          </div>
          
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </body>
</html>