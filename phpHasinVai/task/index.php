<?php
include_once "config.php";
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$connection) {
    throw new Exception("Cannot Connect To Database");
}

$query = "select * from task where complete = 0";
$result = mysqli_query($connection, $query);

$CompleteQuery = "select * from task where complete = 1";
$ComResult = mysqli_query($connection, $CompleteQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>form Example</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
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
            <div style="text-align: center;" class="column column-60 column-offset-20">
                <h2>Task Manager</h2>
                <p>This is a simple task manager for managing our day to day task.</p>
            </div>
        </div>

        <div class="row">
            <div class="column column-60 column-offset-20">

                <?php
                if (mysqli_num_rows($ComResult) > 0) {
                ?>
                    <h4>Complete Tasks</h4>
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Task</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            while ($cdata = mysqli_fetch_assoc($ComResult)) {
                                $timestamp = strtotime($cdata['date']);
                                $cdate = date("jS M, Y", $timestamp);
                            ?>
                                <tr>
                                    <td><input class="label-inline" type="checkbox" value="<?php echo $cdata['id']; ?>"> </td>
                                    <td><?php echo $cdata['id']; ?></td>
                                    <td><?php echo $cdata['task']; ?></td>
                                    <td><?php echo $cdate; ?></td>
                                    <td><a href="#"> Delete </td>
                                </tr>
                        <?php }
                        }
                        ?>
                        </tbody>
                    </table>

                    <?php
                    if (mysqli_num_rows($result) == 0) {
                    ?>
                        <p>No Task Found</p>
                    <?php } else { ?>
                        <h4>Upcoming Task</h4>
                        <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Task</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                while ($data = mysqli_fetch_assoc($result)) {
                                    $timestamp = strtotime($data['date']);
                                    $date = date("jS M, Y", $timestamp);
                                ?>
                                    <tr>
                                        <td><input class="label-inline" type="checkbox" value="<?php echo $data['id']; ?>"> </td>
                                        <td><?php echo $data['id']; ?></td>
                                        <td><?php echo $data['task']; ?></td>
                                        <td><?php echo $date; ?></td>
                                        <td><a href="#"> Delete | <a class="complete" data-taskid="<?php echo $data['id']; ?>" href="#"> Complete </a> </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <select id="action">
                            <option value="0">With Selected</option>
                            <option value="del">Delete</option>
                            <option value="complete"> Mark as complete</option>
                        </select>
                        <input class="button-primary" type="submit" value="submit">
                    <?php } ?>
            </div>
        </div>


        <p>....</p>


        <div class="row">
            <div class="column column-60 column-offset-20">
                <h4>ADD Task</h4>
                <form method="POST" action="tasks.php">
                    <fieldset>
                        <?php
                        $added = $_GET['added'] ?? "";
                        if ($added) {
                            echo '<p>Task Successfully added</p>';
                        } ?>
                    </fieldset>
                    <label for="task">Task</label>
                    <input type="text" placeholder="Task Details" id="task" name="task">

                    <label for="date">Date</label>
                    <input type="text" placeholder="Task Date" id="date" name="date">

                    <button type="submit" value="addTask">ADD TASK</button>
                    <input type="hidden" name="action" value="add">
                </form>
            </div>
        </div>
    </div>

    <form action="tasks.php" method="post" id="completeform">
        <input type="hidden" id="caction" name="action" value="complete">
        <input type="hidden" id="taskid" name="taskid">
    </form>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
<script>
    ;(function($){
        $(document).ready(function(){
            $(".complete").on('click',function(){
                var id = $(this).data("taskid");
                $("#taskid").val(id);
                $("#completeform").submit();
            })
        });
    })(jQuery);
</script>
</html>