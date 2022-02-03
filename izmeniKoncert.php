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

    <div class="row">
        <div class="col-3"></div>
        <div class="col-6 p-4">
            <form class="form-inline" method="POST" action="izmeniKoncert.php">
                <div class="form-group mr-4" style="width: 70%;">
                    <select class="form-control" style="width: 100%" id="trazeniID" name="trazeniID">
                        <option value="0">Odaberite koncert koji želite da promenite</option>
                        <?php
                        $querry = "SELECT * FROM koncerti";
                        $result = mysqli_query($conn, $querry);

                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $nazivIzvodjaca = $row['izvodjac'];
                                $datum = $row['datum'];
                                $id = $row['id'];

                                echo "<option value = '$id'>$nazivIzvodjaca, $datum </option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <input type="submit" class="btn btn-primary" style="width:25%" name="odaberiZaPromenu" id="odaberiZaPromenu" value="Promenite informacije">
            </form>



            <hr>

            <?php
            if (isset($_POST['odaberiZaPromenu'])) {
                $trazeniID = $_POST['trazeniID'];
                $_SESSION['trazeniID'] = $trazeniID;
                if ($trazeniID == 0) {
                    echo <<< EOD
                    <div class="alert alert-danger" role="alert">
                        Morate odabrati neki koncert!
                    </div>
                    EOD;
                } else {
                    $querry = "SELECT * FROM koncerti WHERE id = '$trazeniID'";
                    $result = mysqli_query($conn, $querry);

                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $imeIzvodjaca = $row['izvodjac'];
                            $idArene = $row['arenaID'];
                            $datum = $row['datum'];
                            $vreme = $row['vreme'];
                        }

                        echo <<< EOD
                    <form class="text-center" id="updateForm" action="update.php" method="POST">
                    <div class="form-group">
                        <label for="imeIzvodjaca" class="form-label text-light">Ime Izvođača:</label>
                        <input type="text" class="form-control" id="imeIzvodjaca" name="imeIzvodjaca" aria-describedby="imeIzvodjaca" value="$imeIzvodjaca">
                    </div>
                    <div class="form-group">
                        <label for="datumKoncerta" class="form-label text-light">Datum Koncerta:</label>
                        <input type="date" class="form-control" id="datumKoncerta" name="datumKoncerta" aria-describedby="datumKoncerta" value="$datum">
                    </div>
                    <div class="form-group">
                        <label for="vremeKoncerta" class="form-label text-light">Vreme Koncerta:</label>
                        <input type="time" class="form-control" id="vremeKoncerta" name="vremeKoncerta" aria-describedby="vremeKoncerta" value="$vreme">
                    </div>
    
                    <div class="form-group">
                        <select class="form-control" name="arena">
                    EOD;
                        $query = "SELECT * FROM arena";
                        $result = mysqli_query($conn, $query);

                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $venueName = $row['naziv'];
                                $id = $row['id'];

                                if ($idArene == $id) {
                                    echo <<< EDM
                                <option value="$id" selected>$venueName</option>
                            EDM;
                                } else {
                                    echo <<< EDM
                                <option value="$id">$venueName</option>
                            EDM;
                                }
                            }
                        }
                        echo <<< EOD
                        </select>
                        </div>
                        <input type="submit" class="btn btn-primary btn-block" name="sacuvajIzmene" id="sacuvajIzmene" value="Sacuvaj Izmene">
                        </form>
                        EOD;
                    }
                }
            }

            
            ?>

        </div>
        <div class="col-3"></div>
    </div>

</body>


<script>
    $(document).ready(function() {
        $("#updateForm").submit(function(event) {
            var izvodjac = $("#imeIzvodjaca").val().trim();
            var datumKoncerta = $("#datumKoncerta").val().trim();
            var vremeKoncerta = $("#vremeKoncerta").val().trim();
            var arena = $("#arena").val().trim();
            $.ajax({
                url: 'update.php',
                type: 'post',
                data: {
                    imeIzvodjaca: izvodjac,
                    datumKoncerta: datumKoncerta,
                    vremeKoncerta: vremeKoncerta,
                    arena: arena,
                },
                dataType: "json",
                encode: true,
            }).done(function (data){
                console.log(data);
            });
            event.preventDefault();
        });
    });
</script>


</html>