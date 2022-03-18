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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Ajouter produit</title>
</head>

<body>

    <div class="container">
        <!--créer le formulaire et utiliser l"ID pour le traitement-->
    <!-- L' enctype attribut spécifie comment les données du formulaire doivent 
    être encodées lors de leur soumission au serveur, peut être utilisé que si method="post".-->
        <form method="post" action="traitementAjoutProduit.php" id="form-update" method="post" enctype="multipart/form-data">
                <h1 class="text-center text-primary" >Ajouter un produit</h1>

                    <div class="md-3">
                        <label for="nomProduit">Nom du Produit</label>
                        <input type="text" class="form-control" id="nomProduit" name="nomProduit" required>
                    </div>

                    <div class="-md-3">
                        <label for="descriptionProduit">Description du Produit</label>
                        <textarea rows="4" class="form-control" id="descriptionProduit" name="descriptionProduit" required></textarea>
                    </div>
                
                    <div class="md-3">
                        <label for="prixProduit">Prix du Produit</label>
                        <input type="number" step="0.01" class="form-control" id="prixProduit" name="prixProduit" required>
                    </div>
                    <div class="md-3">
                    <label for="stockProduit">Produit disponible</label>
                    <select class="form-control" id="stockProduit" name="stockProduit" required>
                        <option value="0"> Oui</option>
                        <option value="1"> Nom</option>
                    </select>
                    </div>

                    <div class="md-3">
                        <label for="dateDepot">Date de dépot</label>
                        <input type="date" class="form-control" id="dateDepot" name="dateDepot" required>
                    </div>

                    <div class="md-3">
                        <label for="imageProduit">Image du Produit</label>
                        <input type="file" class="form-control" id="imageProduit" name="imageProduit" required>
                    </div>



                <button type="submit"  class="btn btn-primary" name="btnConnexion"> Ajouter un produit</button>
                <a href="produits.php" class="btn btn-info">Annuler</a>

        </form>

    </div>

<?php

 }else{
            echo "<a href='' class='btn btn-info'>S'inscrire</a>";
            header("location :../index.php");
 }
        
        ?>
</body>
</html>
