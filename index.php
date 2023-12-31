<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Recipe Compass</title>
    <link rel="icon" href="img/brand-logo.png" type="image/x-icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" media="print" type="text/css" href="print.css">
    <link rel="stylesheet" type="text/css" href="style/main.css">
    <link rel="stylesheet" type="text/css" href="style/media.css">
</head>

<body>
    <div id="header">
        <?php include("header.inc.php"); ?>
    </div>

    <div id="content">

        <div id="main">
            <?php

            if (!isset($_REQUEST['content'])) {
                include("home.inc.php");
            } else {
                $content = $_REQUEST['content'];
                $nextpage = $content . ".inc.php";
                if (file_exists($nextpage)) {
                    include($nextpage);
                } else {
                    echo "File '$nextpage' not found";
                }
            }

            ?>
            <div id="scroll-to-top" class="hidden">
                <a href="#">↑</a>
            </div>
        </div>

    </div>

    <div id="footer">
        <?php include("footer.inc.php"); ?>
    </div>

    <script src="//static.filestackapi.com/filestack-js/3.x.x/filestack.min.js"></script>
    <script src="script/app.js"></script>
    <script src="script/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="script/animations.js"></script>
</body>

</html>