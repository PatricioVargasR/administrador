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
                    <h4> Ver efemeride
                        <a href="efemeride-add.php" class="btn btn-primary float-end">Agregar </a>
                    </h4>

                </div>
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Editar</th>
                            <th>Eliminar</th>

                        </thead>
                        <tbody>
                        <!-- Extraemos los datos de la base de datos  -->
                            <?php

                                $endpoint = "https://apiadministrador-757cf479b30b.herokuapp.com/efemerides";

                                $ch = curl_init($endpoint);

                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                                $response = json_decode(curl_exec($ch), true);

                                curl_close($ch);

                                if (count($response) > 0) {

                                    foreach($response as $efemerides){
                                        ?>

                                            <tr>
                                                <td><?= $efemerides['_id']; ?></td>
                                                <td><?= $efemerides['name']; ?></td>
                                                <?php
                                                    $formatted_date = date('Y-m-d', strtotime($efemerides['date']));
                                                ?>
                                                <td><?= $formatted_date?></td>
                                                <td>

                                                        <?= $efemerides['status'] == '1' ? 'Oculto':'Visible';
                                                    ?>


                                                </td>
                                                <td><a href="efemeride-edit.php?_id=<?= $efemerides['_id']; ?>" class="btn btn-success">Editar</a></td>
                                                <td>

                                                    <form action="code.php" method="POST">
                                                        <button type="submit" name="efemeride_delete_btn" value="<?=$efemerides['_id'];?>" class="btn btn-danger">Eliminar</button>
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


<?php

    include('includes/footer.php');
    include('includes/scripts.php');

?>
