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

<header>
        <?php
        require_once "navbar.php";
        ?>
</header>
     
    <!--créer le bouton de deconnexion -->
    <div class="btn-deconect">
        <form method="post" >
            <button class="btn btn-info" name="btn-deconnexion" >Deconnexion</button>
        </form>
    </div>
    <?php
    function deconnexion(){
        
        session_unset();
        session_destroy();
        header('Location: ../index.php');
    }

    //faire la deconnexion avec le bouton 
    if(isset($_POST['btn-deconnexion'])){
        deconnexion();
    }

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


//faire la même requette que pour suprimer ou faire le detail d'un produits

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

<div class="container">
    <!--créer le formulaire et utiliser l"ID pour le traitement-->
   <!-- L' enctype attribut spécifie comment les données du formulaire doivent 
   être encodées lors de leur soumission au serveur, peut être utilisé que si method="post".-->

   <form  action="traitementEditProduit.php?idProduit=<?= $detailProduit['idProduit'] ?>" method="post" id="form-update"  enctype="multipart/form-data">
        <h1 class="text-center text-primary bg-info">Editer le produit</h1>

            <div class="md-3">
                <label for="nomProduit">Nom du Produit</label>
                <input type="text" class="form-control" id="nomProduit" name="nomProduit" placeholder="<?= $detailProduit['nomProduit'] ?>" required>
            </div>

            <div class="-md-3">
                <label for="descriptionProduit">Description du Produit</label>
                <textarea rows="4" class="form-control" id="descriptionProduit" name="descriptionProduit" placeholder=" <?= $detailProduit['descriptionProduit'] ?>" required></textarea>
            </div>
           
    
            <div class="md-3">
                <label for="prixProduit">Prix du Produit</label>
                <input type="number" step="0.01" class="form-control" id="prixProduit"  name="prixProduit" placeholder="<?= $detailProduit['prixProduit'] ?>" required>
            </div>
            <div class="md-3">
            <label for="stockProduit">Produit disponible</label>
            <select class="form-control" id="stockProduit" name="stockProduit" placeholder="<?= $detailProduit['stockProduit'] ?>" required>
                <option value="0"> Oui</option>
                <option value="1"> Nom</option>
            </select>
            </div>

            <div class="md-3">
                <label for="dateDepot">Date de dépot</label>
                <input type="date" class="form-control" id="dateDepot"  name="dateDepot" placeholder="<?= $detailProduit['dateDepot'] ?>" required>
            </div>

            <div class="md-3">
                <label for="imageProduit">Image du Produit</label>
                <input type="file" class="form-control" id="imageProduit" name="imageProduit" placeholder="<?= $detailProduit['imageProduit'] ?>" required>
            </div> required>
            </div>

        
        <button type="submit"  class="btn btn-primary" name="btnConnexion">Mettre à jour le produit</button>
        <a href="produits.php" class="btn btn-info">Annuler</a>

    </form>

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