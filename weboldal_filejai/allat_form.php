<?php
session_start();
if (!isset($_SESSION['felhasznalonev']) || $_SESSION['jogosultsag'] == 'latogato') {
    header("Location: index.php");
    exit();
} 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kutyamenhely";

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT felhasznalonev, jelszo FROM felhasznalok";
$result = $conn->query($sql);

$conn->close();
?>

<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Állat adatok</title>
</head>
<body>
<nav>
    <div class="logo">Állatmenhely</div>
    <div class="nav-links">
        <a href="index.php">Üdvözöljük</a>
        <a href="allat_form.php">Állat hozzáadása</a>
        <a href="tablazat.php">Táblázat megtekintése</a>
        <a href="allatmodositasa.php">Táblázat szerkesztése</a>
        <?php if (isset($_SESSION['felhasznalonev']) && $_SESSION['jogosultsag'] === "admin"): ?>

            <a href="admin_felhasznalohozzadas.php">Felhasználók hozzáadása</a>

        <?php endif ?>
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
<form action="allat_hozzaadasa.php" method="post">
    <label for="nev">Név:</label>
    <input type="text" id="nev" name="nev" required>
    <label for="nem">Nem:</label>
    <select id="nem" name="nem" required>
        <option value="Hím">Hím</option>
        <option value="Nőstény">Nőstény</option>
    </select>
    <!-- <label for="ivarja">Ivarja:</label>
    <select id="ivarja" name="ivarja" required>
        <option value="Ivaros">Ivaros</option>
        <option value="Ivartalan">Ivartalan</option> -->
    <!-- </select> -->
    <label for="csipszam">Chipszám:</label>
    <input type="number" id="csipszam" name="csipszam">
    <label for="fajta">Fajta vagy jellemzők:</label>
    <input type="text" id="fajta" name="fajta">
    <label for="tipus">Típus:</label>
    <input type="text" id="tipus" name="tipus">
    <!-- <label for="egeszsegiallapot">Egészségi állapot:</label>
    <input type="text" id="egeszsegiallapot" name="egeszsegiallapot">
    <label for="fogazat">Fogazat:</label>
    <input type="text" id="fogazat" name="fogazat">
    <label for="kor">Kor:</label>
    <input type="number" id="kor" name="kor">
    <label for="viselkedes">Viselkedés:</label>
    <input type="text" id="viselkedes" name="viselkedes"> -->
    <label for="egyeb">Egyéb jellemzők:</label>
    <input type="text" id="egyeb" name="egyeb">
    <button type="submit">Állat hozzáadása</button>
</form>
</body>
</html>
