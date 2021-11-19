<?php
    if ($_COOKIE['id'] == '') {
        header('Location: login.php');
    } else if ($_COOKIE['admin'] == '1') {
        header('Location: get_planned_classes.php');
    } else {
        header('Location: planned_classes.php');
    }