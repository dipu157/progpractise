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
        #main{
            padding: 0px 150px 0px 150px;
        }
        #action{
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
            <h4>All Task</h4>
        <form>
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
                    <tr>
                        <td><input class="label-inline" type="checkbox" value="1"> </td>
                        <td>1</td>
                        <td>Feed Pigeons</td>
                        <td>01 jan 2021</td>
                        <td><a href="#">Edit</a> | <a href="#"> Delete | <a href="#"> Complete </a> </td>
                    </tr>

                    <tr>
                        <td><input class="label-inline" type="checkbox" value="1"> </td>
                        <td>1</td>
                        <td>Gardening</td>
                        <td>01 jan 2021</td>
                        <td><a href="#">Edit</a> | <a href="#"> Delete | <a href="#"> Complete </a> </td>
                    </tr>
                </tbody>
            </table>

            <select id="action">
                <option value="0" >With Selected</option>
                <option value="del" >Delete</option>
                <option value="complete" > Mark as complete</option>
            </select>
            <input class="button-primary" type="submit" value="submit">
        </form>
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
                        if($added){
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
</body>

</html>