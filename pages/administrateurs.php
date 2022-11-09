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
    <title>Administrateurs</title>
</head>

<body>
<header>
        <?php
        require_once "navbar.php";
        ?>
</header>

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
    $sql = "SELECT `idUsers`, `email`, `password` FROM `users`";
    $users = $baseDonnee1->query($sql);
    
    ?>

    //faire la requete 
    <div class="container">
        <table class="table">
            <h4 class="text-white">Liste des utilisateurs</h4>
                <thead>
                    <tr>
                        <th class="text-white" scope="col">Id</th>
                        <th class="text-white" scope="col">Email</th>
                        <th class="text-white" scope="col">Mot de pass</th>
                        <th>

                        
                        </td>
                    </td>
                 </tr>
                    </tr>
                </thead>

           
                <?php
                //on parcoure notre tableau avec foreach
                foreach ($users as $user){
                ?>
                 <tbody>
                    <tr>
                        <th class="text-white" scope="row"><?=$user['idUsers']?></th>
                            <td class="text-white" ><?=$user['email']?></td>
                            <td class="text-white" ><?=$user['password']?></td>
                            <td><a class="btn btn-info text-white"  href="suprimUser.php?idUser=<?=$user['idUsers'] ?>">Supprimer</a></td>
                    </tr>
                    
                <?php
                }
                ?>
            </tbody>
        </table>
        
        
    </div>

    <div class=container>
        <a class="btn btn-primary" href="produits.php">ALLER A LA PAGE PRODUITS</a>
    </div>
    
<?php
 }else{
            echo "<a href='' class='btn btn-info'>S'inscrire</a>";
            header("location :../index.php");
 }
        
        ?>
</body>
</html>