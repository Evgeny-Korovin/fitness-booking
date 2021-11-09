<?php
    include('connect_db.php');
    if (!empty($_POST)) {
        $userId = $_POST['id'];
        $queryDeleteUser = "DELETE FROM users WHERE id = :id";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        $pdo = new PDO($dsn, $user, $pass, $options);
        $stmt = $pdo->prepare($queryDeleteUser);
        $stmt->execute(['id' => $userId]);
        header('Location: ../get_users.php');
    }