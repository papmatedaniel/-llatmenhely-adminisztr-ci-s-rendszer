<?php
include 'db.php';

var_dump($_POST);

if (isset($_POST['action']) && $_POST['action'] === 'update_all') {
    $sql = "SELECT * FROM felhasznalok";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $felhasznalonev = $_POST["felhasznalonev$id"];
            $jogosultsag = $_POST["jogosultsag$id"];

            if (mb_detect_encoding($felhasznalonev, 'UTF-8', true) === false) {
                $felhasznalonev = utf8_encode($felhasznalonev);
            }

            if (mb_detect_encoding($jogosultsag, 'UTF-8', true) === false) {
                $jogosultsag = utf8_encode($jogosultsag);
            }

            $sql = "UPDATE felhasznalok SET felhasznalonev='$felhasznalonev', jogosultsag='$jogosultsag' WHERE id=$id";
            $conn->query($sql);
        }
    }
} else {
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'action') === 0) {
            $action = explode('_', $value);
            $id = end($action);
            if ($action[0] === 'update') {
                $felhasznalonev = $_POST["felhasznalonev$id"];
                $jogosultsag = $_POST["jogosultsag$id"];

                if (mb_detect_encoding($felhasznalonev, 'UTF-8', true) === false) {
                    $felhasznalonev = utf8_encode($felhasznalonev);
                }

                if (mb_detect_encoding($jogosultsag, 'UTF-8', true) === false) {
                    $jogosultsag = utf8_encode($jogosultsag);
                }

                $sql = "UPDATE felhasznalok SET felhasznalonev='$felhasznalonev', jogosultsag='$jogosultsag' WHERE id=$id";
                $conn->query($sql);
            } elseif ($action[0] === 'delete') {
                $sql = "DELETE FROM felhasznalok WHERE id=$id";
                $conn->query($sql);
            }
        }
    }
}

$conn->close();
header("Location: admin_felhasznaloszerkesztes.php");
?>
