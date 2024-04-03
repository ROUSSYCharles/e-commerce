<?php
require_once("../template.php");
require_once($_SERVER['DOCUMENT_ROOT']."/e-commerce/functions.php");?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="catalogue.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/e-commerce/template.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/e-commerce/popup.css">
    <link rel="icon" type="image/x-icon" href="../LMEV Motif/mot3_cranevache.png">
    <title>Catalogue</title>
</head>
<body oncontextmenu="return false">
    <?php
    // On récupère les motifs qui doivent être présents dans le catalogue
    $Motifs = $mysqlClient->prepare("SELECT * FROM motifs WHERE catalogue = 1");
    $Motifs->execute();
    $resultats = $Motifs->fetchAll();

    if ($resultats) {
        foreach ($resultats as $m) {
            // URL vers les images
            $imageURL = "../LMEV Motif/" . $m['image'];
            // Chiffrement de l'id du motif qui passera dans l'url pour afficher la page produit.php
            $encryptedId = encrypt_id($m['id_mtf']);
    ?>
            
            <div class="catalogue">
                <div class="motif">
                    <? // Renvoie vers la page contenant les produits liés au motif?>
                    <a href="produit.php?id=<?php echo  urlencode($encryptedId); ?>">
                        <img src="<?php echo $imageURL; ?>" alt="<?php echo $m['nom_mtf']; ?>">
                    </a>
                </div>
            </div>
    <?php
        }
    } else { // Aucun motif
        echo "Aucun motif trouvé.";
    }
    ?>
</body>
</html>
