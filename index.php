<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <link rel="stylesheet" href="css.css">
</head>

<body class="text-center">
    <main role="main" class="inner cover">

        <h1 class="cover-heading">Play Station Wish List.</h1>
        <form action="action.php" method="post">
            <label for="add">Add new game ID </label>
            <input type="text" name="add" id="add">
            <input type="submit" value="Submit">
        </form>
        <hr>
        <div id="container">
            <div id="spinner"></div>
        </div>

        <div id="template" style="display: none;">
            <div class="game">
                <div class="grid-container">
                    <div class="image grid-item"><img src="" class="game_image" alt="Game image" /></div>
                    <div class="name grid-item"></div>
                    <div class="price grid-item"></div>
                    <div class="discount grid-item"></div>
                    <div class="delete grid-item"><a href="action.php?delete=XXX">Delete</a></div>
                </div>
            </div>
        </div>
    </main>

<?php
    $lines = file("data.txt");
    foreach ($lines as $key => $line) {
        if (trim($line) == "") {
            continue;
        }
        echo "<input type=\"hidden\" class=\"hdn_ids\" value=\"" . trim($line) . "\" />" . PHP_EOL;
    }

?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="row.js"></script>
    <script src="js.js"></script>
</body>

</html>