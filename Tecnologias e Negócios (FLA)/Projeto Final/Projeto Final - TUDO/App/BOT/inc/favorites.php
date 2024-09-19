<?php

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    require "settings.php";
    include "db.php";
    db_connect();

    $id = $_GET["id"];

    $query = "SELECT * FROM favorites WHERE id_schedule = ".$id." AND id_user = ".$_SESSION['id']."";
    $Fav = db_query($query);

    if(!empty($Fav)){

        $query = "DELETE FROM favorites WHERE id_schedule = ".$id." AND id_user = ".$_SESSION['id']."";

        $flag = false;

    }else{

        $query = "INSERT INTO favorites (id_schedule, id_user) VALUES (".$id.",".$_SESSION['id'].")";

        $flag = true;

    }

    db_query($query);
    echo json_encode(['result' => $flag]);

?>