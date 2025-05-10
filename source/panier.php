<?php

include_once "config.php";
include "headers/header2.php";

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    $_SESSION['error_message'] = "Accès non autorisé.";
    header('Location: main.php');
    exit();
}

// Fetch orders for the logged-in user
$user_id = $_SESSION['user']['id'];
$stmt = $cnx->prepare("SELECT orders.*, books.titre AS book_title, books.photo AS book_photo
                       FROM orders
                       INNER JOIN books ON orders.book_id = books.id
                       WHERE orders.user_id = :user_id
                       ORDER BY orders.date_c DESC");
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .order-container {
            border: 1px solid #ccc;
            margin-bottom: 20px;
            padding: 10px;
        }

        .book-image {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>
<body class="bg-light text-dark">

<div class="container">
    <h1 class="mt-4 mb-4">Panier</h1>

    <?php if (!empty($_SESSION['success_message'])) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['success_message']; ?>
        </div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <?php if (!empty($_SESSION['error_message'])) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['error_message']; ?>
        </div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <?php if (empty($orders)) : ?>
        <div class="alert alert-info" role="alert">
            Votre panier est vide.
        </div>
    <?php else : ?>
        <?php foreach ($orders as $order) : ?>
            <div class="order-container">
                <div class="row">
                    <div class="col-md-3">
                        <img src="<?php echo $order['book_photo']; ?>" class="img-fluid book-image" alt="<?php echo $order['book_title']; ?>">
                    </div>
                    <div class="col-md-6">
                        <h5><?php echo $order['book_title']; ?></h5>
                        <p><strong>Prix Total:</strong> <?php echo number_format($order['prix_t'], 2); ?> DH</p>
                        <p><strong>Date de Commande:</strong> <?php echo date('d/m/Y H:i:s', strtotime($order['date_c'])); ?></p>
                    </div>
                    <div class="col-md-3">
                        <form action="annulercommande.php" method="post">
                            <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                            <button type="submit" class="btn btn-danger btn-block">Annuler la commande</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php include "headers/footer.php"; ?>

</body>
</html>
