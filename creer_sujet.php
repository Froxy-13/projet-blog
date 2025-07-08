<?php
include "header.php";
include "bd.php";
include "fonction.php";



//Verifier la soumission du formulaire
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //Récuperer les données du formulaire
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $auteur_id = $_SESSION['id_etudiant'];
    //Valider les données
    if(empty($titre) || empty($contenu)){
      $_SESSION['error'] = 'Veuillez remplir tous les champs';
      header('Location: creer_sujet.php');
      exit;
    }else{
    //Inserer les données dans la base de données
    if(creerSujet($titre, $contenu, $auteur_id)){
      $_SESSION["success"] = "Votre sujet a été créé avec succès";
    }else{
      $_SESSION["error"] = "Erreur lors de la création du sujet";
    }
}
}
//Recupération des sujets
$sujets = listerSujets();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creer_sujet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>
<form action="creer_sujet.php" method="POST">
<div class="container w-50  border rounded shadow">
    <h1>Entrez un nouveau sujet</h1>
    <!-- Affichage des messages de succès -->
     <?php if(isset($_SESSION['success'])): ?>
      <div class="alert alert-success">
        <?php echo $_SESSION['success'];
        unset($_SESSION['success']);
      ?>
      </div>
      <?php endif; ?>

    <!-- Affichage des messages d'erreur -->
    <?php if(isset($_SESSION['error'])): ?>
      <div class="alert alert-danger">
        <?php echo $_SESSION['error'];
        unset($_SESSION['error']);
      ?>
      </div>
      <?php endif; ?>
    <?php if(isset($message)): ?>
      <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

<div class="mb-5">
  <label for="titre" class="form-label">Titre</label>
  <input type="text" class="form-control" name="titre" placeholder="... est ma treizième raison">
</div>
<div class="mb-3">
  <label for="contenu" class="form-label">Contenu</label>
  <textarea class="form-control" name="contenu" rows="3"></textarea>
</div>
<div class="text-center">
<button type="submit" class="btn btn-primary">Publier</button>
</div>
</div>
</form>
<?php
include "footer.php";
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>