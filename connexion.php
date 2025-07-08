<?php
include "header.php";
require_once "bd.php";
require_once "fonction.php";
//Verification de la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    if(empty($email) || empty($mdp)){
      $_SESSION['error'] = 'Veuillez remplir tous les champs';
    }else{
      $utilisateur = connexionUtilisateur($email, $mdp);
      if($utilisateur){
        $_SESSION["id_etudiant"] = $utilisateur['id'];
        $_SESSION["nom_etudiant"] = $utilisateur['nom'];
        $_SESSION["prenom_etudiant"] = $utilisateur['prenom'];
        $_SESSION["email_etudiant"] = $utilisateur['email'];
        header('Location: index.php');
        exit;
      }else{
        $_SESSION['error'] = 'Email ou mot de passe incorrect';
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6 border rounded p-4 bg-white shadow">

        <h2 class="text-center mb-4">Formulaire de connexion</h2>

        <form method="POST">

          <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger" role="alert">
              <?php echo $_SESSION['error']; ?>
            </div>
            <?php endif; ?>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" placeholder="exemple@mail.com">
          </div>

          <div class="mb-3">
            <label for="mdp" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" name="mdp" placeholder="********">
          </div>

          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="conditions">
            <label class="form-check-label" for="conditions">
              Rester connecté
            </label>
          </div>

          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Se connecter</button>
          </div>
          vous n'avez pas de compte ? <a class="text-decoration-none" href="inscription.php">Inscrivez-vous ici</a>
        </form>

      </div>
    </div>
  </div>
  <?php
    include "footer.php";
  ?>
</body>
</html>