<?php
session_start();
if (!isset($_SESSION['felhasznalonev']) || $_SESSION['jogosultsag'] !== 'admin') {
    header("Location: index.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kutyamenhely";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $felhasznalonev = $_POST['felhasznalonev'];
    $jelszo = password_hash($_POST['jelszo'], PASSWORD_DEFAULT);
    $jogosultsag = $_POST['jogosultsag'];
    
    $sql = "INSERT INTO felhasznalok (felhasznalonev, jelszo, jogosultsag) VALUES ('$felhasznalonev', '$jelszo', '$jogosultsag')";
    if ($conn->query($sql) === TRUE) {
        $uzenet = "Új felhasználó sikeresen létrehozva";
    } else {
        $uzenet = "Hiba: " . $conn->error;
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

    <title>Admin Oldal</title>
</head>
<body>
<nav>
    <div class="logo">Állatmenhely: Admin oldal</div>
    <div class="nav-links">
        <a href="index.php">Üdvözöljük</a>
        <a href="allat_form.php">Állat hozzáadása</a>
        <a href="tablazat.php">Táblázat megtekintése</a>
        <a href="allatmodositasa.php">Táblázat szerkesztése</a>
        <a href="admin_felhasznalohozzadas.php">Felhasználók hozzáadása</a>
        <a href="admin_felhasznaloszerkesztes.php">Felhasználók szerkesztése</a>
        <button onclick="logout()">Kijelentkezés</button>
        <script>
            function logout() {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "/kijelentkezes.php");
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = function() {
                if (xhr.status === 200) {
                window.location.href = "/index.php";
                } else {
                alert("Hiba történt a kijelentkezéskor.");
                }
            };
            xhr.send("action=logout");
            }
        </script>

    </div>
</nav>

    <?php if (!empty($uzenet)) { echo '<p>'.$uzenet.'</p>'; } ?>
    <form action="admin_felhasznalohozzadas.php" method="post">
        <label for="felhasznalonev">Felhasználónév:</label><br>
        <input type="text" id="felhasznalonev" name="felhasznalonev" required><br>
        <label for="jelszo">Jelszó:</label><br>
        <input type="password" id="jelszo" name="jelszo" required><br>
        <label for="jogosultsag">Jogosultság:</label><br>
        <select id="jogosultsag" name="jogosultsag" required>
            <option value="latogato">Látogató</option>
            <option value="orvos">Orvos</option>
            <option value="dolgozo">Dolgozó</option>
        </select><br><br>
        <input type="submit" value="Felhasználó létrehozása">
    </form>
</body>
</html>
