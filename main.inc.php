<!-- <h2>The Latest Recipes</h2><br> -->

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

$query = "SELECT recipeid, poster, title, shortdesc, image_path FROM recipes ORDER BY recipeid DESC LIMIT 0,6";

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

        // Checking if `image_path` is `NULL` and setting the path to `default.jpg` if so
        if ($image == null) {
            $image = 'img/default.jpg';
        }

        echo "<div class=\"recipe-block\"\n>
                <a href=\"index.php?content=showrecipe&id=$recipeid\">
                <div class=\"overlay\">
                    <p>Open</p>
                </div>
                    <h3 class=\"blur-fx\">$title</h3>
                    <img src=\"$image\" alt=\"Hey\" class=\"blur-fx\">\n
                    <div class=\"text-block blur-fx\">
                        <span class=\"blur-fx\">$shortdesc ...</span>
                        <div class=\"text-inner-block blur-fx\">
                            <hr>
                            <div class=\"text-inner\" style=\"display: flex;\">
                                <p>Posted by</p>
                                <span>&nbsp;$poster</span>
                            </div>
                        </div>
                    </div>
                </a>\n
            </div>";
    }
}

$conn->close();
?>