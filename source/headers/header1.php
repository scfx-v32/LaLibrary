<?php
    session_start();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>

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
    </style>
</head>

<body class="bg-light text-dark">
    <!-- Header Section -->
    <header class="bg-brown text-white d-flex justify-content-between align-items-center px-4 py-2">
        <h1><a href="main.php" class="text-white text-decoration-none">LaLibrary</a></h1>
        <div>
            <a href="aide.php" class="text-white text-decoration-none ml-4">?</a>
        </div>
    </header>