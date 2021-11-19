<?php
    setcookie('id', $result['id'], time() - 3600, "/");
    setcookie('name', $result['name'], time() - 3600, "/");
    setcookie('surname', $result['surname'], time() - 3600, "/");
    setcookie('admin', $result['is_admin'], time() - 3600, "/");

    header('Location: ../index.php');