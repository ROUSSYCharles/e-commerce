<?php
require_once("../template.php");
require_once($_SERVER['DOCUMENT_ROOT']."/e-commerce/functions.php");
?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="produit.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/e-commerce/template.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/e-commerce/popup.css">
    <link rel="icon" type="image/x-icon" href="../LMEV Motif/mot3_cranevache.png">
    <title>Catalogue</title>
</head>
<body oncontextmenu="return false">
<?php
$imageURL = "";
    if(isset($_GET['id'])){
        $id_motif = decrypt_id($_GET['id']);

        $motif = $mysqlClient->prepare("SELECT * FROM motifs WHERE id_mtf = :id_motif");
        $motif->bindValue(':id_motif', $id_motif, PDO::PARAM_INT);
        $motif->execute();
        $motif = $motif->fetch(PDO::FETCH_ASSOC);

        if($motif){
            $imageURL = "../LMEV Motif/".$motif['image'];
        }?>
        <div class="motif">
            <img src="<?php echo $imageURL; ?>">

            <form class="description">
            <h2>
                <?php echo $motif['nom_mtf']?>
            </h2>
            <div class="type">
                <label for="type">Type :<br></label>
                <select class="select-type" id="type">
                    <option value='1'> Sweat </option>
                    <option value='2'> Sweat à capuche </option>
                    <option value='3'> T-shirt manche courte </option>
                    <option value='4'> T-shirt manche longue </option>
                </select>
            </div>
            <div class="taille">
                <label for="taille">Taille :<br></label>
                <select class="select-taille" id="taille">
                    <option value='1'> XS </option>
                    <option value='2'> S </option>
                    <option value='3'> M </option>
                    <option value='4'> L </option>
                    <option value='5'> XL </option>
                </select>
            </div>
            <div class="genre">
                <label for="genre">Genre :<br></label>
                <select class="select-genre" id="genre">
                    <option value='1'> Homme </option>
                    <option value='2'> Femme </option>
                </select>
            </div>
        </form>
        </div>
    <?php
    }

?>

</body>
</html>