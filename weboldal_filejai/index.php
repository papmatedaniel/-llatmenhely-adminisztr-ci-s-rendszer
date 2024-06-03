<?php include 'db.php'; ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Üdvözöljük</title>
</head>
<body>
<nav>
    <?php
        session_start();
    ?>

    <div class="logo">Állatmenhely</div>
    <div class="nav-links">
    <a href="index.php">Üdvözöljük</a>


        <?php if (isset($_SESSION['felhasznalonev']) && $_SESSION['jogosultsag'] !== "latogato"): ?>

            <a href="allat_form.php">Állat hozzáadása</a>
            <a href="tablazat.php">Táblázat megtekintése</a>
            <a href="allatmodositasa.php">Táblázat szerkesztése</a>

        <?php endif ?>

        <?php if (isset($_SESSION['felhasznalonev']) && $_SESSION['jogosultsag'] === "admin"): ?>

            <a href="admin_felhasznalohozzadas.php">Felhasználók hozzáadása</a>
            <a href="admin_felhasznaloszerkesztes.php">Felhasználók szerkesztése</a>


        <?php endif ?>

        <?php if (isset($_SESSION['felhasznalonev'])): ?>

            <a onclick="logout()">Kijelentkezés</a>

        <?php else: ?>

            <a href="regisztracio.php">Regisztráció</a>
            <a href="bejelentkezes.php">Belépés</a>

        <?php endif ?>
    
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
    <!-- Azon kutyák megjelenítése, ahol letelt a 14 napos karantén(nincs ilyen oszlop), van csipje, ivartalanitva van(nincs ilyen oszlop) -->
    <!-- Ha latogato akkor legyen egy gomb a kutyák divjeiben, ami az örökbeadás kérvényezésére irányul. -->
    <!-- Ha kitöltötte a kérdőivet, akkor az admin panelba jelenjen meg egy üzenet, hogy x felhasználó akar y kutyát befogadni, -->
</nav>


</body>
</html>