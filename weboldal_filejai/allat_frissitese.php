<?php
include 'db.php';

$conn->set_charset("utf8");

if (isset($_POST['action']) && $_POST['action'] === 'update_all') {
    $sql = "SELECT * FROM allatok";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $nev = $conn->real_escape_string($_POST["nev$id"]);
            $nem = $conn->real_escape_string($_POST["nem$id"]);
            // $ivarja = $conn->real_escape_string($_POST["ivarja$id"]);
            $csipszam = $conn->real_escape_string($_POST["csipszam$id"]);
            $fajta = $conn->real_escape_string($_POST["fajta$id"]);
            $tipus = $conn->real_escape_string($_POST["tipus$id"]);
            $egeszsegiallapot = $conn->real_escape_string($_POST["egeszsegiallapot$id"]);
            $fogazat = $conn->real_escape_string($_POST["fogazat$id"]);
            $kor = $conn->real_escape_string($_POST["kor$id"]);
            $viselkedes = $conn->real_escape_string($_POST["viselkedes$id"]);
            $egyeb = $conn->real_escape_string($_POST["egyeb$id"]);
            $sql = "UPDATE allatok SET nev='$nev', nem='$nem', csipszam='$csipszam', fajta='$fajta', tipus='$tipus', egeszsegiallapot='$egeszsegiallapot', fogazat='$fogazat', kor='$kor', viselkedes='$viselkedes', egyeb='$egyeb' WHERE id=$id";
            $conn->query($sql);
        }
    }
} else {
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'action') === 0) {
            $action = explode('_', $value);
            $id = end($action);
            if ($action[0] === 'update') {
                $nev = $conn->real_escape_string($_POST["nev$id"]);
                $nem = $conn->real_escape_string($_POST["nem$id"]);
                // $ivarja = $conn->real_escape_string($_POST["ivarja$id"]);
                $csipszam = $conn->real_escape_string($_POST["csipszam$id"]);
                $fajta = $conn->real_escape_string($_POST["fajta$id"]);
                $tipus = $conn->real_escape_string($_POST["tipus$id"]);
                $egeszsegiallapot = $conn->real_escape_string($_POST["egeszsegiallapot$id"]);
                $fogazat = $conn->real_escape_string($_POST["fogazat$id"]);
                $kor = $conn->real_escape_string($_POST["kor$id"]);
                $viselkedes = $conn->real_escape_string($_POST["viselkedes$id"]);
                $egyeb = $conn->real_escape_string($_POST["egyeb$id"]);
                $sql = "UPDATE allatok SET nev='$nev', nem='$nem', csipszam='$csipszam', fajta='$fajta', tipus='$tipus', egeszsegiallapot='$egeszsegiallapot', fogazat='$fogazat', kor='$kor', viselkedes='$viselkedes', egyeb='$egyeb' WHERE id=$id";
                $conn->query($sql);
            } elseif ($action[0] === 'delete') {
                $sql = "DELETE FROM allatok WHERE id=$id";
                $conn->query($sql);
            }
        }
    }
}

$conn->close();
header("Location: allatmodositasa.php");
?>
