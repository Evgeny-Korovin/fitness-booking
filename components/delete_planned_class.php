<?php
    require 'connect_db.php';
    if (!empty($_POST)) {
        $classId = $_POST['id'];
        $queryDeletePlannedClass = "DELETE FROM planned WHERE id = :id";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        $pdo = new PDO($dsn, $user, $pass, $options);
        $stmt = $pdo->prepare($queryDeletePlannedClass);
        $stmt->execute(['id' => $classId]);
        header('Location: ../get_planned_classes.php');
    }