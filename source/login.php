<?php
include "config.php";

$message = '';
if (isset($_POST["connecter"])) {
    if (!empty($_POST['email']) && !empty($_POST['pwd'])) {

        $email = $_POST['email'];
        $password = $_POST['pwd'];

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $user = $cnx->query($sql)->fetch();

        if ($user && password_verify($password, $user['pwd'])) {
            session_start();
            $_SESSION['user'] = $user;
            header('Location: main.php');
            exit();
        } else {
            $message = 'Mauvais identifiants';
        }
    } else {
        $message = "L'email et mot de passe sont obligatoires";
    }
}
include_once "headers/header1.php";

?>
<br><br>
<h1 class="text-center">Connectez-vous pour effectuer vos achats.</h1>
<br><br><br>
<div class="container d-flex justify-content-center align-items-center min-vh-80">
      
    <div class="card w-90 h-100">
        <div class="card-body">
            
            <form action="login.php" method="post">
            <h2 class="text-center">Connexion</h2>
            <hr>
            <?php if (!empty($message)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $message ?>
                </div>
            <?php endif; ?>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label for="pwd">Mot de passe:</label>
                    <input type="password" class="form-control" name="pwd" required>
                </div>
                <input type="submit" class="btn btn-primary" name="connecter" value="Se connecter">
            </form>
            <div class="dropdown-divider"></div>
            <p>Pas encore un membre? <a href="register.php">Inscrivez-vous.</a></p>
        </div>
    </div>
</div>
</body>
</html>
