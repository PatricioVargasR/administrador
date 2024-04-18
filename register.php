<?php

    include('includes/config.php');

    $page_title = "Página de Registro";
    $meta_description = "Página de registro del museo del santo";
    $meta_keywords = "El santo, Tulancingo, Hidalgo, Cultura";

    include('includes/header.php');

    if(isset($_SESSION['auth'])){

        $_SESSION['message'] = "Actualmente ya has iniciado sesión";
        header("Location: index.php");
        exit(0);

    }

    include('includes/navbar.php');
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">

                <?php include('message.php'); ?>


                <div class="card">
                    <div class="card-header">
                        <h4>Registrate</h4>
                    </div>
                    <div class="card-body">

                    <form action="registercode.php" method="POST">

                        <div class="form-group mb-3">
                            <label for="">Nombre(s)</label>
                            <input type="text" name="fname" placeholder="Ingresa tu primer nombre" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Apellidos</label>
                            <input type="text"  name="lname" placeholder="Ingresa tu segundo nombre" class="form-control"required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Correo Electronico</label>
                            <input type="email" name="email" placeholder="Ingresa tu correo electronico" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Contraseña</label>
                            <input type="password" name="password" id="password" placeholder="Ingresa tu contraseña" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Confirma tu contraseña</label>
                            <input type="password" name="cpassword" id="cpassword"placeholder="Confirma tu contraseña" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                                <button class="btn btn-secondary" type="button" onclick="mostrarContraseña()">Mostrar Contraseña</button>
                                <hr>
                        <div style="display: flex; flex-direction: row; justify-content: space-around; align-items: center">

                            <button type="submit" name="register_btn" class="btn btn-danger">Enviar</button>
                            <a href="index.php" class="btn btn-primary">Regresar</a>
                        </div>
                        </div>

                    </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
function mostrarContraseña() {

    var tipo = document.getElementById("password");
    var tipo2 = document.getElementById('cpassword');

    var nuevoTipo = (tipo.type === "password") ? "text" : "password";

    tipo.type = nuevoTipo;
    tipo2.type = nuevoTipo;
}


</script>


<?php

    include('includes/footer.php');
?>