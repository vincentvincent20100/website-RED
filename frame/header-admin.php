<?php
  session_start();

  // création connexion bdd pour toutes les pages de l'admin
  try {
    $serveur="mysql:host=localhost; dbname=resaendirect-dev-code";
    $user="root";
    $pass="";
    $connect=new PDO($serveur,$user,$pass); //PDO php data object
    $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING); // afficher les erreurs
  } catch (Exception $e) {
    echo "Problème de connexion avec la base de donnée, veuillez réessayer plus tard".$e->getMessage();
  }

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/admin.css">
    <title>Tableau de bord</title>
  </head>
  <body>
    <header>
      <div class="divGoToSite">
        <a href="index.php"><button class="goToSite">Aller sur le site</button></a>
      </div>
      <nav><p>
        <a href="admin-article-liste.php">Article</a>
        <a href="admin-addArticle.php"><button>+</button></a>
        <a href="admin-annonce.php">Annonce</a>
        <a href="admin-addAnnonce.php"><button>+</button></a>
        <a href="admin-popup.php">Pop-up</a>
        <a href="admin-addpopup.php"><button>+</button></a>
        <?php if ($_SESSION['statu'] == "administrateur") {
          echo '<a href="admin-utilisateur.php" class="opt">Gestion des utilisateurs</a>';
        } ?>
        <a href="admin-image.php" class="opt">Gestion des images</a>
        <a href="admin.php" class="opt">Statistiques</a>
        <a href="admin-duplication.php">D</a>
        <a href="test1-admin-article.php">T1</a>
        <a href="test2-admin-article.php">T2</a>
        <a href="test3-admin-article.php">T3</a>
        <a href="test4-admin-article.php">T4</a>
      </p></nav>
      <?php
      // vérification identification
      if ($_SESSION['connexion'] != "connecté") { // s'il n'est pas noté comme connecté, on propose les options suivantes
        echo "Vous devez vous connecter avec compte pour accéder à cette page<br>";
        echo "<p id='formulaireIdentification'>Connexion administration</p><br>";
        echo '<script src="form/connexion.js" charset="utf-8"></script>'; // script écoutant l'id 'formulaireIdentification' ci-dessus
        echo "<a href='index.php'>Accueil</a>";
        die();
      }else { // s'il est connecté, on propose un bouton déconnexion
        echo "<div class='avatar'>
        <p>".$_SESSION['identifiant']."<a href='form/connexion.php?out=oui'> <img src='img/pictogramme/off(grey).png'></a></p>
        <p> [".$_SESSION['statu']."]</p>
        </div>";
      }
       ?>
    </header>
    <main>
