<?php
include_once "headers/header2.php";
include_once "config.php";

$message = '';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Escape user inputs for safety (not using prepared statements)
    $titre = htmlspecialchars($_POST['titre']);
    $auteur = htmlspecialchars($_POST['auteur']);
    $annee = htmlspecialchars($_POST['annee']);
    $isbn = htmlspecialchars($_POST['isbn']);
    $description = htmlspecialchars($_POST['description']);
    $prix = htmlspecialchars($_POST['prix']);
    $quantite = htmlspecialchars($_POST['quantite']);
    $category_id = htmlspecialchars($_POST['category_id']);
    
    // Handle file upload
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        $photo_path = $target_file;
    } else {
        $message = "Sorry, there was an error uploading your file.";
        $photo_path = '';
    }
    
    // Check if photo upload was successful before inserting into database
    if (!empty($photo_path)) {
        // Construct SQL query (not using prepared statements)
        $sql = "INSERT INTO books (titre, auteur, annee, isbn, description, photo, prix, quantite, category_id)
                VALUES ('$titre', '$auteur', '$annee', '$isbn', '$description', '$photo_path', '$prix', '$quantite', '$category_id')";

        // Execute the query
        if ($cnx->query($sql)) {
            $message = "Livre ajouté avec succès.";
        } else {
            $message = "Erreur lors de l'ajout du livre.";
        }
    }
}
?>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card w-75 h-100">
    <?php
            // Display message if set
            if (!empty($message)) {
                echo "<p class='mt-3 text-center'>$message</p>";
            }
            ?>
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Ajouter un Livre</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <div class="form-group row">
                    <label for="titre" class="col-sm-3 col-form-label">Titre:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="titre" name="titre" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="auteur" class="col-sm-3 col-form-label">Auteur:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="auteur" name="auteur" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="annee" class="col-sm-3 col-form-label">Année:</label>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" id="annee" name="annee" required>
                    </div>
                    <label for="isbn" class="col-sm-3 col-form-label">ISBN:</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="isbn" name="isbn" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="photo">Photo:</label>
                    <input type="file" class="form-control-file" id="photo" name="photo" required>
                </div>
                <div class="form-group row">
                    <label for="prix" class="col-sm-3 col-form-label">Prix:</label>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" id="prix" name="prix" step="0.01" required>
                    </div>
                    <label for="quantite" class="col-sm-3 col-form-label">Quantité:</label>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" id="quantite" name="quantite" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="category_id">Catégorie:</label>
                    <select class="form-control" id="category_id" name="category_id" required>
                        <option value="">Sélectionner une catégorie</option>
                        <?php
                        // Fetch categories from database
                        $query = "SELECT * FROM categories";
                        $result = $cnx->query($query);
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $row['id'] . "'>" . $row['label'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Ajouter Livre</button>
            </form>
            
        </div>
    </div>
</div>
<?php
         include "headers/footer.php";
?>
</body>
</html>