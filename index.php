<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script src="js/jquerry.js"></script>

    <title>Koncerti</title>
</head>

<body>
    <?php
    require_once("db_connection.php");
    require("navbar.php");
    ?>


    <div class="container-fluid align-middle">
        <div class="row m-4">
            <div class="col-2"></div>
            <div class="col-8">
            <input type="text" name="search" id="search" class="mb-4" placeholder="Pretraga">

            <div class="card-group text-center">
            <?php
                $querry = "SELECT * FROM myview WHERE";
                $result = mysqli_query($conn, $querry);
                $counter = 0;

                if($result){
                    while($row = mysqli_fetch_assoc($result)){
                        $imeIzvodjaca = $row['izvodjac'];
                        $datum = $row['datum'];
                        $vreme = $row['vreme'];
                        $nazivArene = $row['nazivArene'];
                        $adresa = $row['adresaArene'];
                        $kapacitet = $row['kapacitetArene'];

                        if($counter%3 == 0){
                            echo <<< EOD
                            </div>
                            <div class="card-group text-center">
                            EOD;
                        }

                        echo <<< EOD
                        <div class="card mb-3" style="width: 18rem;">
                        <div class="card-body">
                          <h5 class="card-title">$imeIzvodjaca</h5>
                          <p class="card-text">Vreme koncerta:<br> $datum, $vreme</p>
                          <p class="card-text">Mesto:<br> $nazivArene <br> $adresa</p>
                          <p class="card-text">Kapacitet: $kapacitet</p>
                        </div>
                        </div>
                        EOD;

                        $counter += 1;
                    }
                }
            ?>

            </div>
        </div>
        <div class="col-2"></div>
    </div>
</body>
<script>
    $(document).ready(function () {


        $("#search").keydown(function(){
            
        });
    });

</script>
</html>