<?php require_once("../template.php");?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="inscription.css">
    <link rel="stylesheet" href="../popup.css">
    <link rel="icon" type="image/x-icon" href="../LMEV Motif/mot3_cranevache.png">
    <title>Catalogue</title>
</head>
<body oncontextmenu="return false">
titi
<?php
$Motifs = $mysqlClient -> prepare("SELECT * FROM motifs");
$Motifs -> execute();
$Motifs = $Motifs->fetch();

$path = "..\LMEV Motif\\";
foreach($Motifs as $m)
{
    echo'
    <div class="motif">
        <img src='.$path.$m['image'].' alt='.$m['nom_mtf'].'>
    </div>
    ';
}
?>
    <img src="..\LMEV Motif\mot1_punkachat.jfif">
</body>
</html>