<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Регистрация в системе</title>
</head>
<body>
<div class="container">
    <?php
        if ($_COOKIE['id'] != '' && $_COOKIE['admin'] == '0') {
            header('Location: planned_classes.php');
        }
        if ($_COOKIE['admin'] == '1'){
            header('Location: get_planned_classes.php');
        }
    ?>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 mt-5">
            <div class="shadow p-3 mb-5 bg-white rounded">
                <h4>Зарегистрируйтесь в системе</h4>
                <form action="components/postnewuser.php" method="POST" class="needs-validation mt-4" novalidate>
                    <div class="form-group mt-2">
                        <label for="exampleInputEmail1">Введите имя</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                        <div class="invalid-feedback">
                            Введите имя.
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleInputEmail1">Введите фамилию</label>
                        <input type="text" name="surname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                        <div class="invalid-feedback">
                            Введите фамилию.
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleInputEmail1">Введите Email</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                        <div class="invalid-feedback">
                            Введите email.
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleInputEmail1">Введите номер телефона</label>
                        <input type="tel" name="phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                        <div class="invalid-feedback">
                            Введите номер телефона.
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleInputPassword1">Введите пароль</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
                        <div class="invalid-feedback">
                            Введите пароль.
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleInputPassword1">Повторите пароль</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" required>
                        <div class="invalid-feedback">
                            Повторите пароль.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Зарегистрироваться</button>
                    <a style="margin: 20px;" href="login.php">Войти</a>
                </form>
            </div>
        </div>
        <div class="col-md-4"></div>
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

    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })
    </script>

<?php
    require 'patterns/footer.php';
    ?>