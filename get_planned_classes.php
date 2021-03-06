<?php
    require 'patterns/header.php';
    require 'components/connect_db.php';

function get_trainers($result, $selectId) {
    $selectControl = "<select name=\"selecttrainer\" class=\"form-select\" id=\"$selectId\">";
    while ($row = $result->fetch()) {
        $selectControl .= "<option value=" . $row['id'] . ">" . $row['name'] . " " . $row['surname'] . "</option>";
    }
    $selectControl .= "</select>";
    return $selectControl;
}

function get_classes($result, $selectId) {
    $selectControl = "<select name=\"selectclasses\" class=\"form-select\" id=\"$selectId\">";
    while ($row = $result->fetch()) {
        $selectControl .= "<option value=" . $row['id'] . ">" . $row['title'] . "</option>";
    }
    $selectControl .= "</select>";
    return $selectControl;
}

function printResult($result) {

    function get_ordered_users($row) {
        require 'components/connect_db.php';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        $queryOrderedUsers = "SELECT users.id, users.name, users.surname FROM users, classes_users WHERE users.id = classes_users.user_id AND classes_users.class_id = $row";
        $pdo = new PDO($dsn, $user,$pass,$options);
        $stmtOrderedUsers = $pdo->query($queryOrderedUsers);
        $result = "";
        while ($user = $stmtOrderedUsers->fetch()) {
            $result .= $user['name'] . " " . $user['surname'] . "<br>";
        }
        return $result;
    }

    $i = 1;
    while ($row = $result->fetch()) {
        echo "<tr>
                    <th scope=\"row\">$i</th>
                    <td>" . $row['title'] . "</td>
                    <td>" . $row['name'] . " " . $row['surname'] . "</td>
                    <td>" . $row['datetime'] . "</td>
                    <td>" . get_ordered_users($row['id']) . "</td>
                    <td>
                        <form action='components/delete_planned_class.php' method='POST'>
                            <button type='button' class=\"btn btn-info btn-sm userUpdateBtn\" id="  . $row['id'] .  ">??????????????????????????</button>
                            <input type='hidden' name='id' value="  . $row['id'] .  ">
                            <button type='submit' class=\"btn btn-danger btn-sm\">??????????????</button>
                        </form>
                    </td>
                  </tr>";
        $i++;
    }
}

    $querySelectAllTrainers = "SELECT * FROM trainers";
    $querySelectAllClasses = "SELECT * FROM classes";
    $querySelectAllPlannedClasses = "SELECT planned.id, classes.title, trainers.name, trainers.surname, planned.datetime FROM classes, trainers, planned WHERE planned.trainer_id = trainers.id AND planned.classes_id = classes.id";

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    $pdo = new PDO($dsn, $user,$pass,$options);
    $stmtTrainers = $pdo->query($querySelectAllTrainers);
    $stmtClasses = $pdo->query($querySelectAllClasses);
    $stmtPlannedClasses = $pdo->query($querySelectAllPlannedClasses);
?>

<div class="container">
    <h2 class="mt-4 mb-4">?????????????????????????? ??????????????</h2>
            <form action="components/post_planned_class.php" method="POST">
                <div class="row form-group">
                <div class="col-md-3">
                    <label class="mb-2" for="trainersId">???????????????? ??????????????</label>
                    <?php echo get_trainers($stmtTrainers, 'trainersId'); ?>
                </div>
                <div class="col-md-5">
                    <label class="mb-2" for="classesId">???????????????? ?????? ??????????????</label>
                    <?php echo get_classes($stmtClasses, 'classesId'); ?>
                </div>
                <div class="col-md-2">
                    <label class="mb-2" for="datetimepicker">???????????????? ???????? ?? ??????????</label>
                    <input name="dtpicker" type="datetime-local" class="form-control" id="datetimepicker">
                </div>
                <div class="col-md-2">
                    <br>
                    <button type="submit" class="btn btn-success mt-2">??????????????????????????</button>
                </div>
            </div>
        </form>

    <h2 class="mt-5">???????????? ?????????????????????????????? ??????????????</h2>
    <div class="row mt-3">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">???</th>
                <th scope="col">????????????????</th>
                <th scope="col">????????????</th>
                <th scope="col">???????? ?? ??????????</th>
                <th scope="col">????????????????????</th>
                <th scope="col">????????????????</th>
            </tr>
            </thead>
            <tbody>
            <?php
                printResult($stmtPlannedClasses);
            ?>
            </tbody>
        </table>
    </div>


</div>
<?php
    require 'patterns/footer.php';
?>