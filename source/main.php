<?php
include_once "config.php";
include_once "headers/header2.php";


// Fetch categories from database
$sql_categories = "SELECT * FROM categories";
$result_categories = $cnx->query($sql_categories);
$categories = $result_categories->fetchAll(PDO::FETCH_ASSOC);

// Initialize empty search term and category
$searchTerm = '';
$categoryFilter = '';
$categoryName = '';

// Check if search term is set in the URL
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
}

// Check if category is set in the URL
if (isset($_GET['category'])) {
    $categoryFilter = $_GET['category'];

    // Fetch the category name
    $stmt_category = $cnx->prepare("SELECT label FROM categories WHERE id = :category_id");
    $stmt_category->bindValue(':category_id', $categoryFilter, PDO::PARAM_INT);
    $stmt_category->execute();
    $category = $stmt_category->fetch(PDO::FETCH_ASSOC);
    $categoryName = $category['label'];
}

// Prepare SQL statement to fetch books based on search term and category
$sql = "SELECT * FROM books WHERE 1=1";

if (!empty($searchTerm)) {
    $sql .= " AND (titre LIKE :search OR auteur LIKE :search OR description LIKE :search)";
}

if (!empty($categoryFilter)) {
    $sql .= " AND category_id = :category";
}

$stmt = $cnx->prepare($sql);

if (!empty($searchTerm)) {
    $stmt->bindValue(':search', '%' . $searchTerm . '%', PDO::PARAM_STR);
}

if (!empty($categoryFilter)) {
    $stmt->bindValue(':category', $categoryFilter, PDO::PARAM_INT);
}

$stmt->execute();
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaLibrary</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        
        .bg-brown {
            background-color: #8d6e63;
        }

        .btn-brown {
            background-color: #5a3e36;
            color: #ffffff;
        }

        .product-list {
            height: calc(100vh - 136px);
            overflow-y: auto;
        }

        .card {
            height: 400px;
            width: 300px;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .category {
            display: block;
            width: 100%;
            cursor: pointer;
            padding: 10px;
            margin: 5px 0;
            background-color: #8d6e63;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
        }

        .category:hover {
            background-color: #5a3e36;
        }

        .card-img-top {
            height: 326px;
            width: 200px;
            object-fit: cover;
        }

        #ima {
            margin-left: 75px;
        }
    </style>
</head>

<body class="bg-light text-dark">
    <nav class="navbar navbar-expand-sm navbar-dark bg-brown">
        <div class="container">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="main.php">Accueil</a></li>
                &nbsp;
                <?php
                if (isset($_SESSION['user'])) {
                    if ($_SESSION['user']['role_'] === 'admin') {
                ?>
                        <li class="nav-item"><a class="nav-link" href="listelivre.php">Tous les Livres</a>
                            &nbsp;
                    <?php }
                }
                    ?>
                        <li class="nav-item"><a class="nav-link" href="#">À propos</a></li>
                        &nbsp;

                        <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <aside class="col-md-2 bg-white p-4 border-right">
                <h3>Catégories</h3>
                <?php foreach ($categories as $category) : ?>
                    <a href="?category=<?= $category['id'] ?>" class="category"><?php echo htmlspecialchars($category['label']) ?></a>
                <?php endforeach; ?>
            </aside>

            <div class="col-md-10 mt-4">
                <!-- Display search term if set -->
                <?php if (!empty($searchTerm)) { ?>
                    <div class="alert alert-info" role="alert">
                        Showing results for: <strong><?= htmlspecialchars($searchTerm) ?></strong>
                    </div>
                <?php } ?>

                <!-- Display category filter if set -->
                <?php if (!empty($categoryFilter)) { ?>
                    <div class="alert alert-info" role="alert">
                        Showing results for category: <strong><?= htmlspecialchars($categoryName) ?></strong>
                    </div>
                <?php } ?>

                <div class="row">
                    <?php if (empty($books)) { ?>
                        <div class="alert alert-danger w-100" role="alert">
                            No results found.
                        </div>
                    <?php } else { ?>
                        <?php foreach ($books as $book) : ?>
                            <div class="col-md-4 mb-4">
                                <div class="card w-100 h-100">
                                    <div id="ima">
                                        <img src="<?php echo htmlspecialchars($book['photo']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($book['titre']); ?>">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($book['titre']); ?></h5>
                                        <p class="card-text"><strong>Auteur:</strong> <?php echo htmlspecialchars($book['auteur']); ?></p>
                                        <p class="card-text"><strong>Prix:</strong> <?php echo number_format($book['prix'], 2); ?> DH</p>
                                        <form action="details.php" method="get">
                                            <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
                                            <button type="submit" class="btn btn-brown btn-block">Voir</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php } ?>
                </div>
            </div>
            <br><br><br><br><br>
        </div>
        <?php include "headers/footer.php"; ?>
    </div>
</body>

</html>