<?php

include "db_connection.php";
    session_start();

$trazeniID = $_SESSION['trazeniID'];

$imeIzvodjaca = $_POST['imeIzvodjaca'];
$idArene = $_POST['arena'];
$datum = $_POST['datumKoncerta'];
$vreme = $_POST['vremeKoncerta'];

$querry = "UPDATE koncerti
SET izvodjac = '$imeIzvodjaca', datum = '$datum', vreme = '$vreme', arenaID = '$idArene'
WHERE id = $trazeniID;";

$result = mysqli_query($conn, $querry);

echo <<< EOD
<div class="alert alert-success" role="alert">
Uspešno ste sačuvali nove informacije! 
</div>

EOD;

header("location:index.php");
?>