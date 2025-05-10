<?php
session_start();
include_once "config.php";

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    $_SESSION['error_message'] = "Accès non autorisé.";
    header('Location: main.php');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $user_id = $_SESSION['user']['id'];

    // Fetch order details to get the book_id and quantite
    $stmt = $cnx->prepare("SELECT * FROM orders WHERE id = :order_id AND user_id = :user_id");
    $stmt->bindValue(':order_id', $order_id, PDO::PARAM_INT);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$order) {
        $_SESSION['error_message'] = "Commande non trouvée ou vous n'êtes pas autorisé à l'annuler.";
        header('Location: panier.php');
        exit();
    }

    // Delete order from orders table
    $stmt = $cnx->prepare("DELETE FROM orders WHERE id = :order_id");
    $stmt->bindValue(':order_id', $order_id, PDO::PARAM_INT);
    $stmt->execute();

    // Update the books quantite in books table
    $stmt = $cnx->prepare("UPDATE books SET quantite = quantite + :quantity WHERE id = :book_id");
    $stmt->bindValue(':quantity', $order['quantity'], PDO::PARAM_INT);
    $stmt->bindValue(':book_id', $order['book_id'], PDO::PARAM_INT);
    $stmt->execute();

    $_SESSION['success_message'] = "Commande annulée avec succès.";
    header('Location: panier.php');
    exit();
} else {
    $_SESSION['error_message'] = "Erreur lors de l'annulation de la commande.";
    header('Location: panier.php');
    exit();
}
?>
