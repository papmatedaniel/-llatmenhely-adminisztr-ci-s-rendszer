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

$sql = "SELECT felhasznalonev, jelszo FROM felhasznalok";
$result = $conn->query($sql);
$conn->set_charset("utf8");
$conn->close();
?>
<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="allatmodositasa.css">
    <title>Felhasználók szerkesztése</title>
</head>
<body>
    
<nav>
    <div class="logo">Állatmenhely</div>
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
<main class="st_viewport">
    <div data-table_id="0">
        <form action="felhasznalo_frissitese.php" method="post" accept-charset="UTF-8">
            <table class="st_table">
                <thead class="st_table_header">
                    <tr class="st_row">
                        <th class="st_column">Felhasználónév</th>
                        <th class="st_column">Jogosultság</th>
                        <th class="st_column">Műveletek</th>
                        <th class="st_column">Műveletek</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM felhasznalok";
                
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        ?>
                        <tr class='st_row'>
                            <td class='st_column'>
                                <input type='text' name='felhasznalonev<?= $row['id'] ?>' value='<?= htmlspecialchars(ucfirst($row['felhasznalonev']), ENT_QUOTES, 'UTF-8') ?>' required>
                            </td>
                            <td class='st_column'>
                                <input type='text' name='jogosultsag<?= $row['id'] ?>' value='<?= htmlspecialchars($row['jogosultsag'], ENT_QUOTES, 'UTF-8') ?>' required>
                            </td>
                            <td class='st_column'>
                                <button type='submit' name='action' value='update_<?= $row['id'] ?>' id='frissit'>Frissítés</button>
                            </td>
                            <td class='st_column'>
                                <button type='submit' name='action' value='delete_<?= $row['id'] ?>' id='torles'>Törlés</button>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                <tr class="st_row">
                    <td colspan="12"><button type="submit" name="action" value="update_all">Összes adat frissítése</button></td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
</main>
</body>
</html>
<?php $conn->close(); ?>

