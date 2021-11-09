<?php
    include('connect_db.php');
    if (!empty($_POST)) {
        $trainerId = $_POST['id'];
        $queryDeleteTrainer = "DELETE FROM trainers WHERE id = :id";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        $pdo = new PDO($dsn, $user, $pass, $options);
        $stmt = $pdo->prepare($queryDeleteTrainer);
        $stmt->execute(['id' => $trainerId]);
        header('Location: ../get_trainers.php');
    }