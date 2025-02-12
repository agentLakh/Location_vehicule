<?php
session_start();
require_once 'config.php'; 
$erreur = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    //email : admin@gmail.com    mot de passe : admin1234@
    if ($email === 'admin@gmail.com' && $password === 'admin1234@') {
        $_SESSION['user_id'] = 1;
        $_SESSION['role'] = 'admin';
        header('Location: admin_dashboard.php');
        exit();
    }

    $sql = "SELECT id_client, mot_de_passe FROM clients WHERE email = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user) {
        $erreur = "Email introuvable";
    } elseif (!password_verify($password, $user["mot_de_passe"])) {
        $erreur = "Mot de passe incorrect";
    } else {
        $_SESSION["id_client"] = $user["id_client"];
        header("Location: index.php"); 
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
    <h1>Connexion</h1>

    <?php if ($erreur): ?>
        <p style="color: red;"><?php echo $erreur; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <input type="email" name="email" placeholder="Email" required>
        <br>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <br>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>