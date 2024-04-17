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
                    <h4> Agregar Imagenes
                        <a href="artwork-view.php" class="btn btn-danger float-end">Regresar</a>
                    </h4>
                </div>
                <div class="card-body">

                <?php

                    if(isset($_GET['_id'])){

                        $artwork_id = $_GET['_id'];

                        $endpoint_actualizar = "https://apiadministrador-757cf479b30b.herokuapp.com/buscar_imagen/$artwork_id";

                        $ch = curl_init($endpoint_actualizar);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                        $response = json_decode(curl_exec($ch), true);

                        curl_close($ch);

                        if(count($response) > 0){

                            foreach($response as $artworks){

                ?>
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-3">

                            <input type="hidden" name="artwork_id" value="<?= $artworks['_id']; ?>">

                            <label for="">Imagen </label>
                                <input accept="image/*" type="file" name="image" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Nombre</label>
                                <input type="text" name="name" value="<?= $artworks['name']; ?>" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Desactivar</label> </br>
                                <!-- <input type="checkbox" name="status" width="70px" height="70px" /> -->
                                <input type="checkbox" name="status"  <?= $artworks['status'] == '1' ? 'checked' : '' ?>   class="form-check-input">

                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" name="artwork-update"class="btn btn-primary">Actualizar Imagen</button>
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
