<?php
//Pour démarer une nouvelle session
session_start();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.css">
   
    
    
    <title>CONNEXION</title>
</head>
<body>
<div class="container">

  <div class="bg-img">
    <form  class="container" method="post">
      <h1 class="h1-conect ">CONNEXION</h1>

      <label for="email" class="text-white" ><b>Email</b></label>
      <input type="email" placeholder="Enter Email" name="email" required>

      <label for="formConnect" class="text-white" ><b>Mot de passe</b></label>
      <input type="password"  name="password" placeholder="Enter Mot de passe" id="formConnect" required>

      <button type="submit"  name="btnConnect" class="btn text-white bg-info">Connexion</button>
    </form>
  </div>

</div>


<?php

    //le click pour la connexion (isset : varaible déclaré et differente de null) 
    //on utilise la variable HTTP POST

    if(isset($_POST["btnConnect"])){
        
        //var_dump ($email);
        connexion();
    }

    //faire la functin avec la condition avec l'existance des champs mail et mot de passe de

    function connexion(){

    //Email fictif
    $email = "dalidi915@gmail.com";
    $password = "1234";

    //hydrater les champs
    $emailUser = trim(htmlspecialchars($_POST['email']));
    $passwordUser = trim(htmlspecialchars($_POST['password']));

    //si les champs ne sont pas vide
    //on recupére avec $_post pour envoyer à une autre page
    if(isset($emailUser) && !empty($emailUser) && isset($passwordUser) && !empty($passwordUser)){
    
    
      //Condition d'egalité de mail et de mot de passe
      if($emailUser == $email && $passwordUser == $password){

          $_SESSION['email'] = $emailUser;

          //redirection php vers la page de multiplication
          header("Location: pages/produits.php");
          
      }else{
        echo "<h2 class='p-blan text-white'>MERCI DE REMPLIR LES CHAMPS</h2>";
      }

    }else{
      echo "<h2 class='p-blan text-white'>ERREUR DE CONNEXION</h2>";
    }
    }
    ?>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>  
</body>
</html>