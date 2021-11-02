<?php
session_start();

$error = false;

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$fp = fopen("./data/user.txt","r");

if($username && $password){
    $_SESSION['loggedin'] = false;
        $_SESSION['user'] = false;
        $_SESSION['role'] = false;
        while( $data=fgetcsv($fp)){        
        if( $data[0] == $username && $data[1] == sha1($password)){
            $_SESSION['loggedin'] = true;
            $_SESSION['user'] = $username;
            $_SESSION['role'] = $data[2];
            header("location:index.php");
        }
    }
    if(!$_SESSION['loggedin']){
        $error = true;
    }
    
}

if(isset($_GET['logout'])){
    $_SESSION['loggedin'] = false;
    $_SESSION['user'] = false;
    $_SESSION['role'] = false;
    session_destroy();
    header("location:auth.php");
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