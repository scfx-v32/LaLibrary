<?php
include 'headers/header1.php';
include 'config.php';

$message = '';
if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse = $_POST['adresse'];
    $tel = $_POST['phone'];
    $email = $_POST['email'];
    $pwd = password_hash($_POST['pwd'], PASSWORD_BCRYPT);
    $role = '';

    $a = explode('@', $email);
    if ($a[1] === 'admin.com') {
        $role = 'admin';
    } else {
        $role = 'user';
    }

    $sql = "INSERT INTO users (nom, prenom, adresse, tel, email, pwd, role_) VALUES ('$nom','$prenom','$adresse','$tel','$email','$pwd','$role')";
    $stmt = $cnx->query($sql);

    if ($stmt) {
        header('Location: login.php');
        exit();
    } else {
        $message = 'Erreur lors de l\'inscription.';
    }
}
?>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card w-50 h-100">
        <div class="card-body">
            <?php if (!empty($message)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $message ?>
                </div>
            <?php endif; ?>
            <form action="register.php" method="post">
                <h2 class="text-center">Inscription</h2>
                <hr>
                <div class="form-group">
                    <label for="nom">Nom :</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>
                <div class="form-group">
                    <label for="prenom">Prenom :</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" required>
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse :</label>
                    <input type="text" class="form-control" id="adresse" name="adresse" required>
                </div>
                <div class="form-group">
                    <label for="phone">Téléphone :</label>
                    <input type="tel" class="form-control" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="pwd">Mot de passe :</label>
                    <input type="password" class="form-control" id="pwd" name="pwd" required>
                </div>
                <input type="submit" class="btn btn-primary" name="submit" value="Enregistrer">
            </form>
            <div class="dropdown-divider"></div>
            <p>Vous avez déjà un compte? <a href="login.php">Connectez-vous.</a></p>
        </div>
    </div>
</div>
</body>
</html>
