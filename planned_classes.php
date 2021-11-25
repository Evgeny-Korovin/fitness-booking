<?php
    require 'patterns/user_header.php';
    require 'components/connect_db.php';

    function printResult($result) {
        $currentUserId = $_COOKIE['id'];





        function get_ordered_class($classId, $currentUserId) {
            require 'components/connect_db.php';
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ];
            $pdoInner = new PDO($dsn, $user,$pass,$options);
            $resultClassesUser = $pdoInner->query("SELECT * FROM classes_users WHERE class_id = '$classId' AND user_id = '$currentUserId'");
            //$resultClassesUser = $pdoInner->execute(['classId' => $classId, 'userId' => $currentUserId]);
            if ($row = $resultClassesUser->fetchAll()) {
                return "<form action='components/unordertoclass.php' method='POST'>
                                <button type='submit' class=\"btn btn-warning btn-sm userUpdateBtn\" >Отписаться</button>
                                <input type='hidden' name='id' value="  . $classId .  ">
                            </form>";
            } else {
                return "<form action='components/ordertoclass.php' method='POST'>
                                <button type='submit' class=\"btn btn-info btn-sm userUpdateBtn\" >Записаться</button>
                                <input type='hidden' name='id' value="  . $classId .  ">
                            </form>";
            }
        }
        $i = 1;
        while ($row = $result->fetch()) {
            echo "<tr>
                        <th scope=\"row\">$i</th>
                        <td>" . $row['title'] . "</td>
                        <td>" . $row['name'] . " " . $row['surname'] . "</td>
                        <td>" . $row['datetime'] . "</td>
                        <td>" . get_ordered_class($row['id'], $currentUserId) .
                        "</td>
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
    <div class="row">
        <h2 class="mt-5">Список запланированных занятий</h2>
        <div class="row mt-3">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">Название</th>
                    <th scope="col">Тренер</th>
                    <th scope="col">Дата и время</th>
                    <th scope="col">Действия</th>
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
</div>
<?php
    require 'patterns/footer.php';
?>