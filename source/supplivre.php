<?php
include_once "config.php";
include "headers/header2.php";

// Check if book ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete book from database
    $sql = "DELETE FROM books WHERE id = '$id'";
    $stmt = $cnx->query($sql);
    
    if ($stmt) {
        $message = "Livre supprimé avec succès.";

    } else {
        $message = "Erreur lors de la suppression du livre.";
    }
} else {
    // Redirect to main.php if ID is not provided
    header('Location: main.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer Livre</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .bg-brown {
            background-color: #8d6e63;
        }

        .btn-brown {
            background-color: #5a3e36;
            color: #ffffff;
        }

        .card {
            height: 100%;
        }
    </style>
</head>

<body class="bg-light text-dark">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Supprimer Livre</h5>
                        <p class="card-text text-center"><?php echo $message; ?></p>
                        <div class="text-center">
                            <a href="listelivre.php" class="btn btn-brown">Retour à la Liste des Livres</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
