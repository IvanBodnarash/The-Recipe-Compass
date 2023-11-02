<?php
// $config = [
//     'db_host' => 'localhost',
//     'db_user' => 'test',
//     'db_pass' => 'test159951test!',
//     'db_name' => 'recipe'
// ];

//Get Heroku ClearDB connection information


$cleardb_server = "us-cdbr-east-06.cleardb.net";
$cleardb_username = "bd7250df98d251";
$cleardb_password = "69baea4d";
$cleardb_db = "heroku_e0a2fe3a1b49d9f";

// Filestack api key

$filestack_api_key = "AwxQNt5QZCr9LcJtnxGBQz";

// Connecting to database
$conn = new mysqli($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

// Checking connection
if ($conn->connect_error) {
    die("Connection to db error: " . $conn->connect_error);
}

//

// $cleardb_url = "mysql://bd7250df98d251:69baea4d@us-cdbr-east-06.cleardb.net/heroku_e0a2fe3a1b49d9f?reconnect=true";
// $cleardb_parts = parse_url($cleardb_url);
// $cleardb_server = $cleardb_parts["us-cdbr-east-06.cleardb.net"];
// $cleardb_username = $cleardb_parts["bd7250df98d251"];
// $cleardb_password = $cleardb_parts["69baea4d"];
// $cleardb_db = ltrim($cleardb_parts["heroku_e0a2fe3a1b49d9f"], "/");
// $active_group = 'default';
// $query_builder = TRUE;

// // Connect to DB
// $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

// //Get Heroku ClearDB connection information
// $cleardb_url = parse_url(getenv("mysql://bd7250df98d251:69baea4d@us-cdbr-east-06.cleardb.net/heroku_e0a2fe3a1b49d9f?reconnect=true"));
// $cleardb_server = $cleardb_url["us-cdbr-east-06.cleardb.net"];
// $cleardb_username = $cleardb_url["bd7250df98d251"];
// $cleardb_password = $cleardb_url["69baea4d"];
// $cleardb_db = substr($cleardb_url["heroku_e0a2fe3a1b49d9f"], 1);
// $active_group = 'default';
// $query_builder = TRUE;

// // Connect to DB
// $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

// //Get Heroku ClearDB connection information
// $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
// $cleardb_server = $cleardb_url["host"];
// $cleardb_username = $cleardb_url["user"];
// $cleardb_password = $cleardb_url["pass"];
// $cleardb_db = substr($cleardb_url["path"], 1);
// $active_group = 'default';
// $query_builder = TRUE;

// // Connect to DB
// $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

?>