<?php
include_once "config.php";

// Check if user is logged in and is admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role_'] !== 'admin') {
    $_SESSION['error_message'] = "Accès non autorisé.";
    header('Location: main.php');
    exit();
}

// Function to fetch all orders
function getAllOrders() {
    global $cnx;
    $sql = "SELECT orders.*, books.titre AS book_title, users.nom AS user_nom, users.prenom AS user_prenom
            FROM orders
            INNER JOIN books ON orders.book_id = books.id
            INNER JOIN users ON orders.user_id = users.id
            ORDER BY orders.date_c DESC";
    $stmt = $cnx->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch all orders
$orders = getAllOrders();


include "headers/header2.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Commandes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .bg-brown {
            background-color: #8d6e63;
        }

        .btn-brown {
            background-color: #5a3e36;
            color: #ffffff;
        }

        .table {
            margin-top: 20px;
        }

        /* Sticky footer styles */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            position: relative;
        }

        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            background-color: #f8f9fa; /* Adjust as needed */
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body class="bg-light text-dark">

<div class="container">
    <h1 class="mt-4 mb-4">Liste des Commandes</h1>

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

    <table class="table table-bordered">
        <thead class="bg-brown text-white">
            <tr>
                <th scope="col">ID Commande</th>
                <th scope="col">Livre</th>
                <th scope="col">Utilisateur</th>
                <th scope="col">Date de Commande</th>
                <th scope="col">Date de Livraison</th>
                <th scope="col">Prix Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <td><?php echo $order['id']; ?></td>
                    <td><?php echo htmlspecialchars($order['book_title']); ?></td>
                    <td><?php echo htmlspecialchars($order['user_nom'].' '.$order['user_prenom']); ?></td>

                    <!-- Convert date_c and date_l to Unix timestamps -->
                    <td><?php echo date('d/m/Y H:i:s', strtotime($order['date_c'])); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($order['date_l'])); ?></td>

                    <td><?php echo number_format($order['prix_t'], 2); ?> DH</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<footer class="footer">
    <?php include "headers/footer.php"; ?>
</footer>

</body>
</html>
