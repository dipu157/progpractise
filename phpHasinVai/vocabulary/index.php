<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>form Example</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <style>
        body {
            margin-top: 30px;
        }

        #main {
            padding: 0px 150px 0px 150px;
        }

        #action {
            width: 150px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="column column-60 column-offset-20">

            <h1 style="text-align: center; color:brown;"> My Vocabulary </h1>

                <div class="formaction">
                    <a href="#" id="login">Login</a> | <a href="#" id="register">Register</a>
                </div>

                <div class="formc">
                    <form id="form01" method="POST" action="task.php">
                        <h3>Register</h3>
                        <fieldset>
                            <label for="email">Email</label>
                            <input type="email" placeholder="Email" id="email" name="email">

                            <label for="password">Password</label>
                            <input type="password" placeholder="Password" id="password" name="password">

                            <button type="submit" value="register">Register</button>
                            <input type="hidden" name="action" id="action" value="register">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="./assets/js/script.js"></script>
</html>