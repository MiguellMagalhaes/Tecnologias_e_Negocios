<?php

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    require "../../inc/settings.php";
    include "../../inc/db.php";
    db_connect();

?>

<div class="top rounded-bottom p-5 shadow mb-2">

    <div style="display:flex">
        <h1 style="font-weight: 900;color:#1F7A8C">HORÁRIOS</h1>

        <div class="container-fluid" style="max-width:400px; margin-left: auto;margin-right: 0;">
            <form class="d-flex" role="search" action="javascript:searchOne();">
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

                    echo '<select class="form-select" id="areas" disabled>

                        <option value="0">Áreas não disponíveis</option>

                    </select>';

                }else{

                    echo '<select class="form-select" id="areas">';

                    foreach($Areas as $v){

                        echo '<option value="'.$v["id"].'">'.$v["name"].'</option>';

                    }

                    echo '</select>';

                }

                if(isset($_SESSION["logged"])){
                    echo '<div class="ms-2">
                        <button type="button" class="btn shadow btn-primary" data-bs-toggle="button" onclick="Favorites(this);"><i class="fa-solid fa-heart"></i></button>
                    </div>';
                }

            ?>

        </div>

        <style>
            .btn-primary:active{
                background-color: #1F7A8C!important;
                color: white!important;
            }

            .btn.active{
                background-color: white;
                color: #1F7A8C;
            }
        </style>

        <?php

            if(empty($Areas)){

                echo '<p class="text-center">Horários não disponíveis no momento. <br> Por favor, tente mais tarde...</p>';

            }else{

                $query = "SELECT * FROM transportation WHERE status = 1";
                $Transp = db_query($query);

                if(empty($Transp)){

                    echo '<p class="text-center">Horários não disponíveis no momento. <br> Por favor, tente mais tarde...</p>';

                }else{

                    echo '<div class="list-group text-start fs-5 list-group-flush p-0" id="transportations">';

                    foreach($Transp as $v){

                        echo '
                        
                            <a href="javascript:selectSched('.$v["id"].');" class="list-group-item rounded list-group-item-action mb-2">
                                <i class="fa-solid '.$v["icon"].'"></i> &nbsp '.$v["name"].'
                                <span class="badge bg-primary rounded-pill" style="float:right"><i class="fa-solid fa-angle-right"></i></span>
                            </a>
                    
                        ';

                    }

                    echo '</div>';

                }

            }

            if(isset($_SESSION["logged"])){

                $query = "SELECT schedules.* FROM favorites, schedules WHERE favorites.id_user = ".$_SESSION['id']." AND favorites.id_schedule = schedules.id";
                $Favs = db_query($query);

                echo '<div class="list-group text-start fs-5 list-group-flush p-0" id="favorites">';

                    if(!empty($Favs)){


                        foreach($Favs as $f){

                            $id = "'".$f["id"]."'";
                            $name = "'".$f["name"]."'";
                            $file = "'".$f["file"]."'";
                            echo '<a href="javascript:openModal('.$id.','.$name.','.$file.',1);" class="list-group-item rounded list-group-item-action">
                                '.$f["name"].'
                                <span class="badge bg-primary rounded-pill" style="float:right"><i class="fa-solid fa-angle-right"></i></span>
                            </a>';

                        }


                    }else{
                        echo '<p class="text-center">Não existem favoritos...</p>';
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
                <button type="button" id="addFav" onclick="funcFav();" class="btn shadow btn-primary"><i class="fa-solid fa-heart"></i></button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
            </div>
        </div>

    </div>
</div>

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

    function selectSched(id){
        var area = $( "#areas option:selected" ).val();
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

</script>

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

    $("#favorites").hide();
    function Favorites(btn){
        if(($(btn)).attr('aria-pressed') == 'true'){
            $("#areas").hide();
            $("#transportations").hide();
            $("#favorites").show();
        }else{
            $("#favorites").hide();
            $("#areas").show();
            $("#transportations").show();
        }
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

    function searchOne(){

        var search = $("#search").val();
        var area = $("#areas option:selected").val();

        if(search.trim()){
            $.ajax({
            url: "ajax/schedules/search.php",
            type: "get",
            data: { 
                search: search,
                area: area
            },
            success: function(data) {
                $("#main").html(data);
            }
            });
        }

    }

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.12/pdfobject.min.js"></script>