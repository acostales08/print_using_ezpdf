
<?php

require("../controller/controller.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET["isFetch"]) == true) {
    $fectCallback = new projectController();
    $fectCallback->fetchController();
}

if (isset($_POST['isTrue']) && $_POST['isTrue'] == true) {
    $data = [
        "fetcherCode" => $_POST['fetcherCode'],
        "fetcherName" => $_POST['fetcherName'],
        "contactNum" => $_POST['contactNum'],
        "regDate" => $_POST['regDate'],
        "isActive" => $_POST['isActive'],
    ];

    $students = $_POST['students'];
    $insertCallback = new projectController();
    $insertCallback->insertData($data, $students);
}

if (isset($_GET['isFetchData']) === true) {
    $callBack = new projectController();
    $callBack->fetchTwoTable();
}
