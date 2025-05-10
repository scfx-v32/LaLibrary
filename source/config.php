<?php
$host = "localhost";
$username = "root";
$password = "0000";
$dbname = "webmarket"; 

try {
    $cnx = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Optional: Ensure we're using the correct database explicitly
$cnx->query('USE webmarket;');
?>
