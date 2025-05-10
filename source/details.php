<?php
include_once "config.php";
include "headers/header2.php";

// Fetch book details based on ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM books WHERE id = :id";
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $book = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    // Redirect to main.php if ID is not provided
    header('Location: main.php');
    exit();
}

// Check user role to include appropriate header
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Livre</title>
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
        <?php if (isset($_GET['success']) && $_GET['success'] == 1) : ?>
            <div class="alert alert-success" role="alert">
                Livre ajouté au panier.
            </div>
        <?php endif; ?>
        <div class="row d-flex align-items-start">
            <div class="col-md-4">
                <img src="<?php echo htmlspecialchars($book['photo']); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($book['titre']); ?>">
            </div>
            <div class="col-md-8">
                <div class="card w-100 h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($book['titre']); ?></h5>
                        <p class="card-text"><strong>Auteur:</strong> <?php echo htmlspecialchars($book['auteur']); ?></p>
                        <p class="card-text"><strong>Prix:</strong> <?php echo number_format($book['prix'], 2); ?> DH</p>
                        <p class="card-text"><strong>Année:</strong> <?php echo htmlspecialchars($book['annee']); ?></p>
                        <p class="card-text"><strong>ISBN:</strong> <?php echo htmlspecialchars($book['isbn']); ?></p>
                        <p class="card-text"><strong>Quantité disponible:</strong> <?php echo htmlspecialchars($book['quantite']); ?></p>
                        <p class="card-text"><strong>Description:</strong> <?php echo htmlspecialchars($book['description']); ?></p>

                        <?php if (isset($_SESSION['user']) && $_SESSION['user']['role_'] === 'admin') : ?>
                            <!-- Admin actions -->
                            <div class="mt-3">
                                <a href="supplivre.php?id=<?php echo $book['id']; ?>" class="btn btn-danger btn-block" onclick="return confirm('Are you sure you want to delete this book?')">Supprimer</a>
                                <a href="modlivre.php?id=<?php echo $book['id']; ?>" class="btn btn-warning btn-block">Modifier</a>
                            </div>
                        <?php else : ?>
                            <!-- Regular user action -->
                            <form action="addtocart.php" method="post">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($book['id']); ?>">
                                <button type="submit" class="btn btn-brown btn-block">Ajouter au Panier</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <br><br>
    <br><br>
    <div>
    <?php
         include "headers/footer.php";
    ?>
    </div>
</body>

</html>
