<?php

    require "../../inc/settings.php";
    include "../../inc/db.php";
    db_connect();

    $query = "SELECT * FROM news WHERE id = ".$_GET['id']."";
    $News = db_query($query);
?>

<div class="top rounded-bottom p-5 shadow mb-2">

    <div style="display:flex">

        <button class="btn act-btn" id="news" onclick="Back();"><i class="fa-solid fa-angle-left fs-4 icon-color"></i></button> 

    </div>
    
    <hr class="rounded">

</div>

<div class="content p-5 mb-5 text-center">

    <?php

        foreach($News as $v){
            echo '

                <h1 class="fw-bold text-start mb-4">'.$v["title"].'</h1>
                <p class="fw-light text-start mb-4">'.$v["overview"].'</p>
                <img src="./img/news/'.$v["img"].'" class="img-fluid mb-4 rounded-2" style="width:100%" alt="">
                <p class="text-start mb-4">'.$v["report"].'</p>
                <p class="text-secondary text-start mb-4"><i class="fa-solid fa-calendar-days"></i>&nbsp '.date("d-m-Y H:i:s",strtotime($v["date"])).'</p>
            
                ';
        }

    ?>
    
</div>

<script>
    function Back(){
        $.ajax({
            url: "./ajax/news/news.php",
            cache: false,
            success: function(data){
                $("#main").html(data);
            }
        });
    }
</script>