<?php
//demarer la session
session_start();

if(isset($_SESSION['email'])){

?>
<h1 class="h1-accueil">Bienvenue</h1>

<p class="h1-accueil"><?= $_SESSION['email'] ?></p>


<!DOCTYPE html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    
    <title>Detail Produit</title>

</head>
<body>
<?php

//faire la connexion avec la variable phpmyadmin
$user = "root";
$pass = "" ;

//faire le test en cas d'erreur pour avoir le contenu de la page avec le try catch
try {
    //faire la class PDO (l'orienté objet)
    $baseDonnee1 = new PDO('mysql:host=localhost;dbname=base1;charset=UTF8', $user, $pass);

    // faire le Debug de pdo
  
    $baseDonnee1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<h4 class='container alert alert-info text-center'>Vous êtes connectez a PDO MySQL</h4>";

    //catch pour attraper l'exception
}catch(PDOException $e){
    print "Erreur !: " . $e->getMessage() . "<br>";
    die();
}  
//la condition pour la requete de selection

//faire la requette SQL de type SELECT
 if($baseDonnee1){

    //Requète SQL de selection des produits 
    $sql = "SELECT * FROM produits WHERE idProduit = ?";
    //variable idProduit
    $idProduit = $_GET["idProduit"];

    //preparer la requette avec "prepare"
    //Lorsque la requête est préparée, la base de données va analyser, 
    //compiler et optimiser son plan pour exécuter la requête.
    $requete = $baseDonnee1->prepare($sql);

    //recuperer la valeur id grace à $-GET['idProduit'] et l'analyser
    $requete->bindParam(1, $idProduit);
    //exécuter la requête
    $requete->execute();

    //PDO:FETCH_ASSOCplace les résultats dans un tableau où les valeurs 
    //sont mappées à leurs noms de champ.
    $detailProduit = $requete->fetch(PDO::FETCH_ASSOC);

}

?>
    <div class="container bg-dark">
        <div class="mx-auto bg-info w-50" id="detailProduit">&²

            <img src="<?= $detailProduit['imageProduit'] ?>"/>
            
            <div class="card-body">
                <h2 class="card-title"><?= $detailProduit['nomProduit'] ?></h2>
                <p class="card-text"><?= $detailProduit['descriptionProduit'] ?></p>
                <p class="card-text">Prix : <?= $detailProduit['prixProduit'] ?> £ </p>
                <p class="card-text">Produit disponible:
                    <!--faire la condition si le produit est disponible-->
                    <?php
                    //stocker dans une variable
                    $depot = new Datetime($detailProduit['dateDepot']);

                    if($detailProduit['dateDepot'] == true){
                        echo "OUI";
                    }else{
                        echo "NON";
                    }
                    
                    ?>
                </p>
                <em class="card-text">Date de depot : <?= $depot->format('d-m-Y') ?></em>
                                    <br />

                                    <div class="container">

                                        <a href="produits.php" class="btn btn-outline-primary btn-lg mb-2">RETOUR</a>
                                        <a href="#" class="btn btn-outline-primary btn-lg mb-2">Panier</a>
                                    </div>  
                                    
            </div>
        </div>
    </div>    
    <?php
        }else{
            echo "<a href='' class='btn btn-info'>S'inscrire</a>";
            header("location :../index.php");
        }
        ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>