<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $mot_de_passe = password_hash($_POST["mot_de_passe"], PASSWORD_DEFAULT);
    $date_naissance = $_POST["date_naissance"];
    $adresse = $_POST["adresse"];
    $numero_permis = $_POST["numero_permis"];

    $hashed_password = password_hash($mot_de_passe, PASSWORD_DEFAULT);
    $sql = "INSERT INTO clients (nom, prenom, email, mot_de_passe, date_naissance, adresse, numero_permis) VALUES (?, ?, ?, ?, ?, ?, ?)";

    $query = $db->prepare($sql);


    if ($query->execute([$nom, $prenom, $email, $mot_de_passe, $date_naissance, $adresse, $numero_permis])) {
        session_start();
        $_SESSION["id_client"] = $db->lastInsertId(); // Récupère l'ID du client inscrit
        header("Location: index.php"); // Rediriger vers l'accueil
        exit();
    } else {
        header("Location: inscription.php?erreur=Erreur lors de l'inscription");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription du client</title>
</head>
<body>
    <?php if (isset($_GET["erreur"])): ?>
        <p style="color: red;"><?= htmlspecialchars($_GET["erreur"]) ?></p>
    <?php endif; ?>
    <form action="" method="POST">
        <input type="text" name="nom" placeholder="Nom" required>
        <input type="text" name="prenom" placeholder="Prénom" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
        <input type="date" name="date_naissance" required>
        <input type="text" name="adresse" placeholder="Adresse" required>
        <input type="text" name="numero_permis" placeholder="Numéro de permis" required>
        <button type="submit">S'inscrire</button>
    </form>
</body>
</html>