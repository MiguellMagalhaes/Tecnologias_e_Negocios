$(document).ready(function(){
    $('#loader').hide();

    //console.log($(location). attr('hash').substring(1));
    
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

});

$('.btn-nav').on('click', function(){
   
    //if(!$("#"+this.id).hasClass("btn-active")){
        $('.btn-active').removeClass('btn-active');
        $(this).addClass('btn-active');
        $.ajax({
            url: "./ajax/"+this.id+"/"+this.id+".php",
            cache: false,
            success: function(data){
                $("#main").html(data);
                $("html, body").animate({
                    scrollTop: 0
                }, 500); 
            }
        });

    //}else{
         
    //}
    
});