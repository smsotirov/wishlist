<?php
    // Add/Remove game URL from data.txt PHP functionality
    $lines = file("data.txt", FILE_SKIP_EMPTY_LINES);

    // Add new game URL to the data file.
    if (isset($_POST["add"]) && $_POST["add"] != "") {

        // Check if the game is already in.
        if (!in_array($_POST["add"] . PHP_EOL, $lines)) {
            $fp = fopen("data.txt", "a"); // Opens file in append mode  .
            fwrite($fp, $_POST["add"] . PHP_EOL);
            fclose($fp);
            // Remove the GET (if any) params and redirect ro initial URL.
            header("Location: " . str_replace("?" . $_SERVER["QUERY_STRING"], "", $_SERVER["REQUEST_URI"]));
            return;
        }
    }

    // Delete an game URL from the data file.
    if (isset($_GET["delete"])) {
        if (is_array($lines)) {
            foreach ($lines as $key => $line) {
                if (trim($line) == trim($_GET["delete"])) {
                    unset($lines[$key]);
                    file_put_contents('data.txt', $lines);

                    // Remove the GET params and redirect ro initial URL.
                    header("Location: " . str_replace("?" . $_SERVER["QUERY_STRING"], "", $_SERVER["REQUEST_URI"]));
                    return;
                }
            }
        }
    }
