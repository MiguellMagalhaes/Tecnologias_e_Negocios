<?php

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    require "inc/settings.php";
    include "inc/db.php";
    db_connect();

    if(!isset($_SESSION["logged_admin"])){
        header('Location: login.php');
        die();
    }

    if(isset($_GET["table"])){

        $table = $_GET["table"];
        $query = "SHOW TABLES";
        $tables = db_query($query);
        $flag = false;
        
        foreach($tables as $t){
            if($t['Tables_in_BOT'] == $table){
                $flag = true;
            }
        }

        if(!$flag){
            $table = 1;
        }

    }else{
        $table = 1;
    }

?>

<!DOCTYPE html>
<html lang="en">

    <?php

        include "inc/head.php";

    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs5/1.13.8/dataTables.bootstrap5.min.css" integrity="sha512-TYucTg2DTKx05NRJKSS3IoVrDPfhuNYCw30zPRFOYgE1OD1j2VQQ+iCZj2mG8vNcXStFGdV+1XBLOWSij+P/0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <body>

    <div style="display:flex; margin-left:240px">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark sidebar" style="width: 250px;height:100%">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <span class="fs-4">BOT - Admin</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="#" class="nav-link active" aria-current="page">
        <i class="fa-solid fa-table"></i>
          CRUD
        </a>
      </li>
    </ul>
    <hr>
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-solid fa-user ms-2 me-3" style="font-size:25px"></i>  
        <strong><?php echo $_SESSION['name_admin']; ?></strong>
      </a>
      <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
        <li><a class="dropdown-item" href="inc/logout.php">Logout</a></li>
      </ul>
    </div>
  </div>

    <section class="main p-5 w-100">
        <ul class="nav nav-pills nav-fill p-3 border-bottom border-2 border-primary mb-4">

            <?php
                $query = "SHOW TABLES";
                $tables = db_query($query);

                foreach($tables as $t){

                    if($table == 1){
                        $table = $t["Tables_in_BOT"];
                        echo '<li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="?table='.$t["Tables_in_BOT"].'">'.$t["Tables_in_BOT"].'</a>
                        </li>';
                    }elseif($table == $t["Tables_in_BOT"]){
                        echo '<li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="?table='.$t["Tables_in_BOT"].'">'.$t["Tables_in_BOT"].'</a>
                        </li>';
                    }else{
                        echo '<li class="nav-item">
                            <a class="nav-link" aria-current="page" href="?table='.$t["Tables_in_BOT"].'">'.$t["Tables_in_BOT"].'</a>
                        </li>';
                    }
                    
                }
            ?>
        </ul>

        <div class="mb-4" style="display:flex;justify-content:end">
            <button class="btn btn-primary"><i class="fa-solid fa-plus"></i></button>
        </div>

        <table id="example" class="table table-striped" style="width:100%;table-layout: fixed;">

            <thead>
                <tr>
                    <?php

                        $query = "SHOW COLUMNS FROM ".$table;
                        $Columns = db_query($query);

                        foreach($Columns as $c){
                            echo '<th>'.ucfirst($c['Field']).'</th>';
                        }
                        echo '<th>Actions</th>';

                    ?>
                </tr>
            </thead>
            <tbody>

                <?php

                    $query = "SELECT * FROM ".$table;
                    $Data = db_query($query);

                    foreach($Data as $key => $d){
                        echo "<tr>";
                        foreach($Columns as $c){
                            echo "<td>".$d[$c['Field']].'</td>';
                        }
                        echo '<td>
                                <button class="btn btn-warning"><i class="fa-solid fa-edit"></i></button>
                                <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                            </td>';
                        echo "</tr>";
                    }

                ?>

            </tbody>
        </table>

    </section>

    </div>

    <style>
        .sidebar {
  position:fixed;
  width: 200px;
  z-index: 1000;
  left: 0;
  top: 0;
  border-right: 1px solid #162636;
  height: 100%;
}

td{
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}
    </style>

        

    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs5/1.13.8/dataTables.bootstrap5.min.js" integrity="sha512-zw34c1fnMeY29qzodeC+GGKfyQQ7hN+a9yjGnIAZbkPPn/Xeh8Z46uea/fjq5Mwsp4bxvGKfJrTNnh/GdIZJ1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>new DataTable('#example');</script>

</html>