<?php

    include('authentication.php');
    include('middleware/superadminAuth.php');#SuperAdministrador
    include('includes/header.php');

?>

<div class="container-fluid px-4">
        <h4 class="mt-4">Correos registrados</h4>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Menú de Administración</li>
            <li class="breadcrumb-item">Correos</li>
        </ol>

        <div class="row">
            <div class="col-md-12">
                <?php include('message.php'); ?>
                <div class="card">
                    <div class="card-header">
                        <h4> Correos personales
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">

                            <thead>
                                    <th>Identificador</th>
                                    <th>Correo</th>
                                    <th>Registrado</th>
                                    <th>Eliminar</th>

                                </thead>

                                <tbody>

                                <?php

                                    $endpoint = "https://apisuperadministrador-5b08c9c6f028.herokuapp.com/emails";

                                    $ch = curl_init($endpoint);
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                                    $response = json_decode(curl_exec($ch), true);

                                    curl_close($ch);

                                    if(count($response) > 0){

                                    foreach ($response as $users) {
                                        ?>
                                            <tr>
                                                <td><?= $users['_id']; ?></td>
                                                <td><?= $users['email']; ?></td>
                                                <?php
                                                $formatted_date = date('Y-m-d', strtotime($users['upload_at']))
                                                ?>
                                                <td><?= $formatted_date ?></td>

                                                <td>

                                                    <form action="codesuperadmin.php" method="POST">

                                                        <button type="submit" name="users_delete" value="<?=$users['_id'];?>" onclick='return confirmacion()' class="btn btn-danger">Eliminar</button>

                                                    </form>
                                                </td>

                                            </tr>

                                        <?php
                                        }

                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="6">Información no encontrada</td>
                                        </tr>
                                    <?php

                                    }


                                ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>

function confirmacion(){
   return confirm("¿Desea realmetne borrar el registro?");
}

</script>

<?php

include('includes/footer.php');
include('includes/scripts.php');

?>
