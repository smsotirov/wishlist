<?php

// Add new game ID to the data file. The datafile have to be chmod 666
if (isset($_POST["add"])) {

    // Check if the game is already in.
    $lines = file("data.txt", FILE_SKIP_EMPTY_LINES);
    if (in_array($_POST["add"] . PHP_EOL, $lines)) {
        header("Location: /wishlist");
        return;
    }

    $fp = fopen("data.txt", "a"); // Opens file in append mode  
    fwrite($fp, $_POST["add"] . PHP_EOL);
    fclose($fp);
}

// Delete an ID from the data file
if (isset($_GET["delete"])) {
    $lines = file("data.txt", FILE_SKIP_EMPTY_LINES);
    if (is_array($lines)) {
        foreach ($lines as $key => $line) {
            if (trim($line) == trim($_GET["delete"])) {
                unset($lines[$key]);
            }
        }
        file_put_contents('data.txt', $lines);
    }
}

// Redirect to index
header("Location: /wishlist");
