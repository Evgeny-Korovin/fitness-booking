<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Список типов занятий</title>
</head>
<body>
<?php
include('components/connect_db.php');
function printResult($result) {
    $i = 1;
    while ($row = $result->fetch()) {
        echo "<tr>
                    <th scope=\"row\">$i</th>
                    <td>" . $row['title'] . "</td>
                    <td>" . $row['description'] . "</td>
                    <td>" . $row['minusers'] . "</td>
                    <td>" . $row['maxusers'] . "</td>
                    <td>
                        <button type='button' class=\"btn btn-info btn-sm userUpdateBtn\" id="  . $row['id'] .  ">Редактировать</button>
                        <form action='components/delete_class.php' method='POST'>
                            <input type='hidden' name='id' value="  . $row['id'] .  ">
                            <button type='submit' class=\"btn btn-danger btn-sm\">Удалить</button>
                        </form>
                    </td>
                  </tr>";
        $i++;
    }
}
$querySelectAllTrainers = "SELECT * FROM classes";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

$pdo = new PDO($dsn, $user,$pass,$options);
$stmt = $pdo->query($querySelectAllTrainers);
?>
<div class="container">
    <h2 class="mt-3">Добавить тип занятия</h2>
    <form action="components/post_class.php" method="POST" class="needs-validation mt-3" novalidate>
        <div class="row">
            <div class="form-group col-md-6 mb-3">
                <input type="text" name="title" class="form-control" placeholder="Введите название занятия" required>
                <div class="invalid-feedback">
                    Введите название занятия.
                </div>
                <br>
                <input type="tel" name="minusers" class="form-control" placeholder="Введите минимальное количество человек" required>
                <div class="invalid-feedback">
                    Введите минимальное количество человек.
                </div>
                <br>
                <input type="text" name="maxusers" class="form-control" placeholder="Введите максимальное количество человек" required>
                <div class="invalid-feedback">
                    Введите максимальное количество человек.
                </div>
                <br>
                <div class="col-md-6 mb-3">
                    <button type="submit" class="btn btn-success">Добавить тип занятия</button>
                </div>
            </div>
            <div class="form-group col-md-6 mb-3">
                <textarea name="description" class="form-control" id="" cols="30" rows="10" placeholder="Введите описание занятия" required></textarea>
                <!-- <input type="text" name="description" class="form-control" placeholder="Введите фамилию" required> -->
                <div class="invalid-feedback">
                    Введите описание занятия.
                </div>
            </div>
        </div>
    </form>

    <h2 class="mt-3">Список типов занятий</h2>
    <div class="row mt-3">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">№</th>
                <th scope="col">Тип занятия</th>
                <th scope="col">Описание занятия</th>
                <th scope="col">Минимум</th>
                <th scope="col">Максимум</th>
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
<!-- Modal window for update user -->
<div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
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
</body>
</html>