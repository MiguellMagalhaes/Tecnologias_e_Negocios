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

    <div class="mb-4" style="display:flex; justify-content:center;">
        <i class="fa-solid fa-user fs-1" style="color:#1F7A8C"></i>
    </div>
    <div class="mb-3" style="display:flex; justify-content:end;">
        <button type="submit" class="btn btn-danger btn-lg shadow" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="fa-solid fa-right-from-bracket"></i></button>
    </div>

    <form id="formProfile" action="#">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="nameP" name="nameP" minlength="1" maxlength="30" placeholder="Nome" value="<?php echo $_SESSION['name']; ?>" required>
            <label for="nameP">Nome</label>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="emailP" name="emailP" placeholder="Email" value="<?php echo $_SESSION['email']; ?>" required>
            <label for="emailP">Email</label>
        </div>
        <div class="input-group">
            <div class="form-floating">
                <input type="password" class="form-control" id="passwordP" name="passwordP"  minlength="8" maxlength="60" placeholder="Nova palavra-passe">
                <label for="passwordP">Nova palavra-passe</label>
                
            </div>
            <button class="btn btn-primary btnPassword" type="button" data-bs-toggle="button" onclick="showPassword(this,'passwordP');"><i class="fa-solid fa-eye"></i></button>
        </div>
        <div id="passwordHelp" class="form-text mt-2 mb-3">
            A nova palavra-passe deve ter entre 8 a 60 caracteres. <br>
            Deve incluir uma letra minúscula, maiúscula e um número.
        </div>
        <div class="input-group mb-3">
            <div class="form-floating">
                <input type="password" class="form-control" id="cpasswordP" name="cpasswordP" minlength="8" maxlength="60" placeholder="Confirmar nova palavra-passe" required>
                <label for="cpasswordP">Confirmar palavra-passe atual</label>
            </div>
            <button class="btn btn-primary btnPassword" type="button" data-bs-toggle="button" onclick="showPassword(this,'cpasswordP');"><i class="fa-solid fa-eye"></i></button>
        </div>
        <div class="text-end">
            <button type="button" onclick="editProfile();" class="btn btn-warning btn-lg shadow mb-5"><i class="fa-solid fa-pen-to-square"></i></button>
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

    .btn-danger{
        background-color: #dc3545;
        color: white;
        border: 2px solid #dc3545!important;
        transition: 0.5s;
    }
    .btn-danger:hover{
        background-color: white;
        color: #dc3545;
    }

    .btn-warning{
        background-color: #ffc107;
        color: black;
        border: 2px solid #ffc107!important;
        transition: 0.5s;
    }
    .btn-warning:hover{
        background-color: white;
        color: #ffc107;
    }

    .btn-secondary{
        background-color: #6c757d;
        color: white;
        border: 2px solid #6c757d!important;
        transition: 0.5s;
    }
    .btn-secondary:hover{
        background-color: white;
        color: #6c757d;
    }

    .btn-primary:active{
        background-color: #1F7A8C!important;
        color: white!important;
    }

    .btn.active{
        background-color: white;
        color: #1F7A8C;
    }

</style>

<!-- Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="logoutModal">Logout</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Tem a certeza que deseja terminar a sessão?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
        <button type="button" class="btn btn-danger" id="logoutBtn" onclick="Logout();"><i class="fa-solid fa-right-from-bracket"></i></button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModal">Editar perfil</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Tem a certeza que deseja realizar as alterações no seu perfil?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
        <button type="button" class="btn btn-warning" id="editBtn" onclick="submitEdit();"><i class="fa-solid fa-pen-to-square"></i></button>
      </div>
    </div>
  </div>
</div>

<script>

    function Logout(){
        $("#logoutBtn").html(
            `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`
        );
        $.ajax({
            url: "./inc/logout.php",
            dataType: 'json',
            success: function(data){
                setTimeout(location.reload.bind(location), 2000);
            }
        });
    }

    function editProfile(){

        var nameRegex = /^.+$/;
        var emailRegex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d\w\W]+$/;

        var name = $("#nameP").val();
        flagName = nameRegex.test(nameRegex) && name.length >= 1 && name.length <= 30;

        var email = $("#emailP").val().trim();
        flagEmail = emailRegex.test(email) && email.length <= 255;

        var password = $("#passwordP").val();
        flagPassword = true;
        if(password.trim()){
            flagPassword = passwordRegex.test(password) && password.length >= 8 && password.length <= 60;
        }

        var cpassword = $("#cpasswordP").val();
        flagCPassword = true;
        if (!cpassword.trim()) {
            flagCPassword = false;
        }

        $("#nameP").css({'border': "1px solid #dee2e6"});
        $("#emailP").css({'border': "1px solid #dee2e6"});
        $("#passwordP").css({'border': "1px solid #dee2e6"});
        $("#cpasswordP").css({'border': "1px solid #dee2e6"});

        if(flagName && flagEmail && flagPassword && flagCPassword){

            $('#editModal').modal('show');

        }else{

            if(!flagName){
                $("#nameP").css({'border': "1px solid red"});
            }

            if(!flagEmail){
                $("#emailP").css({'border': "1px solid red"});
            }

            if(!flagPassword){
                $("#passwordP").css({'border': "1px solid red"});
            }

            if(!flagCPassword){
                $("#cpasswordP").css({'border': "1px solid red"});
            }

        }

    }

    function submitEdit(){

        $("#editBtn").html(
            `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`
        );

        setTimeout(function(){
            var name = $("#nameP").val();
            var email = $("#emailP").val();
            var password = $("#passwordP").val();
            var cpassword = $("#cpasswordP").val();
            
            $.ajax({
                url: "./inc/edit.php",
                type: "post",
                dataType: 'json',
                data: { 
                    name: name,
                    email: email,
                    newpassword: password,
                    password: cpassword
                },
                success: function(data){
                    
                    if(data.result){
                        $("#textSuccess").text("Conta atualizada com sucesso!");
                        $("#toastSuccess").toast('show');
                    }else{
                        $("#textError").text("Dados inválidos! Por favor, tente novamente...");
                        $("#toastError").toast('show');
                    }
                    
                    $("#passwordP").val('');
                    $("#cpasswordP").val('');
                    $("#nameP").val(data.name);
                    $("#emailP").val(data.email);
                    $('#editModal').modal('hide');
                    
                }
            });
        }, 2000);
        
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