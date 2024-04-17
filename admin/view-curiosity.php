<?php

    include('authentication.php');
    include('includes/header.php');

?>

<div class="container-fluid px-4">
    <div class="row mt-4">
        <div class="col-md-12">

            <?php include('message.php') ?>

            <div class="card">
                <div class="card-header">
                    <h4> Ver Dato Curioso
                    </h4>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>Id</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Editar</th>

                        </thead>
                        <tbody>
                        <!-- Extraemos los datos de la base de datos  -->
                            <?php

                                $endpoint = "https://apiadministrador-757cf479b30b.herokuapp.com/curiosidades";

                                $ch = curl_init($endpoint);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                                $response = json_decode(curl_exec($ch), true);

                                curl_close($ch);

                                if (count($response) > 0) {
                                    foreach($response as $curiosity){
                                        ?>
                                            <tr>
                                                <td><?= $curiosity['_id']; ?></td>
                                                <td><?= $curiosity['description']; ?></td>
                                                <td>

                                                        <?= $curiosity['status'] == '1' ? 'Oculto':'Visible';
                                                    ?>

                                                </td>
                                                <td><a href="curiosity-edit.php?_id=<?= $curiosity['_id']; ?>" class="btn btn-success">Editar</a></td>
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


<?php

    include('includes/footer.php');
    include('includes/scripts.php');

?>
