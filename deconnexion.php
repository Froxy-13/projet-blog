<?php
session_start();
//Suppression de toutes les variables de session
session_unset();
//Destruction de la session
session_destroy();
//Redirection vers la page accueil
header('Location: index.php');
exit();
?>