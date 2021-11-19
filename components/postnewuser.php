<?php
    include "connect_db.php";
    if (!empty($_POST)) {
        $userName = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
        $userSurname = filter_var(trim($_POST['surname']), FILTER_SANITIZE_STRING);
        $userEmail = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
        $userPhone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_STRING);
        $userPassword = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

        $queryInsertUser = "INSERT INTO users (name, surname, phone, email, pass) VALUES (:name,:surname, :phone, :email, :pass)";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        $pdo = new PDO($dsn, $user, $pass, $options);
        $stmt = $pdo->prepare($queryInsertUser);
        $stmt->execute(['name' => $userName,
                        'surname' => $userSurname,
                        'email' => $userEmail,
                        'phone' => $userPhone,
                        'pass' => md5($userPassword)]);
        header('Location: ../login.php');
    }