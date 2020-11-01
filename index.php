<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/css.css">
</head>
<body>
    <div class="jumbotron">
        <div class="text-center">
            <h2>Play Station Wish List.</h2>
            <hr>
            <!-- Add new game form -->
            <form action="action.php" method="post">
                <label for="add">Add new game ID </label>
                <input type="text" name="add" id="add">
                <input type="submit" value="Submit">
            </form>
            <hr>
        </div>
        <!-- Here the games rows will be appended -->
        <div id="container" class="text-center"></div>
    </div>

    <!-- the common game template row -->
    <div id="template" style="display: none;">
        <div class="game">
            <div class="grid-container">
                <!-- game image -->
                <div class="image grid-item"><img src="" class="game_image img-responsive" alt="Game image" /></div>
                <!-- gama name and link to the PS  Store game page -->
                <div class="name grid-item">
                    <a href="" class="game-url" target="_blank"><span class="game-name"></span></a>
                </div>
                <!-- current price, and if there is disconunt - start and edn dates and plus icon if the discount is PS Plus -->
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
                <!-- original price if there is discount -->
                <div class="old-price grid-item"></div>
                <!-- discount percentage if there is discount -->
                <div class="discount grid-item"></div>
                <!-- delete game from the list link -->
                <div class="delete">
                    <a href="" class="btn btn-danger btn-sm active" role="button"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                </div>
            </div>
            <hr>
        </div>
    </div>

<?php
    // pull the ids from data file.
    $lines = file("data.txt", FILE_SKIP_EMPTY_LINES);
    if (is_array($lines)) {
        foreach ($lines as $key => $line) {
            if (trim($line) == "") {
                continue;
            }
            echo "<input type=\"hidden\" class=\"hdn_ids\" value=\"" . trim($line) . "\" />" . PHP_EOL;
        }
    }
?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="js/row.js"></script>
    <script src="js/js.js"></script>
</body>
</html>
