<?php
require 'config.php';

// // After succsessfull user authorization
session_write_close();
session_start();
// $_SESSION['valid_recipe_user'] = $userid;
// $_SESSION['can_post_comments'] = true; // Set the user to be able to add comments

// // Connecting to db

//Get Heroku ClearDB connection information

// $servername = $config['db_host'];
// $username = $config['db_user'];
// $password = $config['db_pass'];
// $dbname = $config['db_name'];

// // Creating connection with db
// $conn = new mysqli($servername, $username, $password, $dbname);

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
    // exit;
}

// Retrieving inserted data from form
$userid = $_POST['userid'];
$password = $_POST['password'];

// Checking user in database
$query = "SELECT userid, password FROM users WHERE userid = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $userid);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row === null) {
    echo "<div class=\"no-user-banner\">
            <h1>Sorry, no user with this login was found</h1>
            <div class=\"no-user-banner-inner\">
                <a href=\"index.php?content=login\">Try again</a>
                <p>&ensp;/&ensp;</p>
                <a href=\"index.php\">Home</a>
            </div>
        </div>\n";
    // exit;
} else {
    // Password check
    $hashed_password_from_db = $row['password'];
    if (password_verify($password, $hashed_password_from_db)) {
        // The password is correct, the user is authorized
        // session_start();
        // $_SESSION['valid_recipe_user'] = $userid;
        // $_SESSION['can_post_comments'] = true; // Set the user to be able to add comments
    
        // Close the current session before changing cookie settings
        session_write_close();
    
        // Setting session for 10 days
        session_set_cookie_params(10 * 24 * 60 * 60);
    
        // We start the session again after changing the cookie parameters
        // After succsessfull user authorization
        session_start();
        $_SESSION['valid_recipe_user'] = $userid;
        $_SESSION['can_post_comments'] = true; // Set the user to be able to add comments
    
        echo "<div class=\"validation-block-banner\">
                <h1>Your user account has been authorized</h1>
            </div>
            <div class=\"validation-block\">
                <h1>Now you can post recipes and comments</h1>
                <p class=\"msg\">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel rem quisquam ducimus ullam a. Eius, et laudantium! Mollitia, harum esse sequi impedit natus omnis necessitatibus nihil aspernatur accusantium! Totam, fugit!</p>
                <p class=\"msg-redirection\"><b>You will be automaticaly redirected to the home page</b></p>
            </div>\n";
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'index.php';
                }, 3000);
            </script>";
    } else {
        // The password is incorrect
        echo "<div class=\"no-user-banner\">
                <h1>Sorry, your password is incorrect</h1>
                <div class=\"no-user-banner-inner\">
                    <a href=\"index.php?content=login\">Try again</a>
                    <p>&ensp;/&ensp;</p>
                    <a href=\"index.php\">Home</a>
                </div>
            </div>\n";
    }
}
// $query = "SELECT userid from users where userid = '$userid' and password = PASSWORD('$password')";

// Request execution
// $result = $conn->query($query);

// if ($result) {
//     if (mysqli_num_rows($result) == 0) {
//         echo "<h2>Sorry, your user account was not validated.</h2><br>\n";
//         echo "<a href=\"index.php?content=login\">Try again</a><br>\n";
//         echo "<a href=\"index.php\">Return to Home</a>\n";
//     } else {
//         $_SESSION['valid_recipe_user'] = $userid;

//         echo "<h2>Your user account has been validated, you can now post recipes and comments</h2><br>\n";
//         echo "<a href=\"index.php\">Return to Home</a>\n";
//     }
// } else {
//     echo "Request error: " . $conn->error;
// }

$stmt->close();
$conn->close();
?>