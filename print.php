<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="print.css" />
    <title>The Recipe Center</title>
    <script>
        window.print();
    </script>
</head>
<body>
    <?php

    require 'config.php';

    // Connecting to db
    $servername = $config['db_host'];
    $username = $config['db_user'];
    $password = $config['db_pass'];
    $dbname = $config['db_name'];

    // Creating connection with db
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        echo "<h2>Sorry, we cannot process your request at this time, please try again later</h2>\n";
        echo "<a href=\"index.php\">Return to Home</a>\n";
        exit;
    }
    // $con = mysqli_connect("localhost", "test", "test159951test!") or die('Sorry, could not connect to database server!');

    // mysqli_select_db("recipe", $con) or die('Could not connect to database');

    $recipeid = $_GET['id'];

    $query = "SELECT title, poster, shortdesc, ingredients, directions FROM recipes WHERE recipeid = $recipeid";

    $result = $conn->query($query);

    $row = $result->fetch_array(MYSQLI_ASSOC);

    $title = $row['title'];
    $poster = $row['poster'];
    $shortdesc = $row['shortdesc'];
    $ingredients = $row['ingredients'];
    $directions = $row['directions'];
    $ingredients = nl2br($ingredients);
    $directions = nl2br($directions);

    echo "<h2>$title</h2>";
    echo "posted by $poster <br><br>\n";
    echo $shortdesc . "\n";

    echo "<h3>Ingredients:</h3>\n";
    echo $ingredients . "\n";

    echo "<h3>Directions:</h3>\n";
    echo "$directions";

    $conn->close();
    ?>
</body>
</html>