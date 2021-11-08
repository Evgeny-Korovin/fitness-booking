<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Список клиентов</title>
</head>
<body>
<?php
    include('connect_db.php');
    function printResult($result) {
        $i = 1;
        while ($row = $result->fetch()) {
            echo "<tr>
                    <th scope=\"row\">$i</th>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['surname'] . "</td>
                    <td>" . $row['phone'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>
                        <button type='button' class=\"btn btn-info btn-sm\" id="  . $row['id'] .  ">Редактировать</button>
                        <form action='delete_user.php' method='POST'>
                            <input type='hidden' name='id' value="  . $row['id'] .  ">
                            <button type='submit' class=\"btn btn-danger btn-sm\">Удалить</button>
                        </form>
                    </td>
                  </tr>";
            $i++;
        }
    }
    $querySelectAllUsers = "SELECT * FROM users WHERE is_admin = 0";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

        $pdo = new PDO($dsn, $user,$pass,$options);
        $stmt = $pdo->query($querySelectAllUsers);
?>
<div class="container">
    <h2 class="mt-3">Добавить клиента в клуб</h2>
            <form action="post_user.php" method="POST" class="needs-validation mt-3" novalidate>
                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Введите имя" required>
                        <div class="invalid-feedback">
                            Введите имя.
                        </div>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <input type="text" name="surname" class="form-control" placeholder="Введите фамилию" required>
                        <div class="invalid-feedback">
                            Введите фамилию.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input type="tel" name="phone" class="form-control" placeholder="Введите телефон" required>
                        <div class="invalid-feedback">
                            Введите номер телефона.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Введите email" required>
                        <div class="invalid-feedback">
                            Введите email.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input type="password" name="pass" class="form-control" placeholder="Создайте пароль" required>
                        <div class="invalid-feedback">
                            Введите пароль.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <button type="submit" class="btn btn-success">Добавить клиента</button>
                    </div>
                </div>
            </form>

    <h2 class="mt-3">Список клиентов в клуба</h2>
        <div class="row mt-3">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Фамилия</th>
                    <th scope="col">Телефон</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>
                <?php
                printResult($stmt);
                ?>
                </tbody>
            </table>
        </div>

    </div>
<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {

            var forms = document.getElementsByClassName('needs-validation');

            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
</body>
</html>


