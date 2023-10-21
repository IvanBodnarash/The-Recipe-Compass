<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="mystyle.css" />
    <link rel="stylesheet" media="print" type="text/css" href="print.css" />
    <title>The Recipe Center</title>
</head>

<body>
    <div id="header">
        <?php include("header.inc.php"); ?>
    </div>

    <div id="content">
        <div id="nav">
            <?php include("nav.inc.php"); ?>
        </div>

        <div id="main">
            <?php

            // // Default content if 'content' parameter is not set
            // $defaultContent = "main";

            // // Define an array of allowed content
            // $allowedContent = ["main", "about", "recipes", "contact"];

            // // Get the 'content' parameter or use the default
            // $content = isset($_GET['content']) ? $_GET['content'] : $defaultContent;

            // // Check if the content is allowed
            // if (!in_array($content, $allowedContent)) {
            //     echo "File '$content' not found";
            // } else {
            //     $nextpage = __DIR__ . "/{$content}.inc.php";
            //     if (file_exists($nextpage)) {
            //         include($nextpage);
            //     } else {
            //         echo "File '$nextpage' not found";
            //     }
            //     echo "<h1>{$content}</h1>";
            // }


            if (!isset($_REQUEST['content'])) {
                include("main.inc.php");

            } else {
                $content = $_REQUEST['content'];
                $nextpage = $content . ".inc.php";
                if (file_exists($nextpage)) {
                    include($nextpage);
                } else {
                    echo "File '$nextpage' not found";
                }

                // echo "<h1>$content</h1>";
            }

            ?>
        </div>

        <!-- <div id="news">
            <?php include("news.inc.php"); ?>
        </div> -->
    </div>

    <div id="footer">
        <?php include("footer.inc.php"); ?>
    </div>
</body>

</html>