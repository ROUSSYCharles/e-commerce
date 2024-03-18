<?php require_once("../template.php");?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Catalogue.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/e-commerce/Template.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/e-commerce/popup.css">
    <link rel="icon" type="image/x-icon" href="../LMEV Motif/mot3_cranevache.png">
    <title>Catalogue</title>
</head>
<body oncontextmenu="return false">
    <?php
    $Motifs = $mysqlClient->prepare("SELECT * FROM motifs WHERE catalogue = 1");
    $Motifs->execute();
    $resultats = $Motifs->fetchAll();

    if ($resultats) {
        foreach ($resultats as $m) {
            // URL vers les images
            $imageURL = "../LMEV Motif/" . $m['image'];
    ?>
            <div class="catalogue">
                <div class="motif">
                    <img src="<?php echo $imageURL; ?>" alt="<?php echo $m['nom_mtf']; ?>">
                </div>
            </div>
    <?php
        }
    } else {
        echo "Aucun motif trouvé.";
    }
    ?>
</body>
</html>
