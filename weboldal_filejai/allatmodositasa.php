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

$conn->set_charset("utf8");

$sql = "SELECT felhasznalonev, jelszo FROM felhasznalok";
$result = $conn->query($sql);
$conn->set_charset("utf8");

?>


<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="allatmodositasa.css">
    <title>Állatok szerkesztése</title>
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
<main class="st_viewport">
    <div data-table_id="0">
        <form action="allat_frissitese.php" method="post" accept-charset="UTF-8">
            <table class="st_table">
                <thead class="st_table_header">
                    <tr class="st_row">
                        <th class="st_column">Név</th>
                        <th class="st_column">Nem</th>
                        <!-- <th class="st_column">Ivarja</th> -->
                        <th class="st_column">Chipszám</th>
                        <th class="st_column">Fajta vagy jellemzők</th>
                        <th class="st_column">Típus</th>
                        <?php
                        if (!isset($_SESSION['felhasznalonev']) || $_SESSION['jogosultsag'] == 'orvos'){
                            echo '<th class="st_column">Egészségi állapot</th>';
                            echo '<th class="st_column">Fogazat</th>';
                            echo '<th class="st_column">Kor</th>';
                            echo '<th class="st_column">Viselkedés</th>';
                        }
                        ?>
                        
                        <th class="st_column">Egyéb jellemzők</th>
                        <th class="st_column">Műveletek</th>
                        <th class="st_column">Műveletek</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM allatok";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr class='st_row'>
                            <td class='st_column'><input type='text' name='nev<?= $row['id'] ?>' value='<?= htmlspecialchars($row['nev'], ENT_QUOTES, 'UTF-8') ?>' required></td>
                            <td class='st_column'><input type='text' name='nem<?= $row['id'] ?>' value='<?= htmlspecialchars($row['nem'], ENT_QUOTES, 'UTF-8') ?>' required></td>
                            <td class='st_column'><input type='number' name='csipszam<?= $row['id'] ?>' value='<?= htmlspecialchars($row['csipszam'], ENT_QUOTES, 'UTF-8') ?>'></td>
                            <td class='st_column'><input type='text' name='fajta<?= $row['id'] ?>' value='<?= htmlspecialchars($row['fajta'], ENT_QUOTES, 'UTF-8') ?>'></td>
                            <td class='st_column'><input type='text' name='tipus<?= $row['id'] ?>' value='<?= htmlspecialchars($row['tipus'], ENT_QUOTES, 'UTF-8') ?>'></td>
                            <?php if (!isset($_SESSION['felhasznalonev']) || $_SESSION['jogosultsag'] == 'orvos'): ?>
                                <td class='st_column'><input type='text' name='egeszsegiallapot<?= $row['id'] ?>' value='<?= htmlspecialchars($row['egeszsegiallapot'], ENT_QUOTES, 'UTF-8') ?>'></td>
                                <td class='st_column'><input type='text' name='fogazat<?= $row['id'] ?>' value='<?= htmlspecialchars($row['fogazat'], ENT_QUOTES, 'UTF-8') ?>'></td>
                                <td class='st_column'><input type='number' name='kor<?= $row['id'] ?>' value='<?= htmlspecialchars($row['kor'], ENT_QUOTES, 'UTF-8') ?>'></td>
                                <td class='st_column'><input type='text' name='viselkedes<?= $row['id'] ?>' value='<?= htmlspecialchars($row['viselkedes'], ENT_QUOTES, 'UTF-8') ?>'></td>
                            <?php endif; ?>
                            <td class='st_column'><input type='text' name='egyeb<?= $row['id'] ?>' value='<?= htmlspecialchars($row['egyeb'], ENT_QUOTES, 'UTF-8') ?>'></td>
                            <td class='st_column'><button type='submit' name='action' value='update_<?= $row['id'] ?>' id='frissit'>Frissítés</button></td>
                            <td class='st_column'><button type='submit' name='action' value='delete_<?= $row['id'] ?>' id='torles'>Törlés</button></td>
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
<?php
$conn->close();
?>
