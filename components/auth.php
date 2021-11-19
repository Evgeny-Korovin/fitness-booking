<?php
    require 'connect_db.php';
    if (!empty($_POST)) {
        $userLogin = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
        $userPass = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
        $hashPass = md5($userPass);
        $query = "SELECT * FROM users WHERE email = '$userLogin' and pass = '$hashPass'";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        $pdo = new PDO($dsn, $user, $pass, $options);
        $stmt = $pdo->query($query);
        $result = $stmt->fetch();
        if (count($result) == 0) {
            echo "Такой пользователь не найден";

        }
        setcookie('id', $result['id'], time() + 3600, "/");
        setcookie('name', $result['name'], time() + 3600, "/");
        setcookie('surname', $result['surname'], time() + 3600, "/");
        setcookie('admin', $result['is_admin'], time() + 3600, "/");

        header('Location: ../index.php');
    }