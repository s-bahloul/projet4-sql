<?php

//pour une nouvelle session (demarer)

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
    <title>Produit suprimé</title>
</head>
<header>
        <?php
        require_once "navbar.php";
        ?>
    </header>
<body>
        <!--faire les variable de phpmyadmin-->
        <?php
        $user = "root";
        $pass = "";
        //faire le try catch pour les erreurs
        try{
            $baseDonnee1 = new PDO('mysql:host=localhost; dbname=base1; charset=UTF8', $user, $pass);
            
            //faire le debug
            $baseDonnee1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            echo "<h4 class='container alert alert-info text-center'>Vous êtes connectez a PDO MySQL</h4>";

        }catch(PDOException $e){
            print "ERREUR !: " . $e->getMessage() . "<br>";
            die();
        }

        if($baseDonnee1){
            //faire la requete SQL
            $sql = "SELECT * FROM produits WHERE idProduit = ?";

            $idProduit = $_GET['idProduit'];
            //on accède à la methode query() grace à PDO

            //Requète prépare
            $requete = $baseDonnee1->prepare($sql);

            //Lié les paramètres
            $requete->bindParam(1, $idProduit);

            //Executer la requète
            $requete->execute();

            //afficher un objet de resultats
            $details = $requete->fetch(PDO::FETCH_ASSOC);
        }

        //afficher le produits
        ?>
    <div class="container bg-dark">
        <div class="mx-auto bg-info w-50" id="detailProduit">
    

            <img src="<?= $details['imageProduit'] ?>" class="card-img-top" alt="image-produit">

            <div class="card-body" >

                <h5 class="card-title"><?=$details['nomProduit']?></h5>
                <p class="card-text"><?= $details['descriptionProduit'] ?></p>
                <h4 class="text-center text-white">SUPRIMER LE PRODUIT</h4>

                <div class="container">

                <form method="post">
                    <button type="submit" name="btn-supprimer" class="btn btn-outline-primary btn-lg mb-2">Confimer la supression</button>
                </form>

                <a href="produits.php" class="btn btn-outline-primary btn-lg mb-2">Annuler</a>
                </div>

            </div>
        </div>

    </div>
    <?php
    if(isset($_POST['btn-supprimer'])){

        //selectionner des produits
        $sql = "DELETE FROM `produits` WHERE idProduit =  ?";

        //  preparer la requete sql 

        $effacer = $baseDonnee1->prepare($sql);

        //Recup de id du produit
        $ProduitId = $_GET['idProduit'];

        //Lié les paramètres du bouton a la requète SQL
        $effacer->bindParam(1, $ProduitId);

        //exécuter la requete
        $effacer->execute();

        if($effacer){

            echo "<h2 class='text-center'>Votre produit est supprimé !</h2>";
            ?>
            <style>
                #detailProduit{
                    display: none;
                }
            </style>
            <?php
    
            
            //faire le bouton de retours sur la page produits
            echo "<div class='container'><a href='produits.php' class='mt-3 btn btn-success'>Retour</a></div>";
           
        }else{
            echo "<p class='alert alert-danger'>Erreur  !</p>";
            }

        }
    }else{
            echo "<a href='' class='btn btn-info'>S'inscrire</a>";
            header("location :../index.php");
        }
    
    ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
