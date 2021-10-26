<?php

require_once 'db.php';
require_once 'zene.php';

$zeneId = $_GET['id'] ?? null;

if ($zeneId === null) {
    header('Location: index.php');
    exit();
}

$zene = Zene::getById($zeneId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ujCim = $_POST['cim'] ?? '';
    $ujEloado = $_POST['eloado'] ?? '';
    $ujStilus = $_POST['stilus'] ?? '';
    $ujHossz = $_POST['hossz'] ?? 0;
    $ujMegjelenes_datuma = $_POST['megjelenes_datuma'] ?? '';

    $zene->setCim($ujCim);
    $zene->setEloado($ujEloado);
    $zene->setStilus($ujStilus);
    $zene->setHossz($ujHossz);
    $zene->setMegjelenesDatuma(new DateTime($ujMegjelenes_datuma));

    $zene->mentes();
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
<div class="adatok container">
        <form method='POST'>
            <div class="row">
                <p class="col-4">Cím:</p>
                <div class="col-8"><input type='text' name='cim' value='<?php echo $zene->getCim(); ?>'></div>
            </div>
            <div class="row">
                <p class="col-4">Előadó:</p>
                <div class="col-8"><input type='text' name='eloado' value='<?php echo $zene->getEloado(); ?>'></div>
            </div>
            <div class="row">
                <p class="col-4">Stílus:</p>
                <div class="col-8"><input type='text' name='stilus' value='<?php echo $zene->getStilus(); ?>'></div>
            </div>
            <div class="row">
                <p class="col-4">Zene hossza (percben):</p>
                <div class="col-8"><input type='number' name='hossz' value='<?php echo $zene->getHossz(); ?>'></div>
            </div>
            <div class="row">
                <p class="col-4">Megjelenés dátuma:</p>
                <div class="col-8"><input type='text' name='megjelenes_datuma' value='<?php echo $zene->getMegjelenesDatuma(); ?>'></div>
            </div>
            <div class="row kozep">
                <div class="col-12"><input class="hozzaad" type='submit' value='szerkeszt'>
            </div>
        </form>
    </div>
</body>
</html>