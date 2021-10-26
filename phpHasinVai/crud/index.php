<?php
require_once "./inc/functions.php";
$info ='';
$task = $_GET['task'] ?? 'report';
$error = $_GET['error'] ?? '0';
if('seed' == $task){
    seed();
    $info = "Seeding Complete";
}

    $fname = "";
    $lname = "";
    $roll = "";

if(isset($_POST['submit'])){

    $fname = filter_input( INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
    $lname = filter_input( INPUT_POST, 'lname', FILTER_SANITIZE_STRING);
    $roll = filter_input( INPUT_POST, 'roll', FILTER_SANITIZE_STRING);
    $id = filter_input( INPUT_POST, 'id', FILTER_SANITIZE_STRING);

    if($id){
        if($fname != "" && $lname != "" && $roll != ""){
            $result = editStudent($id,$fname,$lname,$roll);
            if($result){
                header("location: /pracphp/hasin_vai_php/index.php?task=report");
            }else{
                $error =1;
            }      
        }
    }else{
        if($fname != "" && $lname != "" && $roll != ""){
            $result = addStudent($fname,$lname,$roll);
            if($result){
                header("location: /pracphp/hasin_vai_php/index.php?task=report");
            }else{
                $error =1;
            }        
        }
    }    
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
                <h2>Project-2 CRUD</h2>
                <p>A Sample project to perform CRUD operation using plain files and PHP</p>
                <?php include_once('./inc/templates/nav.php'); ?>
                <hr/>
                <?php if($info != ""){ 
                     echo "<p>{$info}</p>";
                } ?>
            </div>
        </div>

        <?php if('1' == $error) { ?>
        <div class="row">
            <div class="column column-60 column-offset-20">
                <blockquote>Duplicate Roll Number</blockquote>
            </div>
        </div>
        <?php } ?>

        <?php if('report' == $task) { ?>
        <div class="row">
            <div class="column column-60 column-offset-20">
                <?php generateReport(); ?>
            </div>
        </div>
        <?php } ?>

        <?php if('add' == $task) { ?>
        <div class="row">
            <div class="column column-60 column-offset-20">
                <form action="/pracphp/hasin_vai_php/index.php?task=add" method="POST">
                    <label>First Name</label>
                    <input type="text" name="fname" id="fname" value="<?php echo $fname ?>">

                    <label>Last Name</label>
                    <input type="text" name="lname" id="lname" value="<?php echo $lname ?>">

                    <label>Roll</label>
                    <input type="number" name="roll" id="roll" value="<?php echo $roll ?>">

                    <button type="submit" class="button-primary" name="submit">Save</button>
                </form>
            </div>
        </div>
        <?php } ?>

        <?php if('edit' == $task) { 
            
            $id = filter_input( INPUT_GET, 'id', FILTER_SANITIZE_STRING);
            $student = getStudent($id);
            if($student) {
            ?>

            
        <div class="row">
            <div class="column column-60 column-offset-20">
                <form method="POST">

                <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
                    <label>First Name</label>
                    <input type="text" name="fname" id="fname" value="<?php echo $student['fname'] ?>">

                    <label>Last Name</label>
                    <input type="text" name="lname" id="lname" value="<?php echo $student['lname'] ?>">

                    <label>Roll</label>
                    <input type="number" name="roll" id="roll" value="<?php echo $student['roll'] ?>">

                    <button type="submit" class="button-primary" name="submit">Save</button>
                </form>
            </div>
        </div>
        <?php } } ?>
    </div>
</body>
</html>