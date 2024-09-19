<?php
    @session_start();
?>
<div class="top rounded-bottom p-3 shadow mb-2">

    <img src="./img/logo.png" alt="" style="max-width: 100%;
    max-height: 100%;margin-left: auto;
  margin-right: auto;
  display: block;">
    
    <style>

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

    <div class="mb-3" style="display:flex; justify-content:center;">
        <input type="checkbox" class="checkbox" id="accountSwitch">
        <label for="accountSwitch" class="checkbox-label">
            <i class="fa-solid fa-right-to-bracket"></i>
            <i class="fa-solid fa-user-plus"></i>
            <span class="ball"></span>
        </label>
    </div>

    <form id="formLogin" action="javascript:accountForm();">
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="emailL" name="emailL" placeholder="Email" required>
            <label for="emailL">Email</label>
        </div>

        <div class="input-group mb-3">
            <div class="form-floating">
                <input type="password" class="form-control" id="passwordL" name="passwordL" placeholder="Palavra-passe" minlength="8" maxlength="60" required>
                <label for="passwordL">Palavra-passe</label>
            </div>
            <button class="btn btn-primary btnPassword" type="button" data-bs-toggle="button" onclick="showPassword(this,'passwordL');"><i class="fa-solid fa-eye"></i></button>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary btn-lg shadow mb-5"><i class="fa-solid fa-right-to-bracket"></i></button>
        </div>
    </form>

    <form id="formRegister" action="javascript:accountForm();">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="nameR" name="nameR" placeholder="Nome" required>
            <label for="nameR">Nome</label>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="emailR" name="emailR" placeholder="Email" required>
            <label for="emailR">Email</label>
        </div>

        <div class="input-group mb-3">
            <div class="form-floating">
                <input type="password" class="form-control" id="passwordR" name="passwordR" placeholder="Palavra-passe" required>
                <label for="passwordR">Palavra-passe</label>
            </div>
            <button class="btn btn-primary btnPassword" type="button" data-bs-toggle="button" onclick="showPassword(this,'passwordR');"><i class="fa-solid fa-eye"></i></button>
        </div>

        <div class="input-group mb-3">
            <div class="form-floating">
                <input type="password" class="form-control" id="cpasswordR" name="cpasswordR" placeholder="Confirmar palavra-passe" required>
                <label for="cpasswordR">Confirmar palavra-passe</label>
            </div>
            <button class="btn btn-primary btnPassword" type="button" data-bs-toggle="button" onclick="showPassword(this,'cpasswordR');"><i class="fa-solid fa-eye"></i></button>
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-primary btn-lg shadow mb-5"><i class="fa-solid fa-user-plus"></i></button>
        </div>
    </form>

</div>

<div class="toast align-items-center text-bg-danger border-0" id="toastError" role="alert" aria-live="assertive" aria-atomic="true" style="position:fixed;top:35px;right:35px;z-index:1000">
  <div class="d-flex">
    <div class="toast-body" id="textError">
      Notificação de erro!
    </div>
    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
</div>

<div class="toast align-items-center text-bg-success border-0" id="toastSuccess" role="alert" aria-live="assertive" aria-atomic="true" style="position:fixed;top:35px;right:35px;z-index:1000">
  <div class="d-flex">
    <div class="toast-body" id="textSuccess">
        Notificação de sucesso!
    </div>
    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
</div>

<style>

    .form-switch.form-switch-xl .form-check-input {
        height: 2.5rem;
        width: calc(4rem + 0.75rem);
        border-radius: 5rem;
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

<style>
    .checkbox {
  opacity: 0;
  position: absolute;
}

.checkbox-label {
  background-color: white;
  height: 2.5rem;
    width: calc(4rem + 0.75rem);
    border-radius: 5rem;
  position: relative;
  padding: 5px;
  cursor: pointer;
  display: flex;
  justify-content: space-between;
  align-items: center;
  border: 2px solid #1F7A8C;
}

.checkbox-label .fa-right-to-bracket {color: white; z-index:1;margin-left:5px}

.checkbox-label .fa-user-plus {color: #1F7A8C;z-index:1;margin-right:3px}

.checkbox-label .ball {
  background-color: #1F7A8C;
  width: 2rem;
  height: 2rem;
  position: absolute;
  left: 3px;
  top: 2px;
  border-radius: 50%;
  transition: transform 0.2s linear;
}

.checkbox:checked + .checkbox-label .ball {
  transform: translateX(2.1rem);
}

.checkbox:checked + .checkbox-label .fa-user-plus {
  color:white;
}

.checkbox:checked + .checkbox-label .fa-right-to-bracket {
  color:#1F7A8C;
}

</style>

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

    $("#formRegister").hide();

    $('#accountSwitch').change(function() {

        if($('#accountSwitch')[0].checked){
            $("#formLogin").hide();
            $("#formRegister").show();
        }else{
            $("#formLogin").show();
            $("#formRegister").hide();
        }

    });

    function accountForm(){

        var nameRegex = /^.+$/;
        var emailRegex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d\w\W]+$/;

        if($('#accountSwitch')[0].checked){

            // Register

            var name = $("#nameR").val();
            flagName = nameRegex.test(nameRegex) && name.length >= 1 && name.length <= 30;

            var email = $("#emailR").val().trim();
            flagEmail = emailRegex.test(email) && email.length <= 255;

            var password = $("#passwordR").val();
            flagPassword = passwordRegex.test(password) && password.length >= 8 && password.length <= 60;

            var cpassword = $("#cpasswordR").val();
            flagCPassword = (password === cpassword);

            if(flagName && flagEmail && flagPassword && flagCPassword){

                $.ajax({
                    url: "./inc/register.php",
                    type: "post",
                    dataType: 'json',
                    data: { 
                        name: name,
                        email: email,
                        password: password
                    },
                    success: function(data){
                        if(data.result){
                            $("#textSuccess").text("Conta criada com sucesso! A iniciar sessão...");
                            $("#toastSuccess").toast('show');
                            setTimeout(location.reload.bind(location), 4000);
                        }else{
                            $("#textError").text("Email já registado! Por favor, tente novamente...");
                            $("#toastError").toast('show');
                        }
                    }
                });

            }else{

                if(!flagName){
                    $("#nameR").css({'border': "1px solid red"});
                }else{
                    $("#nameR").css({'border': "1px solid #dee2e6"});
                }

                if(!flagEmail){
                    $("#emailR").css({'border': "1px solid red"});
                }else{
                    $("#emailR").css({'border': "1px solid #dee2e6"});
                }

                if(!flagPassword){
                    $("#passwordR").css({'border': "1px solid red"});
                }else{
                    $("#passwordR").css({'border': "1px solid #dee2e6"});
                }

                if(!flagCPassword){
                    $("#cpasswordR").css({'border': "1px solid red"});
                }else{
                    $("#cpasswordR").css({'border': "1px solid #dee2e6"});
                }

            }

        }else{

            // Login

            var email = $("#emailL").val().trim();
            flagEmail = emailRegex.test(email) && email.length <= 255;

            var password = $("#passwordL").val();
            flagPassword = passwordRegex.test(password) && password.length >= 8 && password.length <=60;

            if(flagEmail && flagPassword){

                $.ajax({
                    url: "./inc/login.php",
                    type: "post",
                    dataType: 'json',
                    data: { 
                        email: email,
                        password: password
                    },
                    success: function(data){
                        if(data.result){
                            $("#textSuccess").text("Sessão iniciada com sucesso! A carregar...");
                            $("#toastSuccess").toast('show');
                            setTimeout(location.reload.bind(location), 4000);
                        }else{
                            $("#textError").text("Dados inválidos! Por favor, tente novamente...");
                            $("#toastError").toast('show');
                        }
                    }
                });

            }else{

                if(!flagEmail){
                    $("#emailL").css({'border': "1px solid red"});
                }else{
                    $("#emailL").css({'border': "1px solid #dee2e6"});
                }

                if(!flagPassword){
                    $("#passwordL").css({'border': "1px solid red"});
                }else{
                    $("#emailL").css({'border': "1px solid #dee2e6"});
                }

            }
            
        }

    }

    function showPassword(btn, id){
        if(($(btn)).attr('aria-pressed') == 'true'){
            $(btn).html('<i class="fa-solid fa-eye-slash"></i>');
        }else{
            $(btn).html('<i class="fa-solid fa-eye"></i>');
        }
        input = document.getElementById(id);
        type = input.getAttribute("type") === "password" ? "text" : "password";
        input.setAttribute("type", type);
    }

</script>