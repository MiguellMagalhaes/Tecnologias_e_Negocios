<?php

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    require "settings.php";
    include "db.php";
    db_connect();

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "SELECT * FROM user WHERE email = '".$email."'";
    $Verif = db_query($query);

    if(empty($Verif)){

        $query = "INSERT INTO user (name, email, password, isadmin, status) VALUES ('".$name."','".$email."','".$password."',0,1)";
        $ID = db_query($query);

        $_SESSION["logged"] = true;
        $_SESSION["id"] = $ID;
        $_SESSION["name"] = $name;
        $_SESSION["email"] = $email;
        $_SESSION["password"] = $password;
        
        echo json_encode(['result' => true]);

    }else{

        echo json_encode(['result' => false]);

    }

?>