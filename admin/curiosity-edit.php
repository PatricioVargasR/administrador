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
                    <h4> Ver y Modificar dato curioso
                        <a href="view-curiosity.php" class="btn btn-danger float-end">Regresar</a>
                    </h4>
                </div>
                <div class="card-body">

                <?php

                    if(isset($_GET['_id'])){

                        $curiosity_id = $_GET['_id'];

                        $endpoint_actualizar = "https://apiadministrador-757cf479b30b.herokuapp.com/buscar_curiosidad/$curiosity_id";

                        $ch = curl_init($endpoint_actualizar);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                        $response = json_decode(curl_exec($ch), true);

                        curl_close($ch);

                        if(count($response) > 0){

                            foreach ($response as $curiosity_row){

                ?>
                    <form action="code.php" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="curiosity_id" value="<?= $curiosity_row['_id']?>">
                        <div class="row">

                            <div class="col-md-12 mb-3">
                                <label for="">Descripción</label>
                                <textarea name="description" id="summernote" class="form-control" rows="4" required><?= $curiosity_row['description']; ?></textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Estado</label> </br>
                                <!-- <input type="checkbox" name="status" width="70px" height="70px" /> -->
                                <input type="checkbox" name="status"  <?= $curiosity_row['status'] == '1' ? 'checked' : '' ?>   class="form-check-input">
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" name="curiosity_update" class="btn btn-primary">Actualizar</button>
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
