<?php

$servername = "localhost";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=click_tracker", $username, $password);
} catch(PDOException $e) {
    echo $e->getMessage();
}

?>