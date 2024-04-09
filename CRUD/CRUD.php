<?php
require_once($_SERVER['DOCUMENT_ROOT']."/e-commerce/template.php");
require_once($_SERVER['DOCUMENT_ROOT']."/e-commerce/functions.php");
?>

<?php

if(isset($_POST['del_type']))
{   
    ?>
    <form method="post">
        <div id="popup" class="popup">
            <div class="popup-content">
                <div id="error-message" class="error-message">Êtes-vous sûr de vouloir supprimé cette catégorie ?</div>
            </div>
        <div class="button">
            <button type="submit" name="OK" value="OK">Oui</button>
        </div>
        <input type="hidden" id="idType" name="idType" value="<?= $_POST['id_type'] ?>">
        <div class="button">
            <button type="submit" name="NO" value="NO">Non</button>
        </div>
        </div>
    </form>
    <?php
}
if(isset($_POST["OK"]))
    {
        $idType = $_POST['idType'];
        $delete = $mysqlClient->prepare("DELETE  FROM type_pdt as t WHERE t.id_type = $idType");
        $delete -> execute();
        $deletePdt = $mysqlClient->prepare("DELETE  FROM produits as p WHERE p.id_type = $idType");
        $deletePdt -> execute();
    
        // Confirmation
        echo
        '<div id="popup" class="popup">
            <div class="popup-content">
                <div id="error-message" class="error-message">Catégorie supprimée ainsi que les produits liés à cette catégorie.</div>
            </div>
        </div>';
    }

try
    {
        // Insertion des données entrées dans la BDD
        if(isset($_POST["register"]) && !empty($_POST['addType']) && validChar())
        {
            // htmlspecialchars convertie les caractères en entités html pour éviter attaques XSS
            $NewType = htmlspecialchars($_POST["addType"], ENT_QUOTES, 'UTF-8');
            
            $NewTypeQuery= "INSERT into type_pdt(type_pdt)
            VALUES ('$NewType')";
            $NewTypeQ = $mysqlClient->prepare($NewTypeQuery);
            $NewTypeQ->execute();

            // Confirmation
            echo
            '<div id="popup" class="popup">
                <div class="popup-content">
                    <div id="error-message" class="error-message">Catégorie ajoutée.</div>
                </div>
            </div>';

            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        }
    }
    // Popup si un utilisateur utilise déjà l'adresse e-mail saisie
    catch (PDOException $e)
    {
        if ($e->errorInfo[1] === 1062)
        {
            // Gérer l'erreur d'intégrité de contrainte
            $TypeDupli = "Cette catégorie est déjà dans la base de données.\nVeuillez en saisir une autre.";

            echo
            '<div id="popup" class="popup">
                <div class="popup-content">
                    <div id="error-message" class="error-message">'
                    .nl2br($TypeDupli).
                    '</div>
                </div>
            </div>';
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="crud.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/e-commerce/template.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/e-commerce/popup.css">
    <link rel="icon" type="image/x-icon" href="../LMEV Motif/mot3_cranevache.png">
    <title>Inscription</title>
</head>
<body oncontextmenu="return false">

<div class="gestType">
    <h1>Gestion des Catégories</h1>
    <table>
        <tr>
            <th>Id</th>
            <th>Catégories</th>
            <th>Supprimer</th>
        </tr>
    <?php

    $catégorie = $mysqlClient->prepare('SELECT * FROM type_pdt');
    $catégorie->execute();
    $catégorie = $catégorie->fetchAll();

    foreach($catégorie as $c) { ?>

        <form class="delete_type" method="post">
            <tr><td colspan="9"></td></tr>
            <tr>
                <td>
                    <input type="hidden" id="id_type" name="id_type" value="<?= $c['id_type']?>">
                    <?= $c['id_type'] ?>
                </td>
                <td>
                    <input type="hidden" name="type_pdt" value="<?= $c['type_pdt']?>">
                    <?= $c['type_pdt'] ?>
                </td>
                <td>
                    <button type="submit" name="del_type" value="del_type">
                        Supprimer
                    </button>
                </td>
            </tr>
        </form>
        <?php } ?>
    </table>

    <form name = "addType" method = "post">
        <label for="addType">Ajouter une catégorie : </label>
        <div class="input">
            <input type="text" id="addType" name = "addType" onkeypress="verifChar(event)" placeholder="Nouvelle catégorie" data-error-for="addTypeError">
            <span id="addTypeError" class="error"></span>
        </div>
        <div class="button">
            <button type="submit" name="register" value="Add">Ajouter</button>
        </div>
    </form>
    </div>

<script src="../verifChar.js"></script>
<script src="../popup.js"></script>
</body>
</html>