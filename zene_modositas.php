<?php

$sikeresSzerkesztes=false;

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

require_once 'db.php';
require_once 'zene.php';

$zeneId = $_GET['id'] ?? null;

if ($zeneId === null) {
    header('Location: index.php');
    exit();
}

$zene = Zene::getById($zeneId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    //udate rész
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

    $ujdatum = $_POST['megjelenes_datuma'] ?? '';
        if (empty($_POST['megjelenes_datuma'])) {
            $megjelenes_datumaHiba = true;
            $megjelenes_datumaHibaUzenet = 'Kötelező megadni a zene megjelenési dátumát!';
        }

    $zene->setCim($ujCim);
    $zene->setEloado($ujEloado);
    $zene->setStilus($ujStilus);
    $zene->setHossz($ujHossz);
    $zene->setMegjelenesDatuma(new DateTime($ujdatum));

    if (!$cimHiba && !$eloadoHiba && !$stilusHiba && !$hosszHiba && !$megjelenes_datumaHiba ) {
        $zene->mentes();
        $sikeresSzerkesztes=true;
    }
}



?><!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Adatok szerkesztése</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
<?php if(!$sikeresSzerkesztes){?>
    <div class="adatok container">
        <form method='POST'>
            <div class="row">
                <p class="col-4">Cím:</p>
                <div class="col-8"><input type='text' name='cim' value='<?php echo $zene->getCim(); ?>'></div>
                <div class="hibauzenet"><?php echo $cimHibaUzenet; ?></div>
            </div>
            <div class="row">
                <p class="col-4">Előadó:</p>
                <div class="col-8"><input type='text' name='eloado' value='<?php echo $zene->getEloado(); ?>'></div>
                <div class="hibauzenet"><?php echo $eloadoHibaUzenet; ?></div>
            </div>
            <div class="row">
                <p class="col-4">Stílus:</p>
                <div class="col-8"><input type='text' name='stilus' value='<?php echo $zene->getStilus(); ?>'></div>
                <div class="hibauzenet"><?php echo $stilusHibaUzenet; ?></div>
            </div>
            <div class="row">
                <p class="col-4">Zene hossza (percben):</p>
                <div class="col-8"><input type='number' step=any name='hossz' value='<?php echo $zene->getHossz(); ?>'></div>
                <div class="hibauzenet"><?php echo $hosszHibaUzenet; ?></div>
            </div>
            <div class="row">
                <p class="col-4">Megjelenés dátuma:</p>
                <div class="col-8"><input type='date' name='megjelenes_datuma' value='<?php echo $zene->getMegjelenesDatuma()->format("Y-m-d"); ?>'></div>
                <div class="hibauzenet"><?php echo $megjelenes_datumaHibaUzenet; ?></div>
            </div>
            <div class="row kozep">
                <div class="col-12"><input class="hozzaad" type='submit' value='szerkeszt'>
            </div>          
        </form>
        <?php } else { ?>
            <div class="adatok container">
                <div class="row kozep">
                    <h1 class="success col-12">Az adatok modosítása sikeresen megtörtént!</h1>
                </div>
                <div class="row kozep">
                    <a class="linkvissza col-6"  href='index.php'>Vissza a főoldalra</a>
                </div>  
            </div>  
        <?php } ?>
    </div>
</body>
</html>