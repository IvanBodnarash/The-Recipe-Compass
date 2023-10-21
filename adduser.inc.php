<?php
require 'config.php';

// Connecting to db
$servername = $config['db_host'];
$username = $config['db_user'];
$password = $config['db_pass'];
$dbname = $config['db_name'];

// Creating connection with db
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo "<h2>Sorry, we cannot process your request at this time, please try again later</h2>\n";
    echo "<a href=\"index.php\">Return to Home</a>\n";
    exit;
}

// Input validation and data processing
$userid = $_POST['userid'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$fullname = $_POST['fullname'];
$email = $_POST['email'];

if (empty($userid) || empty($password) || empty($password2)) {
    echo "<h2>Sorry, you must fill in all required fields.</h2><br>\n";
    echo "<a href=\"index.php?content=register\">Try again</a><br>\n";
    echo "<a href=\"index.php\">Return to Home</a>\n";
    exit;
}

if ($password != $password2) {
    echo "<h2>Sorry, the passwords you entered did not match.</h2><br>\n";
    echo "<a href=\"index.php?content=register\">Try again</a><br>\n";
    echo "<a href=\"index.php\">Return to Home</a>\n";
    exit;
}

// Checking if the user exists
$query = "SELECT userid FROM users WHERE userid = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $userid);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row !== null && isset($row['userid']) && $row['userid'] == $userid) {
    echo "<h2>Sorry, that user name is already taken.</h2><br>\n";
    echo "<a href=\"index.php?content=register\">Try again</a><br>\n";
    echo "<a href=\"index.php\">Return to Home</a>\n";
    exit;
}

// Inserting a user into the database
$query = "INSERT INTO users (userid, password, fullname, email) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssss", $userid, $hashed_password, $fullname, $email);

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

if ($stmt->execute()) {
    $_SESSION['valid_recipe_user'] = $userid;
    echo "<h2>Your registration request has been approved, and you are now logged in!</h2>\n";
    echo "<a href=\"index.php\">Return to Home</a>\n";
} else {
    echo "<h2>Sorry, there was a problem processing your registration request.</h2><br>\n";
    echo "<a href=\"index.php?content=register\">Try again</a><br>\n";
    echo "<a href=\"index.php\">Return to Home</a>\n";
}

$stmt->close();
$conn->close();
?>
