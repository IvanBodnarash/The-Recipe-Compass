<?php
require 'config.php';

// // After succsessfull user authorization
session_write_close();
session_start();
// $_SESSION['valid_recipe_user'] = $userid;
// $_SESSION['can_post_comments'] = true; // Set the user to be able to add comments

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
    echo "<h2>Sorry, no user with this login was found.</h2><br>\n";
    echo "<a href=\"index.php?content=login\">Try again</a><br>\n";
    echo "<a href=\"index.php\">Return to Home</a>\n";
    exit;
}

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

    echo "<h2>Your user account has been validated, you can now post recipes and comments</h2><br>\n";
    echo "<a href=\"index.php\">Return to Home</a>\n";
} else {
    // The password is incorrect
    echo "<h2>Sorry, your password is incorrect.</h2><br>\n";
    echo "<a href=\"index.php?content=login\">Try again</a><br>\n";
    echo "<a href=\"index.php\">Return to Home</a>\n";
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