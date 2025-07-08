<?php
include "header.php";
require_once "bd.php";
require_once "fonction.php";


//Verification de la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $confirmeMdp = $_POST['confirmeMdp'];

    if(empty($nom) || empty($prenom) || empty($email) || empty($mdp) || empty($confirmeMdp)){
      $_SESSION['error'] = 'Veuillez remplir tous les champs';
    }elseif($mdp != $confirmeMdp){
      $_SESSION['error'] = 'Les mots de passe ne correspondent pas';
    }else{

      creerEtudiant($nom, $prenom, $email, $mdp);
      //connexion de l'utilisateur après l'inscription
      $utilisateur = connexionUtilisateur($email, $mdp);
      $_SESSION["id_etudiant"] = $utilisateur['id'];
      $_SESSION["nom_etudiant"] = $utilisateur['nom'];
      $_SESSION["prenom_etudiant"] = $utilisateur['prenom'];
      $_SESSION["email_etudiant"] = $utilisateur['email'];
      header('Location: index.php');
      exit;
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6 border rounded p-4 bg-white shadow">

        <h2 class="text-center mb-4">Formulaire d'inscription</h2>

        <form method="POST">
          <!-- Affichage des erreurs  -->
           <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger" role="alert">
              <?php echo $_SESSION['error']; ?>
            </div>
            <?php endif; ?>

          <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" name="nom" placeholder="Entrez votre nom">
          </div>

          <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" name="prenom" placeholder="Entrez votre prénom">
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" placeholder="exemple@mail.com">
          </div>

          <div class="mb-3">
            <label for="mdp" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" name="mdp" placeholder="********">
          </div>

          <div class="mb-3">
            <label for="confirmeMdp" class="form-label">Confirmer le mot de passe</label>
            <input type="password" class="form-control" name="confirmeMdp" placeholder="********">
          </div>

          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="conditions">
            <label class="form-check-label" for="conditions">
              Accepter les termes et les conditions
            </label>
          </div>

          <div class="d-grid">
            <button type="submit" class="btn btn-primary">S'inscrire</button>
          </div>
          Vous avez deja un compte ? <a class="text-decoration-none" href="connexion.php">Connectez-vous ici</a>
        </form>

      </div>
    </div>
  </div>
<?php
include "footer.php";
?>
</body>
</html>