<?php
require 'config.php';

// Connection check

if ($conn->connect_error) {
    echo "<div class=\"no-user-banner\">
            <h1>Sorry, we cannot process your request at this time, please try again later</h1>
            <div class=\"no-user-banner-inner\">
                <a href=\"index.php?content=login\">Try again</a>
                <p>&ensp;/&ensp;</p>
                <a href=\"index.php\">Home</a>
            </div>
        </div>\n";
    exit;
}

$query = "SELECT recipeid, poster, title, shortdesc, image_path FROM recipes ORDER BY recipeid DESC LIMIT 0,6";

$result = $conn->query($query);

if (mysqli_num_rows($result) == 0) {
    echo "<div class=\"no-user-banner\">
            <h1>Sorry, there are no recipes posted at this time, please try back later</h1>
        </div>\n";
} else {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $recipeid = $row['recipeid'];
        $poster = $row['poster'];
        $title = $row['title'];
        $shortdesc = $row['shortdesc'];

        $maxLengthWords = 20;
        $words = str_word_count($shortdesc, 1);

        if (count($words) > $maxLengthWords) {
            $words = array_slice($words, 0, $maxLengthWords);

            $shortdesc = implode(' ', $words) . '...';
        }

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
                    <div class=\"content-wrapper\">
                        <h3>$title</h3>
                        <img src=\"$image\" alt=\"Recipe img\">\n
                        <div class=\"text-block\">
                            <span>$shortdesc</span>
                            <div class=\"text-inner-block \">
                                <hr>
                                <div class=\"text-inner\" style=\"display: flex;\">
                                    <p>Posted by</p>
                                    <span>&nbsp;$poster</span>
                                </div>
                            </div>
                        </div>
                    </div>\n
                </a>\n
            </div>";
    }
}

$conn->close();
?>