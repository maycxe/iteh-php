<?php
    include "db_connection.php";
    echo "<script> alert('Hello! I am an alert box!!')</script>";

    $imeIzvodjaca = $_POST['imeIzvodjaca'];
    $idArene = $_POST['arena'];
    $datum = $_POST['datumKoncerta'];
    $vreme = $_POST['vremeKoncerta'];

    $querry = "INSERT INTO koncerti (id, izvodjac, datum, vreme, arenaID) VALUES (NULL, '$imeIzvodjaca', '$datum', '$vreme', '$idArene');";
    $result = mysqli_query($conn, $querry);

    echo <<< EOD
        <div class="alert alert-success m-4" role="alert">
            Uspešno ste dodali novi koncert!
        </div>
    EOD;

    header("location: index.php");
?>