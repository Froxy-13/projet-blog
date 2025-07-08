<?php
// La fonction creerEtudiant() permet de créer un Etudiant dans la base de données.
function creerEtudiant($nom, $prenom, $email, $mdp) {
    global $pdo;
    try{
        //Hachege du mot de passe
        $mdpHache = password_hash($mdp, PASSWORD_BCRYPT);

        //preparation de la réquête d'insertion
        $requete = "INSERT INTO etudiants (prenom, nom, email, mot_de_passe) VALUES (:prenom, :nom, :email, :mdpHache)";
        $stmt = $pdo -> prepare($requete);

        $stmt->bindParam(':prenom', $prenom);
        $stmt -> bindParam(':nom', $nom);
        $stmt -> bindParam(':email', $email);
        $stmt -> bindParam(':mdpHache', $mdpHache);
        $stmt ->execute();
        return true;
    } catch (PDOException $e){
        echo "Erreur lors de la création de l'utilisateur: " . $e -> getMessage();
        return false;
    }
}

//La fonction connexionUtilisateur() permet de connecter un utilisateur en verifiant ses identifiants.
function connexionUtilisateur($email, $mdp){
    global $pdo;
    try{
        $requete = "SELECT * FROM etudiants WHERE email = :email";
        $stmt = $pdo -> prepare($requete);
        $stmt -> bindParam(':email', $email);
        $stmt -> execute();

//Verifier si l'utilisateur existe
    if($stmt -> rowCount()>0){
    $utilisateur = $stmt -> fetch(PDO::FETCH_ASSOC);

    //verification du mot de passe
    if(password_verify($mdp, $utilisateur['mot_de_passe'])){
        return $utilisateur;
    }else{
        return false;
    } 
    }else{
        return false;
    }
}catch(PDOException $e){
    echo "Erreur lors de la connexion de l'utilisateur: " . $e -> getMessage();
    return false;
}
}
// La fonction creerSujet() permet de créer un sujet dans la base de données.
function creerSujet($titre, $contenu, $auteur_id) {
    global $pdo;
        try {
            $requete = "INSERT INTO sujets (titre, contenu, auteur_id) VALUES (:titre, :contenu, :auteur_id)";
            $stmt = $pdo -> prepare($requete);
            $stmt -> bindParam(':titre', $titre);
            $stmt -> bindParam(':contenu', $contenu);
            $stmt -> bindParam(':auteur_id', $auteur_id);
            $stmt -> execute();
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de la création du sujet: " . $e -> getMessage();
            return false;
        }
    }
// La fonction creerCommentaire() permet de créer un commentaire dans la base de données.
    function creerCommentaire($contenu, $auteur_id, $sujet_id) {
        global $pdo;
        try {
            $requete = "INSERT INTO commentaires (contenu, auteur_id, sujet_id) VALUES (:contenu, :auteur_id, :sujet_id)";
            $stmt = $pdo -> prepare($requete);
            $stmt -> bindParam(':contenu', $contenu);
            $stmt -> bindParam(':auteur_id', $auteur_id);
            $stmt -> bindParam(':sujet_id', $sujet_id);
            $stmt -> execute();
            return true;
        }
        catch (PDOException $e) {
            echo "Erreur lors de la création du commentaire: " . $e -> getMessage();
            return false;
        }
    }
// La fonction supprimerSujet() permet de supprimer un sujet de la base de données.
    function supprimerSujet($id) {
        global $pdo;
        try {
            $requete = "DELETE FROM sujets WHERE id = :id";
            $stmt = $pdo -> prepare($requete);
            $stmt -> bindParam(':id', $id);
            $stmt -> execute();
            return true;
        }
        catch (PDOException $e) {
            echo "Erreur lors de la suppression du sujet: " . $e -> getMessage();
            return false;
        }
    }
// La fonction supprimerCommentaire() permet de supprimer un commentaire de la base de données.
    function supprimerCommentaire($id) {
        global $pdo;
        try {
            $requete = "DELETE FROM commentaires WHERE id = :id";
            $stmt = $pdo -> prepare($requete);
            $stmt -> bindParam(':id', $id);
            $stmt -> execute();
            return true;
        }
        catch (PDOException $e) {
            echo "Erreur lors de la suppression du commentaire: " . $e -> getMessage();
            return false;
        }
    }
//La fonction listerSujets() permet de lister tous les sujets de la base de données.
    function listerSujets() {
        global $pdo;
        try {
            $requete = "SELECT * FROM sujets";
            $stmt = $pdo -> prepare($requete);
            $stmt -> execute();
            $sujets = $stmt -> fetchAll();
            return $sujets;
        }
        catch (PDOException $e) {
            echo "Erreur lors de la récupération des sujets: " . $e -> getMessage();
            return false;
        }
    }
//La fonction auteurSujet() permet de récupérer l'auteur d'un sujet de la base de données.
function getNomAuteur($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT nom, prenom FROM etudiants WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $auteur = $stmt->fetch(PDO::FETCH_ASSOC);
    return $auteur ? $auteur['prenom'] . ' ' . $auteur['nom'] : "Auteur inconnu";
}
//La fonction listerCommentaires() permet de lister tous les commentaires d'un sujet de la base de données.
function listerCommentaires($id) {
    global $pdo;
    try {
        $requete = "SELECT * FROM commentaires WHERE sujet_id = :id";
        $stmt = $pdo -> prepare($requete);
        $stmt -> bindParam(':id', $id);
        $stmt -> execute();
        $commentaires = $stmt -> fetchAll();
        return $commentaires;
    }
    catch(PDOException $e) {
        echo "Erreur lors de la récupération des commentaires: " . $e -> getMessage();
        return false;
    }
}

?>
