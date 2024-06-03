
<?php
include 'db.php';

$nev = $_POST['nev'];
$nem = $_POST['nem'];
$csipszam = $_POST['csipszam'];
$fajta = $_POST['fajta'];
$tipus = $_POST['tipus'];
$egeszsegiallapot = $_POST['egeszsegiallapot'];
$fogazat = $_POST['fogazat'];
$kor = $_POST['kor'];
$viselkedes = $_POST['viselkedes'];
$egyeb = $_POST['egyeb'];

$sql = "INSERT INTO allatok (nev, nem, csipszam, fajta, tipus, egeszsegiallapot, fogazat, kor, viselkedes, egyeb) 
VALUES ('$nev', '$nem', '$csipszam', '$fajta', '$tipus', '$egeszsegiallapot', '$fogazat', '$kor', '$viselkedes', '$egyeb')";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
