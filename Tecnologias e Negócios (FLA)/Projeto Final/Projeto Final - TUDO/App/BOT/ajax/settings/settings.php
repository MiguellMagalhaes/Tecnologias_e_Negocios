<?php
    @session_start();
?>

<div class="top rounded-bottom p-3 shadow mb-2">

    <img src="./img/logo.png" alt="" style="max-width: 100%; max-height: 100%;margin-left: auto;margin-right: auto;display: block;">

    <div id="about" class="ps-5 pe-5 mt-4 mb-5" hidden>
        <hr class="rounded">
        <p class="text-start text-primary mt-4">
            No vibrante cenário do setor de transporte em Portugal, uma revolução está em curso, liderada pela inovadora aplicação Be On Time (BOT). A BOT não é apenas um motor de busca, é uma solução transformadora destinada a redefinir a forma como os indivíduos se deslocam e experienciam o transporte em Portugal. O seu sucesso está enraizado numa alinhamento estratégico com as tendências de mercado, no compromisso com as necessidades dos clientes e na dedicação em simplificar o processo de planeamento de viagens.
            <br><i>Com a BOT, chegas sempre a tempo!</i>
        </p>
    </div>
    
    
    <style>

        .text-primary{
            color: #1F7A8C!important;
        }

        .top{
            background-color:white;
            position: sticky;
            width:100%;
            z-index: 100;
            height:180px;
            top:0;
        }

        hr.rounded {
            border-top: 8px solid #1F7A8C;
            opacity: 1;
        }
        hr.r-small {
            border-top: 4px solid #1F7A8C;
            opacity: 1;
        }

    </style>

</div>

<div class="content p-5 mb-5">

<!--
<div class="mb-3" style="display:flex; justify-content:center">
  <input type="checkbox" class="checkbox" id="checkbox">
  <label for="checkbox" class="checkbox-label">
    <i class="fa-solid fa-moon"></i>
    <i class="fa-solid fa-sun"></i>
    <span class="ball"></span>
  </label>
</div>
-->

<style>
    .checkbox {
  opacity: 0;
  position: absolute;
}

.checkbox-label {
  background-color: #111;
  height: 2.5rem;
    width: calc(4rem + 0.75rem);
    border-radius: 5rem;
  position: relative;
  padding: 5px;
  cursor: pointer;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.fa-moon {color: #f1c40f;}

.fa-sun {color: #f39c12;}

.checkbox-label .ball {
  background-color: #fff;
  width: 2rem;
  height: 2rem;
  position: absolute;
  left: 4px;
  top: 4px;
  border-radius: 50%;
  transition: transform 0.2s linear;
}

.checkbox:checked + .checkbox-label .ball {
  transform: translateX(2.3rem);
}
</style>

    <div class="list-group text-start fs-5 list-group-flush p-0">

        <a href="javascript:AccountAjax();" class="list-group-item rounded list-group-item-action mb-2">
            <i class="fa-solid fa-user"></i> &nbsp Conta
            <span class="badge bg-primary rounded-pill" style="float:right"><i class="fa-solid fa-angle-right"></i></span>
        </a>

        <a href="javascript:aboutAnimation()" class="list-group-item rounded list-group-item-action mb-2">
            <i class="fa-solid fa-circle-info"></i> &nbsp Sobre
            <span class="badge bg-primary rounded-pill" style="float:right"><i class="fa-solid fa-angle-right"></i></span>
        </a>

    </div>

</div>

<style>

    .form-switch.form-switch-xl .form-check-input {
        height: 2.5rem;
        width: calc(4rem + 0.75rem);
        border-radius: 5rem;
        transition: 0.5s;
    }

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

<script>

    function aboutAnimation(){
        $(".top").removeClass("shadow");
        $('.top').css("height","100vh");
        $('#about').removeAttr('hidden');
    }

    function AccountAjax(){

        if (<?php echo isset($_SESSION['logged'])?'true':'false'; ?>) {

            $.ajax({
            url: "ajax/settings/profile.php",
            success: function(data) {
                $("#main").html(data);
            }
            });

        } else {

            $.ajax({
            url: "ajax/settings/account.php",
            success: function(data) {
                $("#main").html(data);
            }
            });

        }

    }

</script>