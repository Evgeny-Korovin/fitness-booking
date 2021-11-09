<?php
    include('connect_db.php');

    if (!empty($_POST)) {
        $userName = $_POST['name'];
        $userSurname = $_POST['surname'];
        $userPhone = $_POST['phone'];
        $userEmail = $_POST['email'];
        $userPass = $_POST['pass'];
        $queryInsertUser = "INSERT INTO users (name, surname, phone, email, pass) VALUES (:name,:surname, :phone, :email, :pass)";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        $pdo = new PDO($dsn, $user, $pass, $options);
        $stmt = $pdo->prepare($queryInsertUser);
        $stmt->execute(['name' => $userName,
                        'surname' => $userSurname,
                        'phone' => $userPhone,
                        'email' => $userEmail,
                        'pass' => md5($userPass)]);
        header('Location: ../get_users.php');
    }