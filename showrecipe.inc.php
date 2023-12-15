<!-- <div class="recipe-block-main">
    <div class="page-banner">
        <h1>Tiramisu</h1>
        <nav>
            <a href="index.php">Home</a>
            <p>&ensp;/&ensp;</p>
            <p>Tiramisu</p>
        </nav>
    </div>
    <div class="page-content">
        <div class="recipe-block-single">
            <div class="recipe-block-wrapper">
                <div class="img-recipe">
                    <img src="img/default.jpg" alt="">
                    <div class="print-item">
                        <i class="fa-solid fa-print"></i>
                        <a href="print.php?id=$recipeid" target="_blank">Print recipe</a>
                    </div>
                </div>
                <div class="sidebar-wrapper">
                    <div class="recipe-sidebar">
                        <h1>Author / User</h1>
                        <div class="author-block">
                            <div class="author-inner-block">
                                <img src="img/cook.jpg" style="width: 50px" alt="">
                                <h2>Jiovanni Marcelli</h2>
                            </div>
                            <span>Posted On: 24 November, 2023</span>
                        </div>
                    </div>
    
                    <div class="recipe-sidebar">
                        <span class="description">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consequatur quo ipsum nemo ipsa totam velit.</span>
                    </div>
                </div>
            </div>

            <div class="ingredients-block">
                <div class="ingredients-block-container">
                    <i class="fa-solid fa-seedling"></i>
                    <h1>Ingredients</h1>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="ing1">
                    <label for="ing1">Ladyfingers: I buy them, but you could make them from scratch</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="ing2">
                    <label for="ing2">Mascarpone: it wouldn’t be true tiramisu without mascarpone, but if you absolutely must, you could substitute cream cheese</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="ing3">
                    <label for="ing3">Coffee: I use espresso</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="ing4">
                    <label for="ing4">Heavy Whipped cream</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="ing5">
                    <label for="ing5">Granulated Sugar</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="ing6">
                    <label for="ing6">Vanilla extract: or substitute imitation vanilla</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="ing7">
                    <label for="ing7">Cocoa powder: for dusting on top</label>
                </div>
            </div>

            <hr>

            <div class="directions-block">
                <div class="directions-block-container">
                    <i class="fa-solid fa-layer-group"></i>
                    <h1>Directions</h1>
                </div>
                <div class="sequence">
                    <ul class="directions-list">
                        <li class="directions-item">Mix creamy filling. Beat the mascarpone, cream, sugar, and vanilla together until stiff peaks.</li>
                        <li class="directions-item">Dip lady fingers. Add the espresso and liqueur (if using) to a shallow bowl and dip the lady fingers on both sides (don’t let them soak–just a quick dip!)
                        </li>
                        <li class="directions-item">Layer mascarpone. Smooth a layer of the mascarpone/whipped cream mixture on top of the lady fingers.</li>
                        <li class="directions-item">Repeat. Add another layer of lady fingers (dipped in coffee and liqueur) and another layer of cheese mixture. Dust with cocoa powder.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="comments-section">
            <div class="comments-block">
                <i class="fa-solid fa-comments"></i>
                <h1>Comments</h1>
            </div>
            <div class="comments-info-section">
                <span>1 comments posted</span>
            </div>
            <div class="comments-section-btns">
                <div class="add-comment-btn">
                    <i class="fa-solid fa-square-plus"></i>
                    <a href="index.php?content=newcomment&id=$recipeid">Add a comment</a>
                </div>
                <div class="print-item-comments">
                    <i class="fa-solid fa-print"></i>
                    <a href="print.php?id=$recipeid" target="_blank">Print recipe</a>
                </div>
            </div>

            <div class="comment-container">
                <div class="comment-author">
                    <h2>Luiggi Piaciolla</h2>
                </div>
                <div class="comment-text">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil excepturi possimus mollitia, sunt est modi. Nemo sequi distinctio in! Error repudiandae dolorem expedita consequuntur dolores! Lorem ipsum dolor sit, amet consectetur adipisicing elit. Obcaecati enim iure illum aliquam deserunt optio!</p>
                </div>
                <div class="date-posted">
                    <p>24 November, 2023</p>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="recipe-block-main">
    <?php
    require 'config.php';

    // Auth check
    session_write_close();
    // session_start();
    
    if(isset($_SESSION['valid_recipe_user'])) {
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
    if($conn->connect_error) {
        echo "<div class=\"no-user-banner\">
                <h1>Sorry, we cannot process your request at this time, please try again later</h1>
                <div class=\"no-user-banner-inner\">
                    <a href=\"index.php?content=login\">Try again</a>
                    <p>&ensp;/&ensp;</p>
                    <a href=\"index.php\">Home</a>
                </div>
            </div>\n";
    }

    $recipeid = $_GET['id'];

    $query = "SELECT title, poster, shortdesc, ingredients, directions, image_path, date FROM recipes WHERE recipeid = $recipeid";

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

    $datePost = $row['date'];
    $datePostFormatted = date("d F, Y", strtotime($datePost));

    // Checking if `image_path` is `NULL` and setting the path to `default.jpg` if so
    if($image == null) {
        $image = 'img/default.jpg';
    }

    echo "<div class=\"page-banner\">
            <h1>$title</h1>
            <nav>
                <a href=\"index.php\">Home</a>
                <p>&ensp;/&ensp;</p>
                <p>$title</p>
            </nav>
        </div>";

    echo "<div class=\"page-content\">";
    echo "<div class=\"recipe-block-single\">";
    echo "<div class=\"recipe-block-wrapper\">
            <div class=\"img-recipe\">
                <img src=\"$image\" alt=\"img\">
                <div class=\"print-item\">
                    <i class=\"fa-solid fa-print\"></i>
                    <a href=\"print.php?id=$recipeid\" target=\"_blank\">Print recipe</a>
                </div>
            </div>
            <div class=\"sidebar-wrapper\">
                <div class=\"recipe-sidebar\">
                    <h1>Author / User</h1>
                    <div class=\"author-block\">
                        <div class=\"author-inner-block\">
                            <img src=\"img/cook.jpg\" alt=\"cookimg\">
                            <h2>$poster</h2>
                        </div>
                        <span>Posted On: $datePostFormatted</span>
                    </div>
                </div>

                <div class=\"recipe-sidebar\">
                    <span class=\"description\">$shortdesc</span>
                </div>
            </div>
        </div>";

    // INGREDIENTS BLOCK
    
    echo "<div class=\"ingredients-block\">";
    echo "<div class=\"ingredients-block-container\">
            <i class=\"fa-solid fa-seedling\"></i>
            <h1>Ingredients</h1>
        </div>";
    echo "<div class=\"ingredients-block-inner\">";

    if(!empty($row['ingredients'])) {
        $ingredients = unserialize($row['ingredients']);

        $i = 1;

        foreach($ingredients as $ingredient) {
            echo "<div class=\"form-check\">
                    <input type=\"checkbox\" class=\"form-check-input\" id=\"ing$i\" onchange=\"toggleStrikethrough('ing$i')\">
                    <label for=\"ing$i\" id=\"label_ing$i\">$ingredient</label>
                </div>";
            $i++;
        }
    }
    echo "</div>";
    echo "</div>";

    echo "<hr>";

    // DIRECTIONS BLOCK
    
    echo "<div class=\"directions-block\">";
    echo "<div class=\"directions-block-container\">
            <i class=\"fa-solid fa-layer-group\"></i>
            <h1>Directions</h1>
        </div>";
    echo "<div class=\"sequence\">";

    if(!empty($row['directions'])) {
        $directions = unserialize($row['directions']);

        echo "<ol class=\"directions-list\">";

        foreach($directions as $direction) {
            echo "<li class=\"directions-item\">$direction</li>";
        }

        echo "</ol>";
    }
    echo "</div>";
    echo "</div>";

    echo "</div>";


    // COMMENTS
    
    $query = "SELECT count(commentid) FROM comments WHERE recipeid = $recipeid";

    $result = $conn->query($query);
    $row = mysqli_fetch_array($result);
    $totrecords = $row[0];


    echo "<div class=\"comments-section\">";
    echo "<div class=\"comments-block\">
            <i class=\"fa-solid fa-comments\"></i>
            <h1>Comments</h1>
        </div>";


    if($row[0] == 0) {
        echo "<span class=\"please-log-in\">No comments posted yet</span>";

        // Auth check before adding comments
        if(!$userIsLoggedIn) {
            echo "<span class=\"please-log-in\">Please <a href=\"index.php?content=login\">log in</a> to leave a comment<span>\n";
            echo "<div class=\"comments-section-btns\">
                    <div class=\"add-comment-btn\">
                        <i class=\"fa-solid fa-square-plus\"></i>
                        <a href=\"index.php?content=login\">Add a comment</a>
                    </div>
                    <div class=\"print-item-comments\">
                        <i class=\"fa-solid fa-print\"></i>
                        <a href=\"print.php?id=$recipeid\" target=\"_blank\">Print recipe</a>
                    </div>
                </div>";
        }

    } else {
        echo "<div class=\"comments-info-section\">
            <span>$row[0] comments posted</span>
            </div>";

        if(!isset($_SESSION['valid_recipe_user'])) {
            echo "<div class=\"comments-section-btns\">
                    <div class=\"add-comment-btn\">
                        <i class=\"fa-solid fa-square-plus\"></i>
                        <a href=\"index.php?content=login\">Add a comment</a>
                    </div>
                    <div class=\"print-item-comments\">
                        <i class=\"fa-solid fa-print\"></i>
                        <a href=\"print.php?id=$recipeid\" target=\"_blank\">Print recipe</a>
                    </div>
                </div>";
        } else {
            echo "<div class=\"comments-section-btns\">
                        <div class=\"add-comment-btn\">
                        <i class=\"fa-solid fa-square-plus\"></i>
                        <a href=\"#comnt-form\">Add a comment</a>
                    </div>
                    <div class=\"print-item-comments\">
                        <i class=\"fa-solid fa-print\"></i>
                        <a href=\"print.php?id=$recipeid\" target=\"_blank\">Print recipe</a>
                    </div>
                </div>";
        }

        // echo "<div class=\"comments-section-btns\">
        //     <div class=\"add-comment-btn\">
        //         <i class=\"fa-solid fa-square-plus\"></i>
        //         <a href=\"index.php?content=newcomment&id=$recipeid\">Add a comment</a>
        //     </div>";

        // Auth check before adding comments
        // if ($userIsLoggedIn) {
        //     echo "<a href=\"index.php?content=newcomment&id=$recipeid\">Add a comment</a>\n";
        // } else {
        //     echo "<span class=\"please-log-in\">Please <a href=\"index.php?content=login\"><b>log in</b></a> to leave a comment</span>\n";
        // }
    
        // echo "&nbsp;&nbsp;&nbsp;<a href=\"print.php?id=$recipeid\" target=\"_blank\">Print recipe</a>\n";
    
        if(!isset($_GET['page'])) {
            $thispage = 1;
        } else {
            $thispage = $_GET['page'];
        }

        $recordsperpage = 5;

        $offset = ($thispage - 1) * $recordsperpage;
        $totpages = ceil($totrecords / $recordsperpage);

        $query = "SELECT date, poster, comment FROM comments WHERE recipeid = $recipeid ORDER BY commentid DESC";
        $result = $conn->query($query);
        // $result = mysqli_query($conn, $query) or die('Could npt retrieve comments');
    
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $date = $row['date'];
            $poster = $row['poster'];
            $comment = $row['comment'];
            $comment = nl2br($comment);

            $dateFormatted = date("d F, Y", strtotime($date));

            echo "<div class=\"comment-container\">
                    <div class=\"comment-author\">
                        <h2>$poster</h2>
                    </div>
                    <div class=\"comment-text\">
                        <p>$comment</p>
                    </div>
                    <div class=\"date-posted\">
                        <p>$dateFormatted</p>
                    </div>
                </div>";
        }

        // if($thispage > 1) {
        //     $page = $thispage - 1;

        //     $prevpage = "<a href=\"index.php?content=showrecipe&id=$recipeid&page=$page\">Prev</a>";
        // } else {
        //     $prevpage = "";
        // }

        // $bar = '';

        // if($totpages > 1) {
        //     for($page = 1; $page <= $totpages; $page++) {
        //         if($page == $thispage) {
        //             $bar .= " $page ";
        //         } else {
        //             $bar .= " <a href=\"index.php?content=showrecipe&id=$recipeid&page=$page\">$page</a> ";
        //         }
        //     }
        // }

        // if($thispage < $totpages) {
        //     $page = $thispage + 1;

        //     $nextpage = " <a href=\"index.php?content=showrecipe&id=$recipeid&page=$page\">Next</a>";
        // } else {
        //     $nextpage = "";
        // }

        // echo $prevpage.$bar.$nextpage;
    }

    if(!isset($_SESSION['valid_recipe_user'])) {
        echo "<div class=\"no-user-banner\">
                <h1>Sorry, you do not have permission to post comments</h1>
                <div class=\"no-user-banner-inner\">
                    <a href=\"index.php?content=showrecipe&id=$recipeid\">Go back to recipe</a>
                    <p>&ensp;/&ensp;</p>
                    <a href=\"index.php?content=login\">Please login to post comments</a>
                </div>
            </div>\n";
        // echo "<h2>Sorry, you do not have permission to post comments</h2><br>\n";
        // echo "<a href=\"index.php?content=login\">Please login to post comments</a><br>\n";
        // echo "<a href=\"index.php?content=showrecipe&id=$recipeid\">Go back to recipe</a>\n";
    } else {
        $userid = $_SESSION['valid_recipe_user'];
        echo "<div id=\"comnt-form\" class=\"comment-form-block\">
                <div class=\"comments-block\">
                    <i class=\"fa-solid fa-comment\"></i>
                    <h1>Enter your comment</h1>
                </div>
                <form id=\"commentForm\" class=\"comment-form\" action=\"index.php\" method=\"post\">
                    <textarea required rows=\"5\" cols=\"50\" name=\"comment\"></textarea><br>
                    <input type=\"hidden\" name=\"poster\" value=\"$userid\"><br>
                    <input type=\"hidden\" name=\"recipeid\" value=\"$recipeid\">
                    <input type=\"hidden\" name=\"content\" value=\"addcomment\">
                    <label for=\"submitCommBtn\" class=\"add-comment-btn\">
                        <i class=\"fa-solid fa-square-plus\"></i>
                        <a>Add a comment</a>
                    </label>
                    <input id=\"submitCommBtn\" class=\"add-btn-input\" type=\"submit\" style=\"display: none;\">
                </form>
            </div>";
    }

    echo "</div>";
    echo "</div>";

    $conn->close();
    ?>
</div>


<div class="newsletter-block">
    <?php
    include('newsletter.inc.php');
    ?>
</div>