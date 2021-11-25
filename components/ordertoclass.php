<?php
    include('connect_db.php');
    if (!empty($_POST)) {
        $plannedClassId = $_POST['id'];
        $userId = $_COOKIE['id'];
        $queryPostUserToClass = "INSERT INTO classes_users (class_id, user_id) VALUES (:classid, :userid)";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        $pdo = new PDO($dsn, $user, $pass, $options);
        $stmt = $pdo->prepare($queryPostUserToClass);
        $stmt->execute(['classid' => $plannedClassId,
                        'userid' => $userId]);
        header('Location: ../planned_classes.php');
    }