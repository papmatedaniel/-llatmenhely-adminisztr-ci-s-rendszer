<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kutyamenhely";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $felhasznalonev = $_POST['felhasznalonev'];
    $jelszo = $_POST['jelszo'];

    $sql = "SELECT * FROM felhasznalok WHERE felhasznalonev='$felhasznalonev'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($jelszo, $row['jelszo'])) {
            $jogosultsag = $row['jogosultsag'];
            
            $_SESSION['felhasznalonev'] = $felhasznalonev;
            $_SESSION['jogosultsag'] = $jogosultsag;
            header("Location: index.php");
            exit();
        } else {
            $hiba = "Hibás felhasználónév vagy jelszó";
        }
    } else {
        $hiba = "Hibás felhasználónév vagy jelszó";
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
    <title>Bejelentkezés</title>
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
    <form action="bejelentkezes.php" method="post">
        <label for="felhasznalonev">Felhasználónév:</label><br>
        <input type="text" id="felhasznalonev" name="felhasznalonev" required><br>
        <label for="jelszo">Jelszó:</label><br>
        <input type="password" id="jelszo" name="jelszo" required><br><br>
        <input type="submit" value="Bejelentkezés">
    </form>
    <p>Nincs még fiókod? <button onclick="window.location.href='regisztracio.php';">Regisztrálj!</button></p>
    
</body>
</html>
