<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/css.css">
</head>
<body>
    <div class="jumbotron">
        <div class="text-center">
            <h2>PlayStation Games Wishlist.</h2>
            <hr>
            <!-- Add new game form. -->
            <form method="post">
                <label for="add">Add new game URL </label>
                <input type="text" name="add" id="add">
                <input type="submit" value="Submit">
            </form>
            <hr>
            <!-- Here the games rows will be appended. -->
            <div id="container" class="text-center"></div>
        </div>
    </div>

    <!-- The common game template row. -->
    <div id="template" style="display: none;">
        <div class="game">
            <div class="grid-container">
                <!-- Game image. -->
                <div class="image grid-item"><img src="" class="game_image img-responsive" alt="Game image" /></div>
                <!-- Gama name and link to the PS  Store game page. -->
                <div class="name grid-item">
                    <a href="" class="game-url" target="_blank"><span class="game-name"></span></a>
                </div>
                <!-- Current price, and if there is disconunt - start and edn dates and plus icon if the discount is PS Plus. -->
                <div class="grid-item">
                    <div class="row">
                        <div class="price col-sm-12"></div>
                    </div>
                    <div class="row">
                        <div class="date-start col-sm-6 dates"></div>
                        <div class="date-end col-sm-6 dates"></div>
                    </div>
                    <div class="row plus-icon-container" style="display: none;">
                        <img src="img/plus.png" class="plus-icon" alt="">
                    </div>
                </div>
                <!-- Original price if there is discount. -->
                <div class="old-price grid-item"></div>
                <!-- Discount percentage if there is discount -->
                <div class="discount grid-item"></div>
                <!-- Delete game from the list link. -->
                <div class="delete">
                    <a href="" class="btn btn-danger btn-sm active confirmation" role="button">
                        <i class="fa fa-trash" aria-hidden="true"></i> Delete
                    </a>
                </div>
            </div>
            <hr>
        </div>
    </div>

<?php // Add/Remove game URL from data.txt PHP functionality

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

    // Pull the URLs from data file.
    if (is_array($lines)) {
        foreach ($lines as $key => $line) {
            if (trim($line) == "") {
                continue;
            }
            echo "<input type=\"hidden\" class=\"hdn_ids\" value=\"" . trim($line) . "\" />" . PHP_EOL;
        }
    }
?>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/row.js"></script>
    <script src="js/js.js"></script>
</body>
</html>
