<?php
// echo "<h1>Hello!</h1>";
// session_start();
session_unset();
session_destroy();
header("Location: index.php");
exit;
?>