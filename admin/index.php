<?php

    include('authentication.php');
    include('includes/header.php');

?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Panel de Administración</h1>
    <ol class="breadcrumb mb-4">
         <li class="breadcrumb-item active">Menú de Administración</li>
    </ol>
    <?php include('message.php'); ?>
    <div class="row">
        <?php if($_SESSION['auth_role'] == '1'): ?>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    Total de categorias
                    <?php

                        $endpoint = "https://apiadministrador-757cf479b30b.herokuapp.com/categorias";

                        $ch = curl_init($endpoint);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                        $response = json_decode(curl_exec($ch));

                        curl_close($ch);

                        if($category_total = count($response)){

                            echo '<h4 class="mb-0"> '.$category_total.' </h4>';

                        } else {

                            echo '<h4 class="mb-0"> Sin datos </h4>';

                        }

                    ?>

                </div>

                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="category-view.php">Ver Detalles</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    Total de publicaciones
                    <?php

                        $endpoint = "https://apiadministrador-757cf479b30b.herokuapp.com/posts";

                        $ch = curl_init($endpoint);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                        $response = json_decode(curl_exec($ch));

                        curl_close($ch);


                        if($post_total = count($response)){

                            echo '<h4 class="mb-0"> '.$post_total.' </h4>';

                        } else {

                            echo '<h4 class="mb-0"> Sin datos </h4>';

                        }

                    ?>

                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="post-view.php">Ver Detalles</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    Total de efemerides
                    <?php

                        $endpoint = "https://apiadministrador-757cf479b30b.herokuapp.com/efemerides";

                        $ch = curl_init($endpoint);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                        $response = json_decode(curl_exec($ch));

                        curl_close($ch);


                        if($post_total = count($response)){

                            echo '<h4 class="mb-0"> '.$post_total.' </h4>';

                        } else {

                            echo '<h4 class="mb-0"> Sin datos </h4>';

                        }

                    ?>

                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="efemeride-edit.php">Ver Detalles</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-secondary text-white mb-4">
                <div class="card-body">
                    Total de datos curiosos
                    <?php

                        $endpoint = "https://apiadministrador-757cf479b30b.herokuapp.com/curiosidades";

                        $ch = curl_init($endpoint);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                        $response = json_decode(curl_exec($ch));

                        curl_close($ch);


                        if($post_total = count($response)){

                            echo '<h4 class="mb-0"> '.$post_total.' </h4>';

                        } else {

                            echo '<h4 class="mb-0"> Sin datos </h4>';

                        }

                    ?>

                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="view-curiosity.php">Ver Detalles</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    Total de imagenes en carrusel
                    <?php

                        $endpoint = "https://apiadministrador-757cf479b30b.herokuapp.com/imagenes";

                        $ch = curl_init($endpoint);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                        $response = json_decode(curl_exec($ch));

                        curl_close($ch);


                        if($post_total = count($response)){

                            echo '<h4 class="mb-0"> '.$post_total.' </h4>';

                        } else {

                            echo '<h4 class="mb-0"> Sin datos </h4>';

                        }

                    ?>

                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="artwork-view.php">Ver Detalles</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-info text-white mb-4">
                <div class="card-body">
                    Total de dispositivos
                    <?php

                        $endpoint = "https://apiadministrador-757cf479b30b.herokuapp.com/dispositivos";

                        $ch = curl_init($endpoint);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                        $response = json_decode(curl_exec($ch));

                        curl_close($ch);


                        if($post_total = count($response)){

                            echo '<h4 class="mb-0"> '.$post_total.' </h4>';

                        } else {

                            echo '<h4 class="mb-0"> Sin datos </h4>';

                        }

                    ?>

                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="iot-view.php">Ver Detalles</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if($_SESSION['auth_role'] == '2'): ?>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    Total de usuarios
                    <?php

                        $endpoint = "https://apisuperadministrador-5b08c9c6f028.herokuapp.com/usuarios";

                        $ch = curl_init($endpoint);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                        $response = json_decode(curl_exec($ch));

                        curl_close($ch);

                        if($users_total = count($response)){

                            echo '<h4 class="mb-0"> '.$users_total.' </h4>';

                        } else {

                            echo '<h4 class="mb-0"> Sin datos </h4>';

                        }

                    ?>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="view-register.php">Ver Detalles</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    Total de usuarios suspendidos
                    <?php

                        $endpoint = "https://apisuperadministrador-5b08c9c6f028.herokuapp.com/usuarios_suspendidos";

                        $ch = curl_init($endpoint);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                        $response = json_decode(curl_exec($ch));

                        curl_close($ch);


                        if($block_total = count($response)){

                            echo '<h4 class="mb-0"> '.$block_total.' </h4>';

                        } else {

                            echo '<h4 class="mb-0"> 0 </h4>';

                        }

                    ?>
                </div>

                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="view-block.php">Ver Detalles</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-secondary text-white mb-4">
                <div class="card-body">
                    Total de usuarios correos enviados
                    <?php

                        $endpoint = "https://apisuperadministrador-5b08c9c6f028.herokuapp.com/emails_enviados";

                        $ch = curl_init($endpoint);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                        $response = json_decode(curl_exec($ch));

                        curl_close($ch);


                        if($block_total = count($response)){

                            echo '<h4 class="mb-0"> '.$block_total.' </h4>';

                        } else {

                            echo '<h4 class="mb-0"> 0 </h4>';

                        }

                    ?>
                </div>

                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="view-email.php">Ver Detalles</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    Total de correos suscritos
                    <?php

                        $endpoint = "https://apisuperadministrador-5b08c9c6f028.herokuapp.com/emails";

                        $ch = curl_init($endpoint);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                        $response = json_decode(curl_exec($ch));

                        curl_close($ch);


                        if($block_total = count($response)){

                            echo '<h4 class="mb-0"> '.$block_total.' </h4>';

                        } else {

                            echo '<h4 class="mb-0"> 0 </h4>';

                        }

                    ?>
                </div>

                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="view-visitas.php">Ver Detalles</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>


<?php

    include('includes/footer.php');
    include('includes/scripts.php');

?>
