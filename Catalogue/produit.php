<?php
require_once("../template.php");
require_once($_SERVER['DOCUMENT_ROOT']."/e-commerce/functions.php");
?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="produit.css">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']; ?>/e-commerce/template.css">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']; ?>/e-commerce/popup.css">
    <link rel="icon" type="image/x-icon" href="../LMEV Motif/mot3_cranevache.png">
    <title>Catalogue</title>
</head>
<body oncontextmenu="return false">
<?php
    $imageURL = "";
    if(isset($_GET['id'])){
        $id_motif = decrypt_id($_GET['id']);
        $cpt_bt = 0;

        $motif = $mysqlClient->prepare("SELECT * FROM motifs WHERE id_mtf = :id_motif");
        $motif->bindValue(':id_motif', $id_motif, PDO::PARAM_INT);
        $motif->execute();
        $motif = $motif->fetch(PDO::FETCH_ASSOC);

        $produits = $mysqlClient->prepare('SELECT id_pdt, genre, t.taille as taille , ty.type_pdt as type_pdt, prix_pdt, stock_pdt FROM produits as p
        INNER JOIN taille_pdt as t ON p.id_taille = t.id_taille
        INNER JOIN type_pdt as ty ON p.id_type = ty.id_type
        WHERE id_motif ='.$id_motif);
        $produits->execute();
        $produits = $produits->fetchAll();

        if($motif){
            $imageURL = "../LMEV Motif/".$motif['image'];
        }?>
        <div class="motif">
            <img src="<?php echo $imageURL; ?>">
        
            <div class="description">
                    <h2>
                        <?php echo $motif['nom_mtf']?>
                    </h2>
                    <table>
                        <tr>
                            <th>Référence</th>
                            <th>Type</th>
                            <th>Genre</th>
                            <th>Taille</th>
                            <th>Stock</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                            <th>Ajouter</th>
                        </tr>
                        <?php foreach ($produits as $p) {?>
                            <form class ="description" method="post">
                                <tr>
                                    <td>
                                        <input type="hidden" name="reference" value="<?= $p['id_pdt'] ?>">
                                        <?= $p['id_pdt'] ?>
                                    </td>
                                    <td>
                                        <input type="hidden" name="type" value="<?= $p['type_pdt'] ?>">
                                        <?= $p['type_pdt'] ?>
                                    </td>
                                    <td>
                                        <input type="hidden" name="genre" value="<?= $p['genre'] ?>">
                                        <?= $p['genre'] ?>
                                    </td>
                                    <td>
                                        <input type="hidden" name="taille" value="<?= $p['taille'] ?>">
                                        <?= $p['taille'] ?>
                                    </td>
                                    <td>
                                        <input type="hidden" name="stock" value="<?= $p['stock_pdt'] ?>">
                                        <?= $p['stock_pdt'] ?>
                                    </td>
                                    <td>
                                        <input type="hidden" name="prix" value="<?= $p['prix_pdt'] ?>">
                                        <?= $p['prix_pdt'] ?>€
                                    </td>
                                    <td>
                                        <select name="quantité" id="quantité">
                                            <?php for ($i=1; $i <= $p['stock_pdt']; $i++) { ?>
                                                <option value="<?= $i ?>"><?= $i?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td>
                                        <button type="submit" name="add_panier" value="add_panier">
                                            Ajouter au panier
                                        </button>
                                    </td>
                                </tr>
                            </form>
                        <?php } ?>
                    </table>
            </div>
        </div>
    <?php
    }

    if(isset($_POST['add_panier']))
    {
        if(!produitInPanier($_POST['reference']))
        {
            // Stocke les informations du produit dans une variable de session
            $_SESSION['panier'][] = array(
                'id_pdt' => $_POST['reference'],
                'type_pdt' => $_POST['type'],
                'genre' => $_POST['genre'],
                'taille' => $_POST['taille'],
                'stock' => $_POST['stock'],
                'prix' => $_POST['prix'],
                'quantity' => $_POST['quantité']
            );
        }
        else{
            foreach($_SESSION['panier'] as &$produit) {
                if($produit['id_pdt'] == $_POST['reference'])
                {
                    $produit['quantity'] = $_POST['quantité'];
                    break;
                }
            }
        }
        var_dump($_SESSION['panier']);

       // confirmation d'ajout du produit au panier
       echo
        '<div id="popup" class="popup">
            <div class="popup-content">
                <div id="error-message" class="error-message">Produit ajouté au panier.</div>
            </div>
        </div>';
    }

?>

<script src="../popup.js"></script>
</body>
</html>