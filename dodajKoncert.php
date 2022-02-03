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
        <div class="row text-center m-4">
            <div class="col-4"></div>
            <div class="col-4">
                <form method="POST" action="create.php">
                    <div class="form-group">
                        <label for="imeIzvodjaca" class="form-label text-light">Ime Izvođača:</label>
                        <input type="text" class="form-control" id="imeIzvodjaca" name="imeIzvodjaca" aria-describedby="imeIzvodjaca">
                    </div>
                    <div class="form-group">
                        <label for="datumKoncerta" class="form-label text-light">Datum Koncerta:</label>
                        <input type="date" class="form-control" id="datumKoncerta" name="datumKoncerta" aria-describedby="datumKoncerta">
                    </div>
                    <div class="form-group">
                        <label for="vremeKoncerta" class="form-label text-light">Vreme Koncerta:</label>
                        <input type="time" class="form-control" id="vremeKoncerta" name="vremeKoncerta" aria-describedby="vremeKoncerta">
                    </div>

                    <div class="form-group">
                        <select class="form-control" name="arena">
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

                    <input type="submit" class="btn btn-primary btn-block" id="dodajKoncert" name="dodajKoncert" value="Dodaj Koncert">
                </form>

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
                url: 'create.php',
                type: 'post',
                data: {
                    imeIzvodjaca: izvodjac,
                    datumKoncerta: datumKoncerta,
                    vremeKoncerta: vremeKoncerta,
                    arena: arena
                },
                dataType: "json",
                encode: true,
            }).done(function(data) {
                console.log(data);
            });

            event.preventDefault();
        });
    });
</script>

</html>