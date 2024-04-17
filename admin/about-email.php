<?php

    include('authentication.php');
    include('middleware/superadminAuth.php'); # SuperAdministrador
    include('includes/header.php');

?>

<div class="container-fluid px-4">
    <h4 class="mt-4">Correo de anuncios</h4>
    <ol class="breadcrumb mb-4">
         <li class="breadcrumb-item active">Menú de administración</li>
         <li class="breadcrumb-item">Correo</li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4> Acerca del correo
                        <a href="view-email.php" class="btn btn-danger float-end">Regresar</a>
                    </h4>

                </div>
                <div class="card-body">


                <?php

                    if(isset($_GET['_id'])){

                        $id_email = $_GET['_id'];

                        $endpoint_actualizar = "https://apisuperadministrador-5b08c9c6f028.herokuapp.com/buscar_email_enviados/$id_email";

                        $ch = curl_init($endpoint_actualizar);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                        $response = json_decode(curl_exec($ch), true);

                        curl_close($ch);

                        if(count($response) > 0){

                            foreach($response as $email){

                                ?>
                                    <form action="codesuperadmin.php" method="POST">
                                    <input type="hidden" name="user_id" value="<?= $email['_id']; ?>">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="">Asunto</label>
                                                <input type="text" name="asunto" value="<?= $email['title']; ?>" class="form-control" readonly>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="">Remitente</label>
                                                <input type="text" name="remitente" value="<?= $email['msg_from']; ?>"  class="form-control" readonly>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="">Enviado</label>
                                                <?php
                                                    $formatted_date = date('Y-m-d', strtotime($email['send_at']));
                                                    ?>
                                                <input type="email" name="email" value="<?= $formatted_date ?>"  class="form-control" readonly>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="">Meta Description</label>
                                                <textarea name="description" id="summernote" class="form-control" rows="4" readonly><?= $email['content']; ?></textarea>
                                            </div>
                                        </div>
                                    </form>
                                <?php

                            }

                        } else {
                            ?>

                                <h4>No se encontró información</h4>


                            <?php

                        }
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>


<?php

    include('includes/footer.php');
    include('includes/scripts.php');

?>
