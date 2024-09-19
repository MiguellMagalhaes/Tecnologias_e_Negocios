<?php

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    require "settings.php";
    include "db.php";
    db_connect();

    unset($_SESSION["logged"]);
    unset($_SESSION["id"]);
    unset($_SESSION["name"]);
    unset($_SESSION["email"]);
    unset($_SESSION["password"]);

    echo json_encode(['result' => true]);

?>