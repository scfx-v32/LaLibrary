<?php
include "config.php";
session_start();
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaLibrary</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            /* Ensure body takes up at least full viewport height */
        }

        footer {
            margin-top: auto;
            /* Push the footer to the bottom */
        }

        .bg-brown {
            background-color: #8d6e63;
            /* Darker brown */
        }

        .btn-brown {
            background-color: #5a3e36;
            /* Dark brown button color */
            color: #ffffff;
            /* White text color */
        }

        .btn-beige {
            background-color: #f5deb3;
            /* Beige button color */
            color: #000000;
            /* Black text color */
        }

        .product-list {
            height: calc(100vh - 136px);
            /* Adjusted height calculation to include header and footer */
            overflow-y: auto;
        }

        .card {
            height: 400px;
            width: 300px;
            /* Corrected syntax: added semicolon */
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .search-bar {
            flex-grow: 1;
            display: flex;
            justify-content: center;
        }

        .search-form {
            display: flex;
            align-items: center;
        }
    </style>
</head>

<body class="bg-light text-dark">
    <!-- Header Section -->
    <header class="bg-brown text-white d-flex justify-content-between align-items-center px-4 py-2">
        <h1><a href="main.php" class="text-white text-decoration-none">LaLibrary</a></h1>
        <div class="search-bar">
            <!-- Search Form -->
            <form action="main.php" method="GET" class="form-inline my-2 my-lg-0 search-form">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-brown my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
        <div>
            <?php
            if (isset($_SESSION['user'])) {
                if ($_SESSION['user']['role_'] === "admin") {
            ?>
                    <a href="../listecommande.php" class='text-white text-decoration-none'>Afficher les commandes</a>
                    &nbsp;
                    <a href="../ajoutlivre.php" class='text-white text-decoration-none'>Ajouter un livre</a>
                <?php
                } else {
                ?>
                    <a href='../panier.php' class='text-white text-decoration-none'>Panier</a>
            <?php
                }
            }
            ?>
            <?php
            if (isset($_SESSION['user'])) {
            ?>
                &nbsp;
                <a href="../logout.php" class="btn btn-secondary text-white text-decoration-none">Déconnexion</a>
            <?php
            } else {
            ?>
                <a href="../login.php" class="btn btn-primary text-white text-decoration-none">Se connecter</a>
            <?php
            }
            ?>
        </div>
    </header>
</body>

</html>