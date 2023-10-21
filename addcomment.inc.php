<?php
// session_start();
require 'config.php';

if (isset($_SESSION['valid_recipe_user']) && $_SESSION['can_post_comments'] === true) {
    // The user has the right to add comments
    // Get the comment data from the form, for example $comment
    // Get the username from the session if available
    $poster = isset($_SESSION['valid_recipe_user']) ? $_SESSION['valid_recipe_user'] : "Anonymous";

    // Connecting to db

    // //Get Heroku ClearDB connection information
    // $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    // $cleardb_server = $cleardb_url["host"];
    // $cleardb_username = $cleardb_url["user"];
    // $cleardb_password = $cleardb_url["pass"];
    // $cleardb_db = substr($cleardb_url["path"], 1);
    // $active_group = 'default';
    // $query_builder = TRUE;
    // // Connect to DB
    // $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

    // $servername = $config['db_host'];
    // $username = $config['db_user'];
    // $password = $config['db_pass'];
    // $dbname = $config['db_name'];

    // $servername = "localhost";
    // $username = "test";
    // $password = "test159951test!";
    // $dbname = "recipe";

    // Creating connection with db
    // $conn = new mysqli($servername, $username, $password, $dbname);

    // Checking connection
    if ($conn->connect_error) {
        die("Database connection error: " . $conn->connect_error);
    }

    // Retrieving data
    $recipeid = $_POST['recipeid'];
    // $poster = $_POST['poster'];
    $comment = htmlspecialchars($_POST['comment']);
    $date = date("Y-m-d");

    // mysqli_select_db("recipe", $con) or die('Could not connect to database');

    $query = "INSERT INTO comments (recipeid, poster, date, comment) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isss", $recipeid, $poster, $date, $comment);

    // $result = mysqli_query($con, $query);

    if ($stmt->execute()) {
        echo "<h2>Comment posted</h2>\n";
        echo "<a href=\"index.php\">Return to Home</a>\n";
    } else {
        echo "<h2>Sorry, there was a problem posting your comment</h2>\n";
        echo "<a href=\"index.php?content=showrecipe&id=$recipeid\">Return to recipe</a>\n";
    }

    // if ($conn->query($query) === TRUE) {
    // } else {
    //     echo "<h2>Sorry, there was a problem posting your comment</h2>\n";
    //     echo "<a href=\"index.php?content=showrecipe&id=$recipeid\">Return to recipe</a>\n";
    // }

    $stmt->close();
    $conn->close();
} else {
    // The user does not have the right to add comments
    echo "<h2>Sorry, you do not have permission to post comments</h2>";
    echo "<a href=\"index.php\">Return to Home</a>\n";
}
?>