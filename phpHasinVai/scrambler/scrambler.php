<?php
include_once "./scramblerFunc.php";
$task = 'encode';
if (isset($_GET['task']) && $_GET['task'] != '') {
    $task = $_GET['task'];
}
$original_key = 'abcdefghijklmnopqrstuvwxyz1234567890';
$key = 'abcdefghijklmnopqrstuvwxyz1234567890';
if ('key' == $task) {
    $key_original = str_split($key);
    shuffle($key_original);
    $key = join('', $key_original);
} elseif (isset($_POST['key']) && $_POST['key'] != '') {
    $key = $_POST['key'];
}
$scrambleData = '';
if ('encode' == $task) {
    $data = $_POST['data'] ?? '';
    if ($data != '') {
        $scrambleData = scrambleData($data, $key);
    }
}

if ('decode' == $task) {
    $data = $_POST['data'] ?? '';
    if ($data != '') {
        $scrambleData = decodeData($data, $key);
    }
}
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
    </style>
</head>

<body>
    <div class="container">

        <div class="row">
            <div style="text-align: center;" class="column column-60 column-offset-20">
                <h2>Data Scrambler</h2>
                <p>Use this scrambler to use your data</p>
                <p>
                    <a href="./scrambler.php?task=encode">Encode</a> |
                    <a href="./scrambler.php?task=decode">Decode</a> |
                    <a href="./scrambler.php?task=key">Generate Key</a>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="column column-60 column-offset-20">
                <form method="POST" action="scrambler.php<?php if ('decode' == $task) {
                                                                echo "?task=decode";
                                                            } ?>">
                    <label for="key">Key</label>
                    <input type="text" name="key" id="key" <?php displayKey($key); ?>>

                    <label for="data">Data</label>
                    <textarea id="data" name="data"><?php if (isset($_POST['data'])) {
                                                        echo $_POST['data'];
                                                    } ?></textarea>

                    <label for="result">Result</label>
                    <textarea id="result" name="result"><?php echo $scrambleData; ?></textarea>

                    <button type="submit">DO IT FOR ME</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>