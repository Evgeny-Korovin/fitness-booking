<?php
    require 'connect_db.php';
    if (!empty($_POST)) {
        $trainerId = $_POST['selecttrainer'];
        $classId = $_POST['selectclasses'];
        $classDateTime = $_POST['dtpicker'];

        $queryInsertPlannedClass = "INSERT INTO planned (trainer_id, classes_id, datetime) VALUES (:trainer_id, :classes_id, :dt)";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        //echo "Номер тренера: $trainerId | Номер занятия: $classId | Дата и время: $classDateTime";

        $pdo = new PDO($dsn, $user, $pass, $options);
        $stmt = $pdo->prepare($queryInsertPlannedClass);
        $stmt->execute(['trainer_id' => $trainerId,
                        'classes_id' => $classId,
                        'dt' => $classDateTime]);
        header('Location: ../get_planned_classes.php');
    }