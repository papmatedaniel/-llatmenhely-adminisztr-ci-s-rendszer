<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kutyamenhely";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $felhasznalonev = $_POST['felhasznalonev'];
    $jelszo = password_hash($_POST['jelszo'], PASSWORD_DEFAULT);
    $jogosultsag = "latogato";
    
    $sql = "SELECT * FROM felhasznalok WHERE felhasznalonev='$felhasznalonev'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $hiba = "Ez a felhasználónév már foglalt. Kérlek, válassz másikat.";
    } else {
        $sql = "INSERT INTO felhasznalok (felhasznalonev, jelszo, jogosultsag) VALUES ('$felhasznalonev', '$jelszo', '$jogosultsag')";
        if ($conn->query($sql) === TRUE) {
            header("Location: bejelentkezes.php");
            exit();
        } else {
            $hiba = "Hiba történt a regisztráció során: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Regisztráció</title>
</head>
<body>
    <nav>
    <div class="logo">Állatmenhely</div>
    <div class="nav-links">
    <a href="index.php">Üdvözöljük</a>
    <a href="regisztracio.php">Regisztráció</a>
    <a href="bejelentkezes.php">Belépés</a>
    </div>
    </nav>
    <?php if (!empty($hiba)) { echo '<p style="color: red;">'.$hiba.'</p>'; } ?>
    <form action="regisztracio.php" method="post">
        <label for="felhasznalonev">Felhasználónév:</label><br>
        <input type="text" id="felhasznalonev" name="felhasznalonev" required><br>
        <label for="jelszo">Jelszó:</label><br>
        <input type="password" id="jelszo" name="jelszo" required><br><br>
        <input type="submit" value="Regisztráció">
    </form>
    <p>Már van fiókod? <button onclick="window.location.href='bejelentkezes.php';">Jelentkezz be!</button></p>
    
</body>
</html>
