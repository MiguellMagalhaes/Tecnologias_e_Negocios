<?php

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    require "settings.php";
    include "db.php";
    db_connect();

    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "SELECT * FROM user WHERE email = '".$email."' AND isadmin = 1";
    $User = db_query($query);

    if(!empty($User)){

        if(password_verify($password, $User[0]["password"])){

            $_SESSION["logged_admin"] = true;
            $_SESSION["id_admin"] = $User[0]["id"];
            $_SESSION["name_admin"] = $User[0]["name"];
            $_SESSION["email_admin"] = $User[0]["email"];
            $_SESSION["password_admin"] = $User[0]["password"];

            header('Location: ../index.php');

        }else{

            header('Location: ../login.php?error');

        }

    }else{

        header('Location: ../login.php?error');

    }

?>