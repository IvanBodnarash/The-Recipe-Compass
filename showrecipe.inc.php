<?php
require 'config.php';

// Auth check
session_write_close();
session_start();

if (isset($_SESSION['valid_recipe_user'])) {
    $userIsLoggedIn = true;
} else {
    $userIsLoggedIn = false;
}

// // Check if the user is logged in and has permission to post comments
// if (!isset($_SESSION['valid_recipe_user']) || !isset($_SESSION['can_post_comments'])) {
//     echo "Sorry, you do not have permission to post comments.";
//     exit;
// }

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

$recipeid = $_GET['id'];

$query = "SELECT title, poster, shortdesc, ingredients, directions, image_path FROM recipes WHERE recipeid = $recipeid";

$result = $conn->query($query);
$row = $result->fetch_array(MYSQLI_ASSOC);

$title = $row['title'];
$poster = $row['poster'];
$shortdesc = $row['shortdesc'];
$ingredients = $row['ingredients'];
$directions = $row['directions'];
$image = $row['image_path'];
$ingredients = nl2br($ingredients);
$directions = nl2br($directions);

// Checking if `image_path` is `NULL` and setting the path to `default.jpg` if so
if ($image == null) {
    $image = 'default.jpg';
}

echo "<h2>$title</h2>";
echo "by $poster <br><br>\n";
echo "$shortdesc <br><br>\n";

echo "<h3>Ingredients:</h3>\n";
echo "$ingredients <br><br>\n";

echo "<h3>Directions:</h3>\n";
echo "$directions <br><br>\n";

echo "<img src=\"img/$image\" width=\"200px\" alt=\"Hey\"><br><br>\n";

echo "<br><br>\n";

$query = "SELECT count(commentid) FROM comments WHERE recipeid = $recipeid";

$result = $conn->query($query);
$row = mysqli_fetch_array($result);
$totrecords = $row[0];

echo "<h2>Comments:</h2>\n";

if ($row[0] == 0) {
    echo "No comments posted yet.&nbsp;&nbsp;\n";

    // Auth check before adding comments
    if ($userIsLoggedIn) {
        echo "<a href=\"index.php?content=newcomment&id=$recipeid\">Add a comment</a>\n";
    } else {
        echo "Please <a href=\"index.php?content=login\">log in</a> to leave a comment.\n";
    }
    echo "&nbsp;&nbsp;&nbsp;<a href=\"print.php?id=$recipeid\" target=\"_blank\">Print recipe</a>\n";
    echo "<hr>\n";
} else {
    echo $row[0] . "\n";
    echo "&nbsp;comments posted.&nbsp;&nbsp;\n";

    // Auth check before adding comments
    if ($userIsLoggedIn) {
        echo "<a href=\"index.php?content=newcomment&id=$recipeid\">Add a comment</a>\n";
    } else {
        echo "Please <a href=\"index.php?content=login\">log in</a> to leave a comment.\n";
    }
    // echo "<a href=\"index.php?content=newcomment&id=$recipeid\">Add a comment</a>\n";
    echo "&nbsp;&nbsp;&nbsp;<a href=\"print.php?id=$recipeid\" target=\"_blank\">Print recipe</a>\n";
    echo "<hr>\n";
    echo "<h2>Comments:</h2>\n";

    if (!isset($_GET['page'])) {
        $thispage = 1;
    } else {
        $thispage = $_GET['page'];
    }

    $recordsperpage = 5;

    $offset = ($thispage - 1) * $recordsperpage;
    $totpages = ceil($totrecords / $recordsperpage);

    $query = "SELECT date,poster,comment FROM comments WHERE recipeid = $recipeid ORDER BY commentid DESC";
    $result = $conn->query($query);
    // $result = mysqli_query($conn, $query) or die('Could npt retrieve comments');

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $date = $row['date'];
        $poster = $row['poster'];
        $comment = $row['comment'];
        $comment = nl2br($comment);

        echo "$date - posted by $poster<br>\n";
        echo "$comment\n";
        echo "<br><br>\n";
    }

    if ($thispage > 1) {
        $page = $thispage - 1;

        $prevpage = "<a href=\"index.php?content=showrecipe&id=$recipeid&page=$page\">Prev</a>";
    } else {
        $prevpage = "";
    }

    $bar = '';

    if ($totpages > 1) {
        for ($page = 1; $page <= $totpages; $page++) {
            if ($page == $thispage) {
                $bar .= " $page ";
            } else {
                $bar .= " <a href=\"index.php?content=showrecipe&id=$recipeid&page=$page\">$page</a> ";
            }
        }
    }

    if ($thispage < $totpages) {
        $page = $thispage + 1;

        $nextpage = " <a href=\"index.php?content=showrecipe&id=$recipeid&page=$page\">Next</a>";
    } else {
        $nextpage = "";
    }

    echo "GoTo: " . $prevpage . $bar . $nextpage;

    if ($userIsLoggedIn) {
        echo "<hr>\n";
        echo "<a href=\"index.php?content=newcomment&id=$recipeid\">Add a comment</a>\n";
    }
}

$conn->close();
?>