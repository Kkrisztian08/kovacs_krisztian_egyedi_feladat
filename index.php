<?php

require_once 'db.php';
require_once 'zene.php';

//adatok visszatöltése
function visszatolt($szoveg){
    echo htmlspecialchars($szoveg, ENT_QUOTES);
}
$cimMezo= '';
$eloadoMezo= '';
$stilusMezo= '';
$hosszMezo= '';
$datumMezo= '';



$cimHiba = false;
$cimHibaUzenet = '';
$eloadoHiba = false;
$eloadoHibaUzenet = '';
$stilusHiba = false;
$stilusHibaUzenet = '';
$hosszHiba = false;
$hosszHibaUzenet = '';
$megjelenes_datumaHiba = false;
$megjelenes_datumaHibaUzenet = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //adatok visszatöltése
    $cimMezo=$_POST['cim']??'';
    $eloadoMezo=$_POST['eloado']??'';
    $stilusMezo=$_POST['stilus'] ?? '';
    $hosszMezo=$_POST['hossz'] ?? '';
    $datumMezo=$_POST['megjelenes_datuma'] ?? '';


    $deleteId = $_POST['deleteId'] ?? '';
    if ($deleteId !== '') {
        Zene::torol($deleteId);
    } else {
        
        //szerver oldali validáció
        $ujCim = $_POST['cim'] ?? '';
        if (empty($_POST['cim'])) {
            $cimHiba = true;
            $cimHibaUzenet = 'Kötelező megadni a zene címét!';
        }

        $ujEloado = $_POST['eloado'] ?? '';
        if (empty($_POST['eloado'])) {
            $eloadoHiba = true;
            $eloadoHibaUzenet = 'Kötelező megadni a zene előadóját!';
        }

        $ujStilus = $_POST['stilus'] ?? '';
        if (empty($_POST['stilus'])) {
            $stilusHiba = true;
            $stilusHibaUzenet = 'Kötelező megadni a zene stílusát!';
        }

        $ujHossz = $_POST['hossz'] ?? 0;
        if (empty($_POST['hossz'])) {
            $hosszHiba = true;
            $hosszHibaUzenet = 'Kötelező megadni a zene hosszát!';
        }elseif (!is_numeric($_POST['hossz'])) {
            $hosszHiba = true;
            $hosszHibaUzenet = 'A hossz csak szám lehet!';
        }

        $ujMegjelenes_datuma = $_POST['megjelenes_datuma'] ?? '';
        if (empty($_POST['megjelenes_datuma'])) {
            $megjelenes_datumaHiba = true;
            $megjelenes_datumaHibaUzenet = 'Kötelező megadni a zene megjelenési dátumát!';
        }
        

        if (!$cimHiba && !$eloadoHiba && !$stilusHiba && !$hosszHiba && !$megjelenes_datumaHiba ) {
            $ujZene = new Zene($ujCim, $ujEloado, $ujStilus, $ujHossz, new DateTime($ujMegjelenes_datuma));
            $ujZene->uj();
            $cimMezo= '';
            $eloadoMezo= '';
            $stilusMezo= '';
            $hosszMezo= '';
            $datumMezo= '';
        }
    }
    
}

$zenek = Zene::osszes();


?><!DOCTYPE html>
<html>
    <head>
        <title>Zenék</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    </head>
    <body>
    <div class=" adatok container">
        <form method="POST">
            <div class="row">
                <p class="col-4">Cím:</p>
                <div class="col-8"><input type="text"  name="cim" placeholder="Waterloo" value='<?php visszatolt($cimMezo) ?>'></input></div>
                <div class="hibauzenet"><?php echo $cimHibaUzenet; ?></div>
            </div>
            <div class="row">
                <p class="col-4">Előadó:</p>
                <div class="col-8"><input type="text" name="eloado" placeholder="ABBA" value='<?php visszatolt($eloadoMezo) ?>'></input></div>
                <div class="hibauzenet"><?php echo $eloadoHibaUzenet; ?></div>
            </div>
            <div class="row">
                <p class="col-4">Stílus:</p>
                <div class="col-8"><input type="text" name="stilus" placeholder="europop" value='<?php visszatolt($stilusMezo) ?>'></input></div>
                <div class="hibauzenet"><?php echo $stilusHibaUzenet; ?></div>
            </div>
            <div class="row">
                <p class="col-4">Zene hossza (percben):</p>
                <div class="col-8"><input type="number" name="hossz" placeholder="4.2 perc" value='<?php visszatolt($hosszMezo) ?>'></input></div>
                <div class="hibauzenet"><?php echo $hosszHibaUzenet; ?></div>
            </div>
            <div class="row">
                <p class="col-4">Megjelenés dátuma:</p>
                <div class="col-8"><input type="date" name="megjelenes_datuma"  value='<?php visszatolt($datumMezo) ?>'></input></div>
                <div class="hibauzenet"><?php echo $megjelenes_datumaHibaUzenet; ?></div>
            </div>
            <div class=" kozep row ">
                <div class="col-12 "><input class="hozzaad" type="submit" value="Új zene hozzáadása"></div>
            </div>
        </form>
    </div >

    <div class="container">
        <div class="row">
            <?php
                foreach ($zenek as $zene) {
                            echo "<div class='col-4'>";
                                echo "<div class='card' >";
                                    echo "<div class='card-body'>";
                                        echo "<h2>";
                                        echo $zene->getCim();
                                        echo "</h2>";
                                        echo "<p>" . $zene->getEloado(). "</p>";
                                        echo "<p>" . $zene->getStilus(). "</p>";
                                        echo "<p>" . $zene->getHossz() . " perc </p>";
                                        echo "<p>" . $zene->getMegjelenesDatuma()->format('Y-m-d') . "</p>";
                                        echo "<form method='POST'>";
                                            echo "<div class='row'>";
                                                echo "<input type='hidden' name='deleteId' value='" . $zene->getId() . "'>";
                                                echo "<button class='gombform col-3' type='submit'>Törlés</button>";
                                                echo "<a class='linkform col-4' href='zene_modositas.php?id=" . $zene->getId() . "'>Szerkesztés</a>";
                                            echo "</div>";
                                        echo "</form>";
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";
                }
            ?>
        </div >
    </div >
    </body>
</html>