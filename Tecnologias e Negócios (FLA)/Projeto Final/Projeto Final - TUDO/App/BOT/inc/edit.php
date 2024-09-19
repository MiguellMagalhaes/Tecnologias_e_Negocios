<?php

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    require "settings.php";
    include "db.php";
    db_connect();

    $name = $_POST["name"];
    $email = $_POST["email"];
    $newpassword = $_POST['newpassword'];
    if(trim($newpassword) !== ''){
        $newpasswordhash = password_hash($newpassword, PASSWORD_DEFAULT);
    }
    $password = $_POST['password'];

    // Confirm current password
    if(password_verify($password, $_SESSION["password"])){

        // Verif new email exists
        $Verif = true;
        if($_SESSION["email"] !== $email){
            $query = "SELECT * FROM user WHERE email = '".$email."'";
            $Verif = db_query($query);
            $Verif = empty($Verif);
        }

        if($Verif){

            // New password
            if(isset($newpasswordhash)){

                $query = "UPDATE user SET name = '".$name."', email = '".$email."', password = '".$newpasswordhash."' WHERE id = ".$_SESSION['id']."";
                $_SESSION["password"] = $newpasswordhash;

            }else{

                $query = "UPDATE user SET name = '".$name."', email = '".$email."' WHERE id = ".$_SESSION['id']."";

            }

            db_query($query);

            $_SESSION["name"] = $name;
            $_SESSION["email"] = $email;
            
            echo json_encode(['result' => true, 'name' => $_SESSION["name"], 'email' => $_SESSION["email"]]);

        }else{

            echo json_encode(['result' => false, 'name' => $_SESSION["name"], 'email' => $_SESSION["email"]]);

        }

    }else{
        echo json_encode(['result' => false, 'name' => $_SESSION["name"], 'email' => $_SESSION["email"]]);
    }

?>