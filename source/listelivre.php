<?php
include "config.php";
include "headers/header2.php";

if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['role_'] === 'admin') {
        $sql = "SELECT Books.*, Categories.label as category_label 
                FROM Books 
                JOIN Categories ON Books.category_id = Categories.id";
        $result = $cnx->query($sql);
    } else {
        header("Location: main.php");
        exit;
    }
} else {
    header("Location: login.php"); // Redirect to login if not authenticated
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Livres</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Année</th>
                    <th>ISBN</th>
                    <th>Description</th>
                    <th>Photo</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Catégorie</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['titre']); ?></td>
                    <td><?php echo htmlspecialchars($row['auteur']); ?></td>
                    <td><?php echo htmlspecialchars($row['annee']); ?></td>
                    <td><?php echo htmlspecialchars($row['isbn']); ?></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                    <td><img src="<?php echo htmlspecialchars($row['photo']); ?>" alt="Book Photo" width="100"></td>
                    <td><?php echo htmlspecialchars(number_format($row['prix'], 2)); ?> DH</td>
                    <td><?php echo htmlspecialchars($row['quantite']); ?></td>
                    <td><?php echo htmlspecialchars($row['category_label']); ?></td>
                    <td><a href="modlivre.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Modifier</a></td>
                    <td><a href="supplivre.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this book?')">Supprimer</a></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <?php
         include "headers/footer.php";
    ?>
</body>
</html>
