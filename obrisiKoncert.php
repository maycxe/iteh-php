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

    <div class="row text-center">
        <div class="col-4"></div>
        <div class="col-4 p-4">
            <form method="POST" action="obrisiKoncert.php">
                <div class="form-group">
                    <label for="listaKoncerata">Odaberite koncerte koje želite da obrišete:</label>
                    <select multiple class="form-control" id="listaKoncerata" name="listaKoncerata[]" size="10">

                        <?php
                        $querry = "SELECT * FROM koncerti";
                        $result = mysqli_query($conn, $querry);

                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $nazivIzvodjaca = $row['izvodjac'];
                                $datum = $row['datum'];
                                $id = $row['id'];

                                echo <<< EOD
                            <option value = '$id'>$nazivIzvodjaca, $datum</option>
                            EOD;
                            }
                        }
                        ?>
                    </select>
                </div>

                <input type="submit" class="btn btn-primary" name="obrisiKoncerte" id="obrisiKoncerte" value="Obriši koncerte">
            </form>

        </div>
        <div class="col-4"></div>
    </div>

    <?php
    if (isset($_POST['obrisiKoncerte'])) {
        $count = 0;
        foreach ($_POST['listaKoncerata'] as $id) {
            $querry = "DELETE FROM koncerti WHERE id = '$id'";
            $result = mysqli_query($conn, $querry);
            $count += 1;
        }

        header("location: index.php");
    }
    ?>
</body>

</html>