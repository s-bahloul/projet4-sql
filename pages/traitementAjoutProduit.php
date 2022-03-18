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
    
    
    <title>Ajout Produit</title>
</head>
<body>
<?php
//$_FILES — Variable de téléchargement de fichier via HTTP
if(isset($_FILES['imageProduit'])){
    
    //recupérer son image dans le dossier destination
    $destinPhoto = "../img/";

    //basename — Retourne le nom de la composante finale d'un chemin

 $produitPhoto = $destinPhoto . basename($_FILES['imageProduit']['name']);
    //On recupére la photo et on l'assigne au repertoire de destination 
   
    $_POST['imageProduit'] =  $produitPhoto ;
    
    //Faire la condition de reussite
    //move_uploaded_file — Déplace un fichier téléchargé

    if(move_uploaded_file($_FILES['imageProduit']['tmp_name'], $produitPhoto)){

        echo "<h2 class='text-center'>Le fichier est téléchargé avec succès !</h2>";

        //afficher l'erreur sur le téléchargement du fichier
    }else{
        echo "<h2 class='text-center'>Erreur lors du téléchargement de votre fichier !</h2>";
    }
    
    //erreur sur le format de l'image
}else{
    echo "<h2 class='text-center'>Fichier invalide : seul les format .png, .jpg, .bmp, .svg, .webp sont autorisé !</h2>";
}

//variable phpmyadmin
$user = "root";
$pass = "";

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

 
if($baseDonnee1){
 //faire l'enquete SQL pour plusieurs produits 
//L'instruction INSERT INTO est utilisée pour ajouter de nouveaux enregistrements à une table MySQL
$sql = "INSERT INTO `produits`(`idProduit`, `nomProduit`, `descriptionProduit`, `prixProduit`, `stockProduit`, `dateDepot`, `imageProduit`) VALUES (?,?,?,?,?,?,?)";

$nouveau = $baseDonnee1->prepare($sql);

//Liés les paramètre du formulaire a la table phpmyadmin

//Lier chaque paramètre à un nom de variable 

$nouveau->bindParam(1, $_POST['idProduit']);
$nouveau->bindParam(2, $_POST['nomProduit']);
$nouveau->bindParam(3, $_POST['descriptionProduit']);
$nouveau->bindParam(4, $_POST['prixProduit']);
$nouveau->bindParam(5, $_POST['stockProduit']);
$nouveau->bindParam(6, $_POST['dateDepot']);
$nouveau->bindParam(7, $_POST['imageProduit']);

//Executer la requete et là passer dans un tableau avec les valeur

$nouveau->execute(array(
    $_POST['idProduit'],
    $_POST['nomProduit'],
    $_POST['descriptionProduit'],
    $_POST['prixProduit'],
    $_POST['stockProduit'],
    $_POST['dateDepot'],
    $_POST['imageProduit'],
));


    if($nouveau){
        echo "<h2 class='text-info text-center'>Votre produit a été ajouté avec succès !</h2>";
        echo "<a href='produits.php' class='container btn btn-info'>Voir mon nouveau produit</a>";
    }else{
        echo "<h2 class='text-info text-center'>Erreur lors de l'ajout de produit</h2>";
    }
    }

    }else{
    echo "<a href='' class='btn btn-primary'>S'inscrire</a>";
    header("location :../index.php");
    }

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>




</body>
</html>