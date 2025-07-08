<?php
include "header.php";
require_once "bd.php";
require_once "fonction.php";

$sujets = listerSujets();

//Verifier la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sujet_id']) && isset($_POST['contenu']) && isset($_SESSION['id_etudiant'])) {
  $contenu = trim($_POST['contenu']);
  $auteur_id = $_SESSION['id_etudiant'];
  $sujet_id = (int) $_POST['sujet_id'];
    //Valider les données
    if (empty($contenu)) {
      $_SESSION['error'] = 'Veuillez remplir tous les champs';
      header('Location: voir_sujet.php');
      exit;
    }else{
    //Inserer les données dans la base de données
    if (creerCommentaire($contenu, $auteur_id, $sujet_id)) {
      $_SESSION["success"] = "Votre commentaire a été créé avec succès";
  } else {
      $_SESSION["error"] = "Erreur lors de la création du commentaire";
}
}
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Voir les sujets</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Liste des sujets</h2>
    <a href="creer_sujet.php" class="btn btn-primary">Créer un sujet</a>
  </div>

  <?php if (empty($sujets)): ?>
    <div class="alert alert-info">Aucun sujet n’a encore été publié.</div>
  <?php else: ?>
    <?php foreach ($sujets as $sujet): ?>
      <div class="card mb-3 shadow-sm">
        <div class="card-body">
          <h5 class="card-title"><?= htmlspecialchars($sujet['titre']) ?></h5>
          <p class="card-text"><?= nl2br(htmlspecialchars($sujet['contenu'])) ?></p>
          <p class="card-text">
            <small class="text-muted">
                Publié par <?= htmlspecialchars(getNomAuteur($sujet['auteur_id'])) ?> 
                le <?= date('d/m/Y à H:i', strtotime($sujet['date_creation'])) ?>
            </small>
            </p>
    <!--permettre aux autres utilisateurs de commenter un sujet avec la fonction creerCommentaire() dans fonction.php -->
          <?php if (isset($_SESSION["id_etudiant"])): ?>
            <form action="" method="POST">
            <input type="hidden" name="sujet_id" value="<?= $sujet['id'] ?>">
              <div class="mb-3">
                <label for="contenu" class="form-label">Commentaire</label>
                <textarea class="form-control" name="contenu" rows="3"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
          <?php endif; ?>
        </div>
      </div>
      <!-- Affichage des commentaires d'un sujet avec la fonction listerCommentaires() dans fonction.php -->
      <?php
  $commentaires = listerCommentaires($sujet['id']);
?>
<div class="card mb-3 shadow-sm">
  <div class="card-body">
    <h5 class="card-title">Commentaires</h5>
    <?php if ($commentaires): ?>
      <?php foreach ($commentaires as $commentaire): ?>
        <div class="mb-3">
          <p class="card-text"><?= nl2br(htmlspecialchars($commentaire['contenu'])) ?></p>
          <p class="card-text">
            <small class="text-muted">
              Commentaire par <?= htmlspecialchars(getNomAuteur($commentaire['auteur_id'])) ?>
              le <?= date('d/m/Y à H:i', strtotime($commentaire['date_creation'])) ?>
            </small>
          </p>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="text-muted">Aucun commentaire pour ce sujet.</p>
    <?php endif; ?>
  </div>
</div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

<?php include "footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
