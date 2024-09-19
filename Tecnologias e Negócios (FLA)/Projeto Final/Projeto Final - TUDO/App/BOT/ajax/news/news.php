<?php

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    require "../../inc/settings.php";
    include "../../inc/db.php";
    db_connect();

    $querySearch = "";
    if(isset($_GET["search"])){

        $arrSearch = explode(" ", $_GET["search"]);
        foreach($arrSearch as $s){
            $querySearch .= "(title LIKE '%".$s."%' OR overview LIKE '%".$s."%' OR report LIKE '%".$s."%') OR ";
        }
        $querySearch = substr($querySearch, 0, -3);
        $querySearch .= "AND ";

    }

    $query = "SELECT * FROM news WHERE ".$querySearch." status = 1 ORDER BY date DESC LIMIT 10";
    $arrNews = db_query($query);

?>

<div class="top rounded-bottom p-5 shadow mb-2">

    <div style="display:flex">

        <h1 style="font-weight: 900;color:#1F7A8C">NOTÍCIAS</h1>

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

        <?php
            
            if(empty($arrNews)){
                
                echo '
                
                <h4>Não existem notícias para mostrar...</h4>

                ';

            }else{

                foreach ($arrNews as $v){

                    echo '

                        <div class="col-sm-6 mb-3 mb-sm-0">

                            <div class="card mb-3 border-0 rounded-4 " style="max-width: 30rem; margin: 0 auto;">
                
                                <a href="javascript:readNews('.$v["id"].');" class="btn btn-hidden stretched-link text-start border-0">
                                    <img src="img/news/'.$v["img"].'" class="card-img-top rounded-2 mt-3" alt="'.$v["img"].'">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold">'.$v["title"].'</h5>
                                        <p class="card-text fw-light">'.$v["overview"].'</p>
                                        <p class="text-secondary"><i class="fa-solid fa-calendar-days"></i>&nbsp '.date("d-m-Y H:i:s",strtotime($v["date"])).'</p>
                                    </div>
                                    <hr class="rounded r-small"> 
                                </a>
                                
                            </div>
                        </div>
                    
                    ';

                }

            }

        ?>

    </div>

    <script>
        
        function readNews(id){

            $.ajax({
            url: "ajax/news/read.php",
            type: "get",
            data: { 
                id: id
            },
            success: function(data) {
                $("#main").html(data);
                $("html, body").animate({
                    scrollTop: 0
                }, 0); 
            }
            });

        }

        function SearchAjax(){

            var search = $("#search").val().replace(/[^a-zA-Z0-9 _]/g,'');

            if(search.trim()){

                $.ajax({
                    url: "./ajax/news/news.php",
                    type: "get",
                    data: { 
                        search: search
                    },
                    success: function(data){
                        $("#main").html(data);
                        $("html, body").animate({
                            scrollTop: 0
                        }, 0); 
                    }
                });

            }else{

                $.ajax({
                    url: "./ajax/news/news.php",
                    cache: false,
                    success: function(data){
                        $("#main").html(data);
                        $("html, body").animate({
                            scrollTop: 0
                        }, 0); 
                    }
                });

            }

        }
        
    </script>

    <!--
    <button class="btn btn-primary shadow mt-3 mb-5"><i class="fa-solid fa-angle-down"></i></button>
    -->

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

</div>