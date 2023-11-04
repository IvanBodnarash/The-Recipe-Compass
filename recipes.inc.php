<?php
require 'config.php';

// // Connecting to db

// $servername = $config['db_host'];
// $username = $config['db_user'];
// $password = $config['db_pass'];
// $dbname = $config['db_name'];

// // Creating connection with db
// $conn = new mysqli($servername, $username, $password, $dbname);

// Connection check
if ($conn->connect_error) {
    echo "<h2>Sorry, we cannot process your request at this time, please try again later</h2>\n";
    echo "<a href=\"index.php\">Return to Home</a>\n";
    exit;
}

// mysqli_select_db("recipe", $con) or die ('Sorry, could not connect to database');

$query = "SELECT recipeid, poster, title, shortdesc, image_path FROM recipes ORDER BY title";

$result = $conn->query($query);

// $result = mysqli_query($con, $query) or die('Sorry, could not get recipes at this time');

if (mysqli_num_rows($result) == 0) {
    echo "<h3>Sorry, there are no recipes posted at this time, please try back later.</h3>";
} else {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $recipeid = $row['recipeid'];
        $poster = $row['poster'];
        $title = $row['title'];
        $shortdesc = $row['shortdesc'];
        $image = $row['image_path'];

        //     echo "<div style=\"border: 2px solid black;\">
        //     <h1>Lorem</h1>
        //     <p>Lorem, ipsum dolor.</p>
        // </div>";

        // Checking if `image_path` is `NULL` and setting the path to `default.jpg` if so
        if ($image == null) {
            $image = 'default.jpg';
        }
        
        echo "<a href=\"index.php?content=showrecipe&id=$recipeid\">$title</a> submitted by $poster <br>\n";
        echo "$shortdesc<br><br>\n";
        echo "<img src=\"img/$image\" width=\"200px\" alt=\"Hey\"><br><br>\n";
        // echo "<img src=\"$image\" width=\"200px\" alt=\"Hey\"><br><br>\n";
        // var_dump($image);
    }
}

$conn->close();
?>