<?php
session_start();

if (!isset($_SESSION['isLoggedIn']))
    $_SESSION['isLoggedIn'] = false;
if (!isset($_SESSION['isAdmin']))
    $_SESSION['isAdmin'] = false;

if (isset($_POST['login']))
    login($conn);
if (isset($_POST['logout']))
    logout();

function login($conn)
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM korisnici WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($username = $row['username'] && $password = $row['password']) {
                $_SESSION['isLoggedIn'] = true;
                $_SESSION['currentUserName'] = $row['username'];
                $_SESSION['currentUserId'] = $row['id'];

                return;
            }
        }
    }
}

function logout()
{
    $_SESSION['isLoggedIn'] = false;

    $_SESSION['currentUserName'] = null;
    $_SESSION['currentUserId'] = null;

    header("location:index.php");
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

        <a class="navbar-brand" href="#">Svet Koncerata</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Pocetna</a>
                </li>
                <?php
                if ($_SESSION['isLoggedIn']) {
                    echo <<< EOD
                    <li class="nav-item">
                        <a class='nav-link' href='dodajKoncert.php'>Dodaj Koncert</a>
                    </li>
                    <li class="nav-item">
                        <a class='nav-link' href='izmeniKoncert.php'>Izmeni Koncert</a>
                    </li>
                    <li class="nav-item">
                        <a class='nav-link' href='obrisiKoncert.php'>Obriši Koncert</a>
                    </li>
                    EOD;
                } else
                    echo <<< EOD
                    <li class="nav-item">
                        <a class='nav-link disabled' href='dodajKoncert.php' tabindex='-1' aria-disabled='true'>Dodaj Koncert</a>
                    </li>
                    <li class="nav-item">
                    <a class='nav-link disabled' href='izmeniKoncert.php' tabindex='-1' aria-disabled='true'>Izmeni Koncert</a>
                    </li>
                    <li class="nav-item">
                        <a class='nav-link disabled' href='obrisiKoncert.php' tabindex='-1' aria-disabled='true'>Obriši Koncert</a>
                    </li>
                    EOD;
                ?>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="index.php" method="POST">
                <?php

                if ($_SESSION['isLoggedIn'] === false) {
                    echo <<< EOD
                <input class="form-control mr-sm-2" type="text" placeholder="Username" name="username">
                <input class="form-control mr-sm-2" type="password" placeholder="Password" name="password">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="login">Login</button>      
                EOD;
                } else {
                    $user = $_SESSION['currentUserName'] . " " . $_SESSION['currentUserLastname'];
                    echo <<< EOD
                <nav class="navbar navbar-light bg-light">
                <span class="navbar-text" style="margin-rigth: 20px;">
                Ulogovani ste kao $user
                </span>
                </nav>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="logout">Logout</button>      
                EOD;
                }
                ?>
            </form>
        </div>
    </div>
</nav>