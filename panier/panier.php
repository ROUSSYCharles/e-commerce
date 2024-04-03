<?php
require_once("../template.php");
require_once($_SERVER['DOCUMENT_ROOT']."/e-commerce/functions.php");
?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="panier.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/e-commerce/template.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/e-commerce/popup.css">
    <link rel="icon" type="image/x-icon" href="../LMEV Motif/mot3_cranevache.png">
    <title>Catalogue</title>
</head>
<body oncontextmenu="return false">

<?php
// Vérifie si le panier existe dans la session et n'est pas vide
if(isset($_SESSION['panier']) && !empty($_SESSION['panier'])) { 
    // Parcours du panier pour afficher chaque produit
?>
<div class="panier">
    <table>
        <tr>
            <th>Motif</th>
            <th>Produit</th>
            <th>Référence</th>
            <th>Type</th>
            <th>Genre</th>
            <th>Taille</th>
            <th>Quantité</th>
            <th>Prix Unitaire</th>
            <th>Supprimer</th>
        </tr>
    <?php
    foreach($_SESSION['panier'] as $index => $produit) {
        $motif = $mysqlClient->prepare("SELECT motifs.image from motifs
        INNER JOIN produits as p ON p.id_motif = motifs.id_mtf
        WHERE p.id_pdt = ".$produit['id_pdt']);
        $motif->execute();
        $motif = $motif->fetch();

        if($motif['image'])
        {
            $imageURL = "../LMEV Motif/".$motif['image'];
        }?>

        <form class="delete_p" method="post">
            <tr><td colspan="9"></td></tr>
            <tr>
                <td>
                    <div class="motif">
                        <img src="<?= $imageURL ?>">
                    </div>
                </td>
                <td>
                    <input type="hidden" name="index_pdt" value="<?= ($index + 1) ?>">
                    <?= ($index + 1) ?>
                </td>
                <td>
                    <input type="hidden" name="id_pdt" value="<?= $produit['id_pdt']?>">
                    <?= $produit['id_pdt'] ?>
                </td>
                <td>
                    <input type="hidden" name="type_pdt" value="<?= $produit['type_pdt']?>">
                    <?= $produit['type_pdt'] ?>
                </td>
                <td>
                    <input type="hidden" name="genre" value="<?= $produit['genre']?>">
                    <?= $produit['genre'] ?>
                </td>
                <td>
                    <input type="hidden" name="taille" value="<?= $produit['taille']?>">
                    <?= $produit['taille'] ?>
                </td>
                <td>
                    <input type="hidden" name="quantity" value="<?= $produit['quantity']?>">
                    <?= $produit['quantity'] ?>
                </td>
                <td>
                    <input type="hidden" name="prix" value="<?= $produit['prix']?>">
                    <?= $produit['prix'] ?>€
                </td>
                <td>
                    <button type="submit" name="del_panier" value="del_panier">
                        Supprimer du panier
                    </button>
                </td>
            </tr>
        </form>
        <?php } ?>
    </table>
    </div>
        

<?php
} else {
    echo "Le panier est vide.";
}

if(isset($_POST['del_panier']))
{
    if(!empty($_SESSION['panier']))
    {
        unset($_SESSION['panier'][$index]);

        echo
        '<div id="popup" class="popup">
            <div class="popup-content">
                <div id="error-message" class="error-message">Produit supprimé.</div>
            </div>
        </div>';
    }
}
?>
</body>
</html>
