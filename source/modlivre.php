<?php
include_once "config.php";
include "headers/header2.php";

$message = '';

// Check if book ID is provided
if (!isset($_GET['id'])) {
    header('Location: main.php');
    exit();
}

$id = $_GET['id'];

// Fetch book details from the database
$sql = "SELECT * FROM books WHERE id = :id";
$stmt = $cnx->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$book = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if book exists
if (!$book) {
    header('Location: main.php');
    exit();
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $annee = $_POST['annee'];
    $isbn = $_POST['isbn'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $quantite = $_POST['quantite'];
    $category_id = $_POST['category_id'];
    
    // Handle file upload
    if ($_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            $photo_path = $target_file;
        } else {
            $message = "Sorry, there was an error uploading your file.";
            $photo_path = ''; // Reset photo path if upload failed
        }
    } else {
        // No new file uploaded, retain existing photo path
        $photo_path = $book['photo'];
    }
    
    // Update the book details in the database
    $sql = "UPDATE books SET 
            titre = :titre, 
            auteur = :auteur, 
            annee = :annee, 
            isbn = :isbn, 
            description = :description, 
            photo = :photo, 
            prix = :prix, 
            quantite = :quantite, 
            category_id = :category_id 
            WHERE id = :id";
    
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
    $stmt->bindParam(':auteur', $auteur, PDO::PARAM_STR);
    $stmt->bindParam(':annee', $annee, PDO::PARAM_INT);
    $stmt->bindParam(':isbn', $isbn, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);
    $stmt->bindParam(':photo', $photo_path, PDO::PARAM_STR);
    $stmt->bindParam(':prix', $prix, PDO::PARAM_INT);
    $stmt->bindParam(':quantite', $quantite, PDO::PARAM_INT);
    $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        $message = "Livre modifié avec succès.";
        // Redirect to details page after modification
        header("Location: details.php?id=$id");
        exit();
    } else {
        $message = "Erreur lors de la modification du livre.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Livre</title>
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
            width: 80%;
            margin: 20px auto;
        }
    </style>
</head>

<body class="bg-light text-dark">
    <div class="container">
        <div class="card w-100 h-100">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Modifier un Livre</h2>
                <?php if (!empty($message)) : ?>
                    <div class="alert alert-info" role="alert">
                        <?= $message ?>
                    </div>
                <?php endif; ?>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=$id"); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="titre">Titre:</label>
                        <input type="text" class="form-control" id="titre" name="titre" value="<?= htmlspecialchars($book['titre']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="auteur">Auteur:</label>
                        <input type="text" class="form-control" id="auteur" name="auteur" value="<?= htmlspecialchars($book['auteur']); ?>" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="annee">Année:</label>
                            <input type="number" class="form-control" id="annee" name="annee" value="<?= htmlspecialchars($book['annee']); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="isbn">ISBN:</label>
                            <input type="text" class="form-control" id="isbn" name="isbn" value="<?= htmlspecialchars($book['isbn']); ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required><?= htmlspecialchars($book['description']); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo:</label>
                        <input type="file" class="form-control-file" id="photo" name="photo">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="prix">Prix:</label>
                            <input type="number" class="form-control" id="prix" name="prix" value="<?= htmlspecialchars($book['prix']); ?>" step="0.01" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="quantite">Quantité:</label>
                            <input type="number" class="form-control" id="quantite" name="quantite" value="<?= htmlspecialchars($book['quantite']); ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Catégorie:</label>
                        <select class="form-control" id="category_id" name="category_id" required>
                            <?php
                            // Fetch categories from database
                            $query = "SELECT * FROM categories";
                            $result = $cnx->query($query);
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                $selected = ($row['id'] == $book['category_id']) ? 'selected' : '';
                                echo "<option value='" . $row['id'] . "' $selected>" . $row['label'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <input type="submit" class="btn btn-primary btn-block" value="Modifier Livre">
                </form>
            </div>
        </div>
    </div>
    <?php
         include "headers/footer.php";
    ?>
</body>

</html>
