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

// Kapcsolódás az adatbázishoz
$conn = new mysqli($servername, $username, $password, $dbname);

// Felhasználók lekérdezése az adatbázisból
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
    <title>Állatok táblázat</title>
    <style>
            .st_viewport {
    max-height: 500px;
    overflow: auto;
    }

    [data-table_id="0"] {
    background-color: rgb(62, 148, 236);
    }

    .st_table_header {
    position: -webkit-sticky;
    position: sticky;
    top: 0px;
    z-index: 1;
    background-color: rgb(27, 30, 36);
    color: rgb(220, 220, 220);
    }

    .st_table_header h2 {
    font-weight: 400;
    margin: 0 20px;
    padding: 20px 0 0;
    }

    .st_table_header .st_row {
    color: rgba(220, 220, 220, 0.7);
    }

    .st_table_header .st_column {}

    .st_table {
    display: table;
    width: 100%;
    border-collapse: collapse;
    }

    .st_table thead {
    background-color: rgb(27, 30, 36);
    color: rgb(220, 220, 220);
    border-bottom: 1px solid rgba(0, 0, 0, 0.903);
    }

    .st_table thead th {
      position: relative;
      text-align: left; /* Balra igazítás */

    }

    .st_table thead th:not(:first-child)::before {
      content: '';
      position: absolute;
      left: -1px;
      top: 0;
      height: 100%;
      width: 1px;
      background-color: rgba(0, 0, 0, 0.904); 
    }

    .st_table th, .st_table td {
    padding: 10px 20px;
    border-right: 1px solid rgba(220, 220, 220, 0.2);
    }

    .st_table tbody tr:nth-child(even) {
    background-color: rgba(0, 0, 0, 0.1);
    }
    </style>
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
        <table class="st_table">
            <thead class="st_table_header">
                <tr class="st_row">
                    <th>ID</th>
                    <th>Név</th>
                    <th>Nem</th>
                    <!-- <th>Ivarja</th> -->
                    <th>Chipszám</th>
                    <th>Fajta vagy jellemzők</th>
                    <th>Típus</th>
                    <th>Egészségi állapot</th>
                    <th>Fogazat</th>
                    <th>Kor</th>
                    <th>Viselkedés</th>
                    <th>Egyéb jellemzők</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM allatok";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        ?>
                        <tr class='st_row'>
                            <td><?= $row['id'] ?></td>
                            <td><?= htmlspecialchars(ucfirst($row['nev']), ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($row['nem'], ENT_QUOTES, 'UTF-8') ?></td>
                            <!-- <td><?= htmlspecialchars($row['ivarja'], ENT_QUOTES, 'UTF-8') ?></td> -->
                            <td><?= htmlspecialchars($row['csipszam'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($row['fajta'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($row['tipus'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($row['egeszsegiallapot'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($row['fogazat'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($row['kor'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($row['viselkedes'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($row['egyeb'], ENT_QUOTES, 'UTF-8') ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr><td colspan='11'>Nincsenek adatok</td></tr>
                    <?php
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</main>
</body>
<!-- -->
</html>

