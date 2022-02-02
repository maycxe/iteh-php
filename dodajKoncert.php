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
        <div class="row text-center m-4">
            <div class="col-4"></div>
            <div class="col-4">
                <form method="POST" action="dodavanje.php">
                    <div class="form-group">
                        <label for="imeIzvodjaca" class="form-label">Ime Izvođača:</label>
                        <input type="text" class="form-control" id="imeIzvodjaca" name="imeIzvodjaca" aria-describedby="imeIzvodjaca">
                    </div>
                    <div class="form-group">
                        <label for="datumKoncerta" class="form-label">Datum Koncerta:</label>
                        <input type="date" class="form-control" id="datumKoncerta" name="datumKoncerta" aria-describedby="datumKoncerta">
                    </div>
                    <div class="form-group">
                        <label for="vremeKoncerta" class="form-label">Vreme Koncerta:</label>
                        <input type="time" class="form-control" id="vremeKoncerta" name="vremeKoncerta" aria-describedby="vremeKoncerta">
                    </div>

                    <div class="form-group">
                        <select class="custom-select" name="arena">
                            <option value="0" selected>Odaberite Arenu</option>
                            <?php
                            $query = "SELECT * FROM arena";
                            $result = mysqli_query($conn, $query);

                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $venueName = $row['naziv'];
                                    $id = $row['id'];

                                    echo <<< EDM
                                        <option value="$id">$venueName</option>
                                        EDM;
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <input type="submit" class="btn btn-primary" id="dodajKoncert" name="dodajKoncert" value="Dodaj Koncert">
                </form>

                <?php
                /*
                if (isset($_POST['dodajKoncert'])) {
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

                    $_POST['imeIzvodjaca'] = null;
                }
                */
                ?>

                <p id="message"></p>
            </div>
        </div>
        <div class="col-4"></div>
    </div>
</body>

<script>
    $(document).ready(function() {
        $("form").submit(function(event) {
            var izvodjac = $("#imeIzvodjaca").val().trim();
            var datumKoncerta = $("#datumKoncerta").val().trim();
            var vremeKoncerta = $("#vremeKoncerta").val().trim();
            var arena = $("#arena").val().trim();
            $.ajax({
                url: 'dodavanje.php',
                type: 'post',
                data: {
                    imeIzvodjaca: izvodjac,
                    datumKoncerta: datumKoncerta,
                    vremeKoncerta: vremeKoncerta,
                    arena: arena
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