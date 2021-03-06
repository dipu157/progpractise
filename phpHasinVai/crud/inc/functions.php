<?php
//define('DB_Name', 'C:\xampp\htdocs\progpractise\phpHasinVai\crud\data\db.txt');
define('DB_Name', 'C:\Apache24\htdocs\progpractise\phpHasinVai\crud\data\db.txt');
function seed()
{
    $data = array(
        array(
            'id' => '1',
            'fname' => 'Abid',
            'lname' => 'Hossain',
            'roll' => '10'
        ),
        array(
            'id' => '2',
            'fname' => 'Kobir',
            'lname' => 'Khan',
            'roll' => '11'
        ),
        array(
            'id' => '3',
            'fname' => 'Jamal',
            'lname' => 'Bjuiyan',
            'roll' => '104'
        ),
        array(
            'id' => '4',
            'fname' => 'Rakib',
            'lname' => 'Afnan',
            'roll' => '56'
        ),
    );

    $serializaData = serialize($data);
    file_put_contents(DB_Name, $serializaData, LOCK_EX);
}

function generateReport()
{

    $serializaData = file_get_contents(DB_Name);

    $students = unserialize($serializaData);
?>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Roll</th>
            <th>Action</th>
        </tr>
        <?php foreach ($students as $student) { ?>

            <tr>
                <td><?php printf('%s', $student['id']); ?></td>
                <td><?php printf('%s %s', $student['fname'], $student['lname']) ?></td>
                <td><?php printf('%s', $student['roll']); ?></td>
                <td>
                    <?php if(isAdmin() || isEditor()): ?>
                    <?php printf('<a href="/progpractise/phpHasinVai/crud/index.php?task=edit&id=%s">Edit</a> 
                    | <a class="delete" href="/progpractise/phpHasinVai/crud/index.php?task=delete&id=%s">Delete</a>', $student['id'], $student['id']); ?>
                    <?php endif ?>
                </td>
            </tr>
        <?php } ?>
    </table>
<?php
}

function addStudent($fname, $lname, $roll)
{
    $found = false;
    $serializaData = file_get_contents(DB_Name);
    $students = unserialize($serializaData);

    foreach ($students as $stu) {
        if ($stu['roll'] == $roll) {
            $found = true;
            break;
        }
    }

    if (!$found) {
        $newId = getNewId($students);
        $student = array(
            'id' => $newId,
            'fname' => $fname,
            'lname' => $lname,
            'roll' => $roll
        );
        array_push($students, $student);
        $serializaData = serialize($students);
        file_put_contents(DB_Name, $serializaData, LOCK_EX);
        return true;
    } else {
        return false;
    }
}

function getStudent($id)
{
    $serializaData = file_get_contents(DB_Name);
    $students = unserialize($serializaData);

    foreach ($students as $stu) {
        if ($stu['id'] == $id) {
            return $stu;
        }
    }
    return false;
}

function editStudent($id, $fname, $lname, $roll)
{
    $found = false;
    $serializaData = file_get_contents(DB_Name);
    $students = unserialize($serializaData);
    foreach ($students as $stu) {
        if ($stu['roll'] == $roll && $stu['id'] != $id) {
            $found = true;
            break;
        }
    }

    if (!$found) {
        $students[$id - 1]['fname'] = $fname;
        $students[$id - 1]['lname'] = $lname;
        $students[$id - 1]['roll'] = $roll;

        $serializaData = serialize($students);
        file_put_contents(DB_Name, $serializaData, LOCK_EX);
        return true;
    } else {
        return false;
    }
}

function delete($id)
{
    $serializaData = file_get_contents(DB_Name);
    $students = unserialize($serializaData);

    foreach ($students as $offset => $stu) {
        if ($stu['id'] == $id) {
            unset($students[$offset]);;
        }
    }


    $serializaData = serialize($students);
    file_put_contents(DB_Name, $serializaData, LOCK_EX);
}

function printRaw()
{
    $serializaData = file_get_contents(DB_Name);
    $students = unserialize($serializaData);

    print_r($students);
}

function getNewId($students)
{
    $maxId = max(array_column($students, 'id'));
    return $maxId + 1;
}

function isAdmin(){
    return ('admin' == $_SESSION['role']);
}

function isEditor(){
    return ('editor' == $_SESSION['role']);
}
?>