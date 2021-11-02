<?php
session_start([
    'cookie_lifetime' => 60,
]);
$error = false;
$_SESSION['loggedin'] = '';

if(isset($_POST['username']) && isset($_POST['password'])){
    if('admin' == $_POST['username'] && 'e10adc3949ba59abbe56e057f20f883e' == md5($_POST['password'])){
        $_SESSION['loggedin'] = true;
    }else{
        $error = true;
        $_SESSION['loggedin'] = false;
    }
}

if(isset($_POST['logout'])){
    $_SESSION['loggedin'] = false;
    session_destroy();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
    <title>CRUD Project(Hasin Vai)</title>
    <style>
        body {
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="column column-60 column-offset-20">
                <h2>Simple Auth Project</h2>
                <p>A Sample project to perform Auth operation using Session</p>               
            </div>
        </div>

        <div class="row">
            <div class="column column-60 column-offset-20">
                <?php
                if(true == $_SESSION['loggedin']){
                    echo "Hello Admin! Welcome";
                }else{
                    echo "Hello stranger ! Pls Log In !!";
                }
                ?>                
            </div>
        </div>
                <div class="row">
                    <div class="column column-60 column-offset-20">
                        <?php 
                        if($error){ 
                            echo "<blockquote>Wrong Username or Password</blockquote>" ;
                        }
                        if(false == $_SESSION['loggedin']) {
                        ?>
                        <form method="POST">
                            <label>User Name</label>
                            <input type="text" name="username" id="username" >

                            <label>Password</label>
                            <input type="password" name="password" id="password" >

                            <button type="submit" class="button-primary" name="submit">Log In</button>
                        </form>

                        <?php }else { ?>
                            <form action="auth.php" method="POST">
                                <input type="hidden" name="logout" value="1">
                            <button type="submit" class="button-primary" name="submit">Log Out</button>
                        </form>
                        <?php } ?>
                    </div>
                </div>
    </div>
</body>


</html>