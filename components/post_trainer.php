<?php
    include "connect_db.php";
    if (!empty($_POST)) {
        $trainerName = $_POST['name'];
        $trainerSurname = $_POST['surname'];
        $trainerPhone = $_POST['phone'];
        $trainerSpecial = $_POST['special'];

        $queryInsertTrainer = "INSERT INTO trainers (name, surname, phone, special) VALUES (:name,:surname, :phone, :special)";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        $pdo = new PDO($dsn, $user, $pass, $options);
        $stmt = $pdo->prepare($queryInsertTrainer);
        $stmt->execute(['name' => $trainerName,
                        'surname' => $trainerSurname,
                        'phone' => $trainerPhone,
                        'special' => $trainerSpecial]);
        header('Location: ../get_trainers.php');
    }