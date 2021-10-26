<?php
function displayKey($key)
{
    printf("Value = '%s'", $key);
}

function scrambleData($originalData, $key)
{
    $originalkey = 'abcdefghijklmnopqrstuvwxyz1234567890';
    $data = '';
    $length = strlen($originalData);
    for ($i = 0; $i < $length; $i++) {
        $currentChar = $originalData[$i];
        $position = strpos($originalkey, $currentChar);
        if ($position !== false) {
            $data .= $key[$position];
        } else {
            $data .= $currentChar;
        }
    }

    return $data;
}

function decodeData($originalData, $key)
{
    $originalkey = 'abcdefghijklmnopqrstuvwxyz1234567890';
    $data = '';
    $length = strlen($originalData);
    for ($i = 0; $i < $length; $i++) {
        $currentChar = $originalData[$i];
        $position = strpos($key, $currentChar);
        if ($position !== false) {
            $data .= $originalkey[$position];
        } else {
            $data .= $currentChar;
        }
    }

    return $data;
}
