<?php
include_once("config.php");
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$connection) {
    throw new Exception("Cannot Connect To Database");
} else {
    $action = $_POST['action'] ?? "";

    if (! $action) {
        header("Location: index.php");
        die();
    } else {
        if ("add" == $action) {
            $task = $_POST['task'];
            $date = $_POST['date'];

            if ($task && $date) {

                $query = "INSERT INTO `task`(`task`, `date`) VALUES ('{$task}','{$date}')";
                mysqli_query($connection,$query);
                header('Location: index.php?added=true');
            }
        }else if("complete" == $action){
            $taskid = $_POST['taskid'];
            if($taskid){
                $query = "UPDATE task set complete=1 where id={$taskid} limit 1";
                mysqli_query($connection,$query);                
            }
            header('Location: index.php');
        }
        
        else if("delete" == $action){
            $taskid = $_POST['taskid'];
            if($taskid){
                $query = "DELETE FROM task where id={$taskid} limit 1";
                mysqli_query($connection,$query);                
            }
            header('Location: index.php');
        }

        else if("incomplete" == $action){
            $taskid = $_POST['taskid'];
            if($taskid){
                $query = "UPDATE task set complete=0 where id={$taskid} limit 1";
                mysqli_query($connection,$query);                
            }
            header('Location: index.php');
        }

        else if("bulkcomplete" == $action){
            $taskids = $_POST['taskids'];
            $_taskids = join(",",$taskids);
            if($taskids){
                $query = "UPDATE task set complete=1 where id in ($_taskids)";
                mysqli_query($connection,$query);                
            }
            header('Location: index.php');
        }

        else if("bulkdel" == $action){
            $taskids = $_POST['taskids'];
            $_taskids = join(",",$taskids);
            if($taskids){
                $query = "DELETE FROM task where id in ($_taskids)";
                mysqli_query($connection,$query);                
            }
            header('Location: index.php');
        }
    }
}
