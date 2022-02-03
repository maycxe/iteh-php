<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script src="js/jquerry.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">

    <title>Koncerti</title>
</head>

<body>
    <?php
    require_once("db_connection.php");
    require("navbar.php");
    ?>


    <div class="container-fluid align-middle">

        <!--carousel-->
        <div class="row">
            <div id="slides" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#slides" data-slide-to="0" class="active"></li>
                    <li data-target="#slides" data-slide-to="1"></li>
                    <li data-target="#slides" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/con1.jpg">
                        <div class="carousel-caption">
                            <h1 class="display-2">Musix</h1>
                            <h3 id="podnaslov">Svi koncerti na jednom mestu!</h3>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="img/con2.jpg">
                        <div class="carousel-caption">
                            <h1 class="display-2">&nbsp</h1>
                            <h3>Pronađite svoje omiljene izvođače!</h3>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="img/con3.jpg">
                        <div class="carousel-caption">
                            <h1 class="display-2">&nbsp</h1>
                            <h3>I ne propustite nezaboravan provod!</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!--kartice-->
        <div class="row m-4">
            <div class="col-2"></div>
            <div class="col-8">

                <div class="row">
                    <div class="col-md-8">
                        <input type="text" name="search" id="search" class="form-control mb-4" placeholder="Pretraga">
                    </div>
                    <div class="col-md-4">
                        <select name="sort" id="sort" class="custom-select">
                            <option value="0">Datum opadajuće</option>
                            <option value="1">Datum rastuće</option>
                        </select>
                    </div>
                </div>

                <div class="flex-row text-center">
                    <div class="card-deck pt-4">
                    <?php
                    $querry = "SELECT * FROM myview";
                    $result = mysqli_query($conn, $querry);

                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $imeIzvodjaca = $row['izvodjac'];
                            $datum = $row['datum'];
                            $vreme = $row['vreme'];
                            $nazivArene = $row['nazivArene'];
                            $adresa = $row['adresaArene'];
                            $kapacitet = $row['kapacitetArene'];
                            $datumTime = strtotime($datum);

                            echo <<< EOD
                            <div class="col-sm-4">
                                <div class="card mb-3" style="min-width: 10rem; min-height: 300px;">
                                    <div class="card-body">
                                        <h5 class="card-title">$imeIzvodjaca</h5>
                                        <p class="time" style="display: none;">$datumTime</p>
                                        <p class="card-text">Vreme koncerta:<br> $datum, $vreme</p>
                                        <p class="card-text">Mesto:<br> $nazivArene <br> $adresa</p>
                                        <p class="card-text">Kapacitet: $kapacitet</p>
                                    </div>
                                </div>
                            </div>
                            EOD;
                        }
                    }
                    ?>
                   </div> 
                </div>
            </div>
            <div class="col-2"></div>
        </div>
</body>
<script>
    $(document).ready(function() {

        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            console.log(value);
            $(".card-title").filter(function(){
                $(this).closest(".col-sm-4").toggle($(this).text().toLocaleLowerCase().indexOf(value) > -1);
            });
        });

        $("#sort").on("change", function(){
            console.log($(this).val());
            if($(this).val() == 1){
                $('.col-sm-4').sort(function(a,b) {
                    return $(a).find(".time").text() > $(b).find(".time").text() ? 1 : -1;
                }).appendTo(".card-deck");
            }else{
                $('.col-sm-4').sort(function(a,b) {
                    return $(a).find(".time").text() < $(b).find(".time").text() ? 1 : -1;
                }).appendTo(".card-deck");
            }
        });
    });

</script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

</html>