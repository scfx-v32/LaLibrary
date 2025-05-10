<?php
session_start();
include_once "config.php";

if(!isset($_SESSION['user'])){
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $book_id = $_POST['id'];
    $user_id = $_SESSION['user']['id'];

    // Fetch book details to get the price and current quantity
    $stmt = $cnx->prepare("SELECT prix, quantite FROM books WHERE id = :book_id");
    $stmt->bindValue(':book_id', $book_id, PDO::PARAM_INT);
    $stmt->execute();
    $book = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$book) {
        // Redirect to main.php if book ID is not valid (though this should ideally not happen)
        header('Location: main.php');
        exit();
    }

    $quantity = 1;  // You can modify this if you want to allow the user to select a quantity

    // Calculate total price for the current order
    $total_price = $book['prix'] * $quantity;

    // Check if the book is already in the cart
    $stmt = $cnx->prepare("SELECT * FROM orders WHERE user_id = :user_id AND book_id = :book_id");
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindValue(':book_id', $book_id, PDO::PARAM_INT);
    $stmt->execute();
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($order) {
        // If the book is already in the cart, update the quantity and total price
        $stmt = $cnx->prepare("UPDATE orders SET quantity = quantity + :quantity, prix_t = prix_t + :total_price WHERE id = :order_id");
        $stmt->bindValue(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindValue(':total_price', $total_price, PDO::PARAM_STR);
        $stmt->bindValue(':order_id', $order['id'], PDO::PARAM_INT);
        $stmt->execute();
    } else {
        // If the book is not in the cart, add a new entry in orders table
        $stmt = $cnx->prepare("INSERT INTO orders (book_id, user_id, date_c, date_l, prix_t) VALUES (:book_id, :user_id, NOW(), DATE_ADD(CURDATE(), INTERVAL 3 DAY), :total_price)");
        $stmt->bindValue(':book_id', $book_id, PDO::PARAM_INT);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':total_price', $total_price, PDO::PARAM_STR);
        $stmt->execute();
    }

    // Update the quantity of the book in the books table
    $stmt = $cnx->prepare("UPDATE books SET quantite = quantite - :quantity WHERE id = :book_id");
    $stmt->bindValue(':quantity', $quantity, PDO::PARAM_INT);
    $stmt->bindValue(':book_id', $book_id, PDO::PARAM_INT);
    $stmt->execute();

    // Redirect back to the details page with a success message
    header('Location: details.php?id=' . $book_id . '&success=1');
    exit();
} else {
    // Redirect to main.php if the request is invalid
    header('Location: main.php');
    exit();
}
?>
