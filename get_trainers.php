<?php
    require 'patterns/header.php';
    require 'components/connect_db.php';
function printResult($result) {
    $i = 1;
    while ($row = $result->fetch()) {
        echo "<tr>
                    <th scope=\"row\">$i</th>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['surname'] . "</td>
                    <td>" . $row['phone'] . "</td>
                    <td>" . $row['special'] . "</td>
                    <td>
                        <button type='button' class=\"btn btn-info btn-sm userUpdateBtn\" id="  . $row['id'] .  ">Редактировать</button>
                        <form action='components/delete_trainer.php' method='POST'>
                            <input type='hidden' name='id' value="  . $row['id'] .  ">
                            <button type='submit' class=\"btn btn-danger btn-sm\">Удалить</button>
                        </form>
                    </td>
                  </tr>";
        $i++;
    }
}
$querySelectAllTrainers = "SELECT * FROM trainers";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

$pdo = new PDO($dsn, $user,$pass,$options);
$stmt = $pdo->query($querySelectAllTrainers);
?>
<div class="container">
    <h2 class="mt-4">Добавить тренера в клуб</h2>
    <form action="components/post_trainer.php" method="POST" class="needs-validation mt-3" novalidate>
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
                <input type="text" name="special" class="form-control" placeholder="Введите специализацию" required>
                <div class="invalid-feedback">
                    Введите специализацию.
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <button type="submit" class="btn btn-success">Добавить тренера</button>
            </div>
        </div>
    </form>

    <h2 class="mt-5">Список тренеров в клуба</h2>
    <div class="row mt-3">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">№</th>
                <th scope="col">Имя</th>
                <th scope="col">Фамилия</th>
                <th scope="col">Телефон</th>
                <th scope="col">Специализация</th>
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

<?php
    require 'patterns/footer.php';
    ?>