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
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    <form method='POST'>
        <input type='text' name='cim' value='<?php echo $zene->getCim(); ?>'><br>
        <input type='text' name='eloado' value='<?php echo $zene->getEloado(); ?>'><br>
        <input type='text' name='stilus' value='<?php echo $zene->getStilus(); ?>'><br>
        <input type='number' name='hossz' value='<?php echo $zene->getHossz(); ?>'><br>
        <input type='date' name='megjelenes_datuma' value='<?php echo $zene->getMegjelenesDatuma(); ?>'><br>
        <input type='submit' value='szerkeszt'>
    </form>
</body>
</html>