<?php
// Auth check
// session_start();
if (!isset($_SESSION['valid_recipe_user'])) {
    header("Location: login.inc.php");
    exit();
}
?>

<form action="addrecipe.inc.php" method="post" enctype="multipart/form-data">
    <h2>Enter your new recipe</h2><br>

    Title: <input type="text" size="40" name="title"><br>
    <!-- Poster: <input type="text" size="40" name="poster"><br> -->
    Short Description: <br>

    <textarea name="shortdesc" id="" cols="50" rows="5"></textarea><br>

    <h3>Ingredients (one item per line)</h3>
    <textarea name="ingredients" id="" cols="50" rows="10"></textarea>

    <h3>Directions</h3>
    <textarea name="directions" id="" cols="50" rows="10"></textarea>

    <h3>Recipe Image</h3>

    <div id="filestack-picker">
        <input type="file" id="upload-button" value="Upload Image">
        <input type="hidden" name="image_url" id="image-url">
    </div>

    <!-- <input type="file" name="file" accept="image/*"><br> -->

    <input type="submit" value="submit">
    <input type="hidden" name="content" value="newrecipe">
</form>