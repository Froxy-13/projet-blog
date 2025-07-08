<?php

include "header.php";
require_once "bd.php";
require_once "fonction.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accueil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <div class="container my-5">
    <div class="row align-items-center">
      <!-- Texte à gauche -->
      <div class="col-md-8">
        <h1 class="h3 fw-semibold mb-2">Bloc de l'Amicale des étudiants de l'ESTM</h1>
        <p class="text-muted small">
          Bienvenue sur notre espace dédié aux étudiants, à la solidarité et à la réussite collective. <br>
          Ici nous partageons nos pensées librement sans crainte et sans jugement. Alors créer vite votre <br> compte et rejoignez-nous. 
        </p>
        <?php if (isset($_SESSION["id_etudiant"])): ?>
        <a href="voir_sujet.php" ><button type="button" class="btn btn-info">Voir les sujets</button></a>
        <a href="creer_sujet.php" ><button type="button" class="btn btn-info">Créer un sujet</button></a>
        <?php elseif (!isset($_SESSION["id_etudiant"])): ?>
          <a href="connexion.php" ><button type="button" class="btn btn-info">Voir les sujets</button></a>
          <a href="connexion.php" ><button type="button" class="btn btn-info">Créer un sujet</button></a>
        <?php endif; ?>
      </div>

      <!-- Image à droite -->
      <div class="col-md-4 text-end">
        <img src="JC.jpg" alt="JC" class="img-fluid rounded-circle shadow" style="max-width: 270px;">
      </div>
    </div>
  </div>

<?php include "footer.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
