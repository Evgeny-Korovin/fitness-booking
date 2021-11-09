<?php
    include('connect_db.php');

    if (!empty($_POST)) {
        $classTitle = $_POST['title'];
        $classDesc = $_POST['description'];
        $classMinUsers = $_POST['minusers'];
        $classMaxUsers = $_POST['maxusers'];
        $queryInsertUser = "INSERT INTO classes (title, description, minusers, maxusers) VALUES (:title, :description, :minusers, :maxusers)";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        $pdo = new PDO($dsn, $user, $pass, $options);
        $stmt = $pdo->prepare($queryInsertUser);
        $stmt->execute(['title' => $classTitle,
                        'description' => $classDesc,
                        'minusers' => $classMinUsers,
                        'maxusers' => $classMaxUsers]);
        header('Location: ../get_classes.php');
    }