<table width="100%" cellpadding="3">
    <tr>
        <td>
            <?php
            session_write_close();
            session_start();
            if (isset($_SESSION['valid_recipe_user'])) {
                $username = $_SESSION['valid_recipe_user'];
                echo "<h3>Welcome, $username</h3>";
            }
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <a href="index.php"><strong>Home</strong></a>
        </td>
    </tr>
    <tr>
        <td>
            <a href="index.php?content=recipes"><strong>Recipes</strong></a>
        </td>
    </tr>
    <tr>
        <td>
            <a href="index.php?content=login"><strong>Login to post</strong></a>
        </td>
    </tr>
    <tr>
        <td>
            <a href="index.php?content=register"><strong>Register for free login</strong></a>
        </td>
    </tr>
    <tr>
        <td>
            <hr size="1" noshade="noshade" />
        </td>
    </tr>
    <tr>
        <td bgcolor="FFFF99">
            <a href="index.php?content=newrecipe"><strong>Post a new recipe</strong></a>
        </td>
    </tr>
    <tr>
        <td>
            <a href="index.php?content=logout"><strong>Logout</strong></a>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>
            <form action="index.php" method="get">
                <label for=""><span color="#663300" size="-1">search for recipe:</span></label>
                <input name="searchFor" type="text" size="14" />
                <input name="goButton" type="submit" value="find" />
                <input name="content" type="hidden" value="search" />
            </form>
        </td>
    </tr>
</table>