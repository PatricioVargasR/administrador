<?php

include('authentication.php');
include('middleware/superadminAuth.php'); # SuperAdministrador
include('includes/header.php');
?>

<div class="container-fluid px-4">
<h4 class="mt-4">Email</h4>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Menú de Administración</li>
    <li class="breadcrumb-item">Emails</li>
</ol>

<div class="row">
    <div class="col-md-12">
        <?php include('message.php'); ?>
        <div class="card">
            <div class="card-header">
                <h4> Emails enviados
                </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">

                        <thead>
                            <th>Identificador</th>
                            <th>Remitente</th>
                            <th>Asunto</th>
                            <th>Fecha</th>
                            <th>Ver más</th>
                        </thead>

                        <tbody>
                            <?php

                                $endpoint = "https://apisuperadministrador-5b08c9c6f028.herokuapp.com/emails_enviados";

                                $ch = curl_init($endpoint);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                                $response = json_decode(curl_exec($ch), true);

                                curl_close($ch);

                                if (count($response) > 0) {

                                    foreach($response as $row){
                                        ?>

                                            <tr>
                                                <td><?= $row['_id']; ?></td>
                                                <td><?= $row['msg_from']; ?></td>
                                                <td><?= $row['title']; ?></td>
                                                <?php
                                                    $formatted_date = date('Y-m-d', strtotime($row['send_at']));
                                                ?>
                                                <td><?= $formatted_date ?></td>

                                                <td><a href="about-email.php?_id=<?= $row['_id']; ?>" class="btn btn-success">Ver más</a></td>
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

<!--
Script de confirmación para eliminar registro
-->

<script>

function confirmacion(){
   return confirm("¿Desea realmente borrar el registro?");

}

</script>

<?php

include('includes/footer.php');
include('includes/scripts.php');

?>
