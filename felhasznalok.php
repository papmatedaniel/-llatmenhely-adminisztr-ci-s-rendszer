<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kutyamenhely";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS felhasznalok (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    felhasznalonev VARCHAR(16) NOT NULL UNIQUE,
    jelszo VARCHAR(16) NOT NULL,
    jogosultsag VARCHAR(50) NOT NULL DEFAULT 'latogato'
)";

if ($conn->query($sql) === TRUE) {
    echo "Table felhasznalok created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
