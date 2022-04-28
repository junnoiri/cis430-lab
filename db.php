<?php
$servername = "jnoiri.com";
$username = "jun";
$password = "07070118jJ";

try {
    $conn = new PDO("mysql:host=$servername;dbname=device_db", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
