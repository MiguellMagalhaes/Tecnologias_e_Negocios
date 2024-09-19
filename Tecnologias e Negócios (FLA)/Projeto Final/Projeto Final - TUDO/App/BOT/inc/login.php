<?php

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    require "settings.php";
    include "db.php";
    db_connect();

    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "SELECT * FROM user WHERE email = '".$email."'";
    $User = db_query($query);

    if(!empty($User)){

        if(password_verify($password, $User[0]["password"])){

            $_SESSION["logged"] = true;
            $_SESSION["id"] = $User[0]["id"];
            $_SESSION["name"] = $User[0]["name"];
            $_SESSION["email"] = $User[0]["email"];
            $_SESSION["password"] = $User[0]["password"];

            echo json_encode(['result' => true]);

        }else{

            echo json_encode(['result' => false]);

        }

    }else{

        echo json_encode(['result' => false]);

    }

?>