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
                    <h4> Modificar efemeride
                        <a href="view-efemeride.php" class="btn btn-danger float-end">Regresar</a>
                    </h4>
                </div>
                <div class="card-body">

                <?php 

                    if(isset($_GET['_id'])){

                        $efemeride_id = $_GET['_id'];

                        $endpoint_actualizar = "https://apiadministrador-757cf479b30b.herokuapp.com/buscar_efemeride/$efemeride_id";

                        $ch = curl_init($endpoint_actualizar);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                        $response = json_decode(curl_exec($ch), true);

                        curl_close($ch);

                        if(count($response) > 0){

                            foreach ($response as $efemeride_row){

                ?>
                    <form action="code.php" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="efemeride_id" value="<?= $efemeride_row['_id']?>">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Nombre</label>
                                <input type="text" name="name"  value="<?= $efemeride_row['name']; ?>" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Fecha de la Efemeride</label>
                                    <?php
                                        $formatted_date = date('Y-m-d', strtotime($efemeride_row['date']));
                                    ?>
                                    <input type="date" name="date" value="<?= $formatted_date; ?>" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Desactivar</label> </br>
                                <input type="checkbox" name="status"  <?= $efemeride_row['status'] == '1' ? 'checked' : '' ?>   class="form-check-input">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="">Descripción</label>
                                <textarea name="description" id="summernote" class="form-control" rows="4" required><?= $efemeride_row['description']; ?></textarea>
                            </div>


                            <div class="col-md-12 mb-3">
                                <button type="submit" name="efemeride_update" class="btn btn-primary">Actualizar</button>
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
