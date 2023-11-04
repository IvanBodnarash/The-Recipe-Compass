<?php
require 'config.php';
require 'vendor/autoload.php';

// Auth check
session_start();
if (!isset($_SESSION['valid_recipe_user'])) {
    echo "<h2>Sorry, you must be logged in to post a recipe</h2>\n";
    echo "<a href=\"index.php?content=login\">Log In</a><br>\n";
    echo "<a href=\"index.php\">Return to Home</a>\n";
    exit;
}


// Connecting to db

// $servername = $config['db_host'];
// $username = $config['db_user'];
// $password = $config['db_pass'];
// $dbname = $config['db_name'];

// // Creating connection with db
// $conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo "<h2>Sorry, we cannot process your request at this time, please try again later</h2>\n";
    echo "<a href=\"index.php\">Return to Home</a>\n";
    exit;
}

// Obtaining the ID of the authorized user
$userId = $_SESSION['valid_recipe_user'];

// Input validation and data processing
$title = $_POST['title'];
// $poster = isset($_SESSION['valid_recipe_user']) ? $_SESSION['valid_recipe_user'] : "Anonymous";
$poster = $_SESSION['valid_recipe_user'];
// $poster = $_POST['poster'];
$shortdesc = $_POST['shortdesc'];
$ingredients = $_POST['ingredients'];
$directions = $_POST['directions'];


// File upload processing

// Initialize Filestack
use Filestack\FilestackClient;

// $client = new FilestackClient($filestack_api_key);
$client = new FilestackClient('AwxQNt5QZCr9LcJtnxGBQz');

if (!empty($_FILES['file'])) {
    $file = $_FILES['file'];

    // Upload the image to Filestack
    $response = $client->upload($file['tmp_name']);

    // Get the Filestack URL of the uploaded image
    $image_url = $response->getUrl();
    echo "File uploaded successfully. URL: $image_url";

    $data = $conn->prepare("INSERT INTO recipes (title, poster, shortdesc, ingredients, directions, image_path) VALUES (?, ?, ?, ?, ?, ?)");
    $data->bind_param("ssssss", $title, $poster, $shortdesc, $ingredients, $directions, $image_url);
    $data->execute();
    $data->close();

    // Execute the query
    echo "<h2>Recipe posted</h2>\n";

    echo "<script>
                setTimeout(function() {
                    window.location.href = 'index.php';
                }, 3000);
            </script>";
} else {
    echo "Error: file was not uploaded";
}


// if (!empty($_FILES['file'])) {
//     $file = $_FILES['file'];
//     $name = $file['name'];
//     $pathFile = __DIR__ . '/img/' . $name;

//     // if (!move_uploaded_file($file['tmp_name'], $pathFile)) {
//     //     echo 'File was not uploaded';
//     // }

//     $data = $conn->prepare("INSERT INTO recipes (title, poster, shortdesc, ingredients, directions, image_path) VALUES (?, ?, ?, ?, ?, ?)");
//     $data->bind_param("ssssss", $title, $poster, $shortdesc, $ingredients, $directions, $name);
//     $data->execute();
//     $data->close();

//     // Execute the query
//     echo "<h2>Recipe posted</h2>\n";

//     echo "<script>
//                 setTimeout(function() {
//                     window.location.href = 'index.php';
//                 }, 3000);
//             </script>";
//     // sleep(3);
//     // header("Location: index.php");
//     // exit;

//     // Close the statement
// } else {
//     echo "<h2>Sorry, there was a problem posting your recipe</h2>";
//     echo "<p>Error: " . $data->error . "</p>";
// }
$conn->close();


// $query = "INSERT INTO recipes (title, poster, shortdesc, ingredients, directions, image_path) VALUES (?, ?, ?, ?, ?)";
// // $query = "INSERT INTO recipes (title, shortdesc, poster, ingredients, directions) VALUES ('$title', '$shortdesc', '$poster', '$ingredients', '$directions')";
// // $query = "INSERT INTO recipes ('title', 'poster', 'shortdesc', 'ingredients', 'directions')";
// $stmt = $conn->prepare($query);

// if (!$stmt) {
//     echo "<h2>Sorry, there was a problem preparing the query</h2>\n";
// } else {
//     // Bind parameters
//     $stmt->bind_param("sssss", $title, $poster, $shortdesc, $ingredients, $directions);

//     // Execute the query
//     if ($stmt->execute()) {
//         echo "<h2>Recipe posted</h2>\n";

//         echo "<script>
//                 setTimeout(function() {
//                     window.location.href = 'index.php';
//                 }, 3000);
//             </script>";
//         // sleep(3);
//         // header("Location: index.php");
//         // exit;
//     } else {
//         echo "<h2>Sorry, there was a problem posting your recipe</h2>";
//         echo "<p>Error: " . $stmt->error . "</p>";
//     }

//     // Close the statement
//     $stmt->close();
//     $conn->close();
// }

// // Default image if the user doesn't upload one
// $default_image = 'default.jpg';

// // Check if an image was uploaded
// if (isset($_FILES['images'])) {
//     $image = $_FILES['images'];
//     $image_name = $image['name'];
//     $image_tmp = $image['tmp_name'];

//     // Specify the target directory to save the uploaded image
//     $target_dir = 'img/';
//     $target_file = $target_dir . $image_name;



//     // $directory = 'img'; // Шлях до папки, яку ви перевіряєте

//     // if (is_writable($directory)) {
//     //     echo "Папка запису в '$directory' має дозволи для запису.";
//     // } else {
//     //     echo "Папка запису в '$directory' не має дозволів для запису. Вам потрібно встановити правильні дозволи.";
//     // }




//     // Move the uploaded image to the target directory
//     if (move_uploaded_file($image_tmp, $target_file)) {
//         // Image was uploaded successfully
//         echo "<h2>Image uploaded successfully</h2>";
//     } else {
//         // Handle the case when the image upload fails
//         echo "<h2>Sorry, there was a problem uploading the image</h2>";
//     }
// } else {
//     // No image was uploaded, use the default image
//     $image_name = $default_image;
// }




// Inserting a user into the database
// $query = "INSERT INTO recipes (title, poster, shortdesc, ingredients, directions) VALUES (?, ?, ?, ?, ?)";
// // $query = "INSERT INTO recipes (title, shortdesc, poster, ingredients, directions) VALUES ('$title', '$shortdesc', '$poster', '$ingredients', '$directions')";
// // $query = "INSERT INTO recipes ('title', 'poster', 'shortdesc', 'ingredients', 'directions')";
// $stmt = $conn->prepare($query);

// if (!$stmt) {
//     echo "<h2>Sorry, there was a problem preparing the query</h2>\n";
// } else {
//     // Bind parameters
//     $stmt->bind_param("sssss", $title, $poster, $shortdesc, $ingredients, $directions);

//     // Execute the query
//     if ($stmt->execute()) {
//         echo "<h2>Recipe posted</h2>\n";

//         echo "<script>
//                 setTimeout(function() {
//                     window.location.href = 'index.php';
//                 }, 3000);
//             </script>";
//         // sleep(3);
//         // header("Location: index.php");
//         // exit;
//     } else {
//         echo "<h2>Sorry, there was a problem posting your recipe</h2>";
//         echo "<p>Error: " . $stmt->error . "</p>";
//     }

//     // Close the statement
//     $stmt->close();
//     $conn->close();
// }



// $result = $conn->query($query);
// $row = $result->fetch_array(MYSQLI_ASSOC);





// try {
//     // Create a PDO connection
//     $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

//     // Set the PDO error mode to exception
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     // Prepare the INSERT query with placeholders
//     $query = "INSERT INTO recipes (title, shortdesc, poster, ingredients, directions) VALUES (:title, :shortdesc, :poster, :ingredients, :directions)";

//     // Bind parameters
//     $stmt = $conn->prepare($query);
//     $stmt->bindParam(':title', $_POST['title']);
//     $stmt->bindParam(':shortdesc', $_POST['shortdesc']);
//     $stmt->bindParam(':poster', $_POST['poster']);
//     $stmt->bindParam(':ingredients', $_POST['ingredients']);
//     $stmt->bindParam(':directions', $_POST['directions']);

//     // Execute the query
//     $stmt->execute();

//     // Check if the query was successfull
//     echo "<h2>Recipe posted</h2>";
// } catch (PDOException $e) {
//     echo "<h2>Sorry, there was a problem posting your recipe: " . $e->getMessage() . "</h2>";
// }

// // Close the database connection
// $conn = null;





// $title = addslashes($_POST['title']);
// $poster = addslashes($_POST['poster']);
// $shortdesc = addslashes($_POST['shortdesc']);
// $ingredients = addslashes(htmlspecialchars($_POST['ingredients']));
// $directions = addslashes(htmlspecialchars($_POST['directions']));

// if (trim($poster) == "") {
//     echo "<h2>Sorry, each recipe must have a poster</h2>\n";
// } else {
//     // Creating connection with db
//     $conn = new mysqli($servername, $username, $password, $dbname);

//     // Checking connection
//     if ($conn->connect_error) {
//         die("Database connection error: " . $conn->connect_error);
//     }
//     //mysqli_select_db("recipe", $con) or die('Could not connect to database');
//     $query = "INSERT INTO recipes (title, shortdesc, poster, ingredients, directions) VALUES ('$title', '$shortdesc', '$poster', '$ingredients', '$directions')";

//     if ($conn->query($query) === TRUE) {
//         echo "<h2>Recipe posted</h2>\n";
//     } else {
//         echo "<h2>Sorry, there was a problem posting your recipe</h2>\n" . $conn->error;;
//     }
//     $conn->close();
// }

?>