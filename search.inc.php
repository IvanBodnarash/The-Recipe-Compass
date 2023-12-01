<?php
require 'config.php';

// Connecting to db

// $servername = $config['db_host'];
// $username = $config['db_user'];
// $password = $config['db_pass'];
// $dbname = $config['db_name'];

// Creating connection with db
// $conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo "<h2>Sorry, we cannot process your request at this time, please try again later</h2>\n";
    echo "<a href=\"index.php\">Return to Home</a>\n";
    exit;
}

// Retrieving row for searching
$search = $_GET['searchFor'];
$search = mysqli_real_escape_string($conn, $search);
$search = htmlspecialchars($search);
$words = explode(" ", $search);
// $phrase = implode("%' AND title LIKE '%", $words);

// Turning each word into an expression with LIKE
$conditions = array();
foreach($words as $word) {
    $conditions[] = "title LIKE '%$word%'";
}
$whereClause = implode(" OR ", $conditions);

// $query = "SELECT recipeid, title, shortdesc FROM recipes WHERE title LIKE '%$phrase'";
$query = "SELECT recipeid, title, shortdesc FROM recipes WHERE $whereClause";
$result = $conn->query($query);

if (mysqli_num_rows($result) == 0) {
    echo "<div class=\"no-user-banner\">
            <h1>Sorry, no recipes were found with '$search' in them</h1>
            <div class=\"no-user-banner-inner\">
                <a href=\"index.php\">Try again</a>
            </div>
        </div>\n";
    // echo "<h2>Sorry, no recipes were found with '$search' in them.</h2>";
} else {
    echo "<h1>Search Results</h1>\n";
    
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $recipeid = $row['recipeid'];
        $title = $row['title'];
        $shortdesc = $row['shortdesc'];

        echo "<a href=\"index.php?content=showrecipe&id=$recipeid\">$title</a><br>\n";
        echo "$shortdesc<br><br>\n";
    }
}

$conn->close();
?>