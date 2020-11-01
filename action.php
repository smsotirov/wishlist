<?php

// add new game ID to the data file. The datafile have to be chmod 666
if (isset($_POST["add"])) {
    $fp = fopen("data.txt", "a"); //opens file in append mode  
    fwrite($fp, $_POST["add"] . PHP_EOL);
    fclose($fp);
}

// delete an ID from the data file
if (isset($_GET["delete"])) {
    $lines = file("data.txt");

    foreach ($lines as $key => $line) {
        if (trim($line) == trim($_GET["delete"])) {
            unset($lines[$key]);
        }
    }

    file_put_contents('data.txt', $lines);
}

// redirect to index
header("Location: /wishlist");
