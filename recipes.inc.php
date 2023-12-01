<div class="main-recipe-block">
    <h1 class="header-text">Discover all recipes</h1>
    <p class="description">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tenetur, dolorum! Incidunt at doloremque optio tenetur</p>
    <div class="sort-block-wrapper">
        <div class="sort-block">
            <a href="index.php?content=recipes&sort=title">Sort by Title</a>
            <a href="index.php?content=recipes&sort=poster">Sort by Poster</a>
        </div>
        <div class="sorted-by-block">
            <?php
            $sort = isset($_GET['sort']) ? $_GET['sort'] : 'title';

            $sortText = '';

            switch ($sort) {
                case 'title':
                    $sortText = 'Sorted by Title';
                    break;
                case 'poster':
                    $sortText = 'Sorted by Poster';
                    break;
                default:
                    $sortText = 'Sorted by Alphabet';
                    break;
            }

            echo "<p>$sortText</p>"; ?>
        </div>
    </div>
    <div class="recipes-wrapper">
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
        
        // Defining the sort option (if set in the URL)
        
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'title';

        $query = "SELECT recipeid, poster, title, shortdesc, image_path FROM recipes ORDER BY $sort";

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
                    $image = 'img/default.jpg';
                }

                // echo "<a href=\"index.php?content=showrecipe&id=$recipeid\">$title</a> submitted by $poster <br>\n";
                // echo "$shortdesc<br><br>\n";
                // // echo "<img src=\"img/$image\" width=\"200px\" alt=\"Hey\"><br><br>\n";
                // echo "<img src=\"$image\" width=\"200px\" alt=\"Hey\"><br><br>\n";
                // // var_dump($image);
        
                echo "<div class=\"recipe-block\"\n>
                        <a href=\"index.php?content=showrecipe&id=$recipeid\">
                            <div class=\"overlay\">
                                <p>Open</p>
                            </div>
                            <div class=\"content-wrapper\">
                                <h3>$title</h3>
                                <img src=\"$image\" alt=\"Recipe img\">\n
                                <div class=\"text-block\">
                                    <span>$shortdesc ...</span>
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
    </div>
    <div class="add-new-recipe-block">
        <h1>Add new recipe</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti possimus veniam deserunt aut sint quidem, illo cum veritatis animi a magni harum impedit iste dolorum.</p>
        <div class="add-new-recipe-btn-block">
            <a href="index.php?content=newrecipe" class="add-new-recipe-btn">
                <i class="fas fa-plus"></i> Add New Recipe</a>
        </div>
    </div>
</div>