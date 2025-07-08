<?php session_start(); ?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="index.php">ESTM</a>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <?php if (isset($_SESSION["id_etudiant"])): ?>
          <li class="nav-item">
            <a class="nav-link link-primary" href="voir_sujet.php">
              Sujets
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link link-danger" href="deconnexion.php">Déconnexion</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link link-warning" href="inscription.php">
              Inscription
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link link-success" href="connexion.php">
              Connexion
            </a>
          </li>
        <?php endif; ?>
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="bi bi-moon"></i></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
