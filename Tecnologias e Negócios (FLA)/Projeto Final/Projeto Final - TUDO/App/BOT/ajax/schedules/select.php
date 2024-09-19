<?php

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    require "../../inc/settings.php";
    include "../../inc/db.php";
    db_connect();

    $area = $_GET["area"];
    $transp = $_GET["transportation"];

?>

<div class="top rounded-bottom p-5 shadow mb-2">

    <div style="display:flex">
        <h1 style="font-weight: 900;color:#1F7A8C">HORÁRIOS</h1>

        <div class="container-fluid" style="max-width:400px; margin-left: auto;margin-right: 0;">
            <form class="d-flex" role="search" action="javascript:SearchAjax();">
                <input class="form-control me-2" type="search" id="search" placeholder="Pesquisar..." <?php echo isset($_GET["search"]) ? 'value="'.$_GET["search"].'"' : ''; ?> aria-label="Pesquisar">
                <button class="btn btn-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>

    </div>
    
    <hr class="rounded"> 

</div>

<div class="content p-5 mb-5 text-center">

    <div class="row">
    
        <div class="mb-4 p-0" style="display:flex">

            <?php

                $query = "SELECT * FROM areas WHERE status = 1";
                $Areas = db_query($query);

                if(empty($Areas)){

                }else{

                    echo '<select class="form-select" id="areas" onChange="areasAjax(this.value,'.$transp.')">';

                    foreach($Areas as $v){
                        if($area == $v["id"]){
                            echo '<option value="'.$v["id"].'" selected>'.$v["name"].'</option>';
                        }else{
                            echo '<option value="'.$v["id"].'">'.$v["name"].'</option>';
                        }

                    }

                    echo '</select>';

                }

            ?>

            <?php

                $query = "SELECT * FROM companies WHERE status = 1";
                $Companies = db_query($query);

                if(!empty($Companies)){
                    echo '<div class="ms-2">
                    <button type="button" class="btn shadow btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-filter"></i></button>
                    <ul class="dropdown-menu">
                        <div class="p-2">';

                        foreach($Companies as $c){
                            echo '
                                <div class="form-check">
                                    <input class="form-check-input checkbox" type="checkbox" value="'.$c["id"].'" id="company'.$c["id"].'">
                                    <label class="form-check-label" for="company'.$c["id"].'">
                                    '.$c["name"].'
                                    </label>
                                </div>
                            ';
                        }

                    echo '</div>
                        </ul>
                    </div>';
                }
                
            ?>

        </div>

        <?php

            $query = "SELECT * FROM transportation WHERE id = ".$transp." AND status = 1";
            $Transp = db_query($query);

            if(empty($Transp)){

            }else{

                echo '<div class="list-group text-start fs-5 list-group-flush p-0">';

                foreach($Transp as $v){

                    echo '
                    
                        <a href="javascript:backSched();" class="list-group-item rounded list-group-item-action mb-2 list-active">
                            <span class="badge badge-reversed bg-primary rounded-pill"><i class="fa-solid fa-angle-left"></i></span>
                            <i class="fa-solid '.$v["icon"].'" ></i> &nbsp '.$v["name"].'
                            
                        </a>
                    ';

                    $query = "SELECT * FROM schedules WHERE id_area = ".$area." AND id_transportation = ".$transp." AND status = 1 ORDER BY RAND() LIMIT 10";
                    $Schedules = db_query($query);

                    if(!empty($Schedules)){
                        foreach($Schedules as $s){

                            $isFav = 0;
                            if(isset($_SESSION["logged"])){
                                $queryF = "SELECT * FROM favorites WHERE id_schedule = ".$s['id']." AND id_user = ".$_SESSION['id']."";
                                $verifF = db_query($queryF);

                                if(!empty($verifF)){
                                    $isFav = 1;
                                }

                            }

                            $id = "'".$s["id"]."'";
                            $name = "'".$s["name"]."'";
                            $file = "'".$s["file"]."'";
                            echo '<a href="javascript:openModal('.$id.','.$name.','.$file.','.$isFav.');" class="list-group-item rounded list-group-item-action">
                                '.$s["name"].'
                                <span class="badge bg-primary rounded-pill" style="float:right"><i class="fa-solid fa-angle-right"></i></span>
                            </a>';
                        }
                    }else{
                        echo '<p class="text-center fs-6 mt-2">Não existem horários disponíveis de momento.<br>Por favor, tente mais tarde...</p>';
                    }
                        
                }

                echo '</div>';

            }

        ?>

        <style>

            .list-group-item{
                color:#1F7A8C;
                border-bottom: 2px solid #1F7A8C;
                transition: 0.3s;
            }
            .list-group-item:hover{
                background-color:#1F7A8C;
                color:white;
            }
            .list-group-item:hover > .badge{
                color:white;
            }
            .badge{
                background-color:transparent!important;
                color:#1F7A8C;
            }
            .list-active{
                background-color:#1F7A8C;
                color:white;
                border: 2px solid #1F7A8C!important;
            }
            .badge-reversed{
                color:white;
            }

            .list-active:hover{
                background-color:white;
                color:#1F7A8C;
            }
            .list-active:hover > .badge-reversed{
                color:#1F7A8C;
            }

        </style>

    </div>

</div>

<!-- Modal Schedule -->

<div class="modal fade" id="scheduleModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="nameSchedule"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <div id="scheduleViewer"></div>
            </div>
            <div class="modal-footer">
                <?php
                    if(isset($_SESSION['logged'])){
                        echo '<button type="button" id="addFav" onclick="funcFav();" class="btn shadow btn-primary"><i class="fa-solid fa-heart"></i></button>';
                    }
                ?>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
            </div>
        </div>

    </div>
</div>

<style>
    .btn-primary{
        background-color: #1F7A8C;
        color: white;
        border: 2px solid #1F7A8C!important;
        transition: 0.5s;
    }
    .btn-primary:hover{
        background-color: white;
        color: #1F7A8C;
    }
</style>

<script>

    var optionsPDF = {
        fallbackLink: "<p>Este browser não suporta a visualização de horários. Por favor, descarregue o horário para o ver: <br> <a target=”_blank” href='[url]'>Descarregar horário</a></p>",
        height: "500px"
    };

    function openModal(id, name, file, isFav){
        PDFObject.embed("files/"+file+"#zoom=auto", "#scheduleViewer", optionsPDF);
        $('#nameSchedule').text(name);
        if(isFav == 1){
            $('#addFav').addClass('active');
        }
        $("#addFav").attr("onclick","funcFav("+id+");");
        $('#scheduleModal').modal('show');
    }

    function backSched(){
        $.ajax({
        url: "./ajax/schedules/schedules.php",
        cache: false,
        success: function(data){
            $("#main").html(data);
        }
        });
    }

    function areasAjax(area, id){
        $.ajax({
        url: "ajax/schedules/select.php",
        type: "get",
        data: { 
            area: area,
            transportation: id
        },
        success: function(data) {
            $("#main").html(data);
        }
        });
    }

    function funcFav(id){

        $.ajax({
        url: "./inc/favorites.php",
        type: "get",
        dataType: "json",
        data: { 
            id: id
        },
        success: function(data) {
            if(data.result){
                $('#addFav').addClass('active');
            }else{
                $('#addFav').removeClass('active');
            }
        }
        });

    }
    
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.12/pdfobject.min.js"></script>