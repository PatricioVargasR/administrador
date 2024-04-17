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
                    <h4> Modificar dispositivo
                        <a href="iot-view.php" class="btn btn-danger float-end">Regresar</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?php

                        if(isset($_GET['_id'])){

                            $dispositivo_id = $_GET['_id'];

                            $endpoint_actualizar = "https://apiadministrador-757cf479b30b.herokuapp.com/buscar_dispositivo/$dispositivo_id";

                            $ch = curl_init($endpoint_actualizar);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                            $response = json_decode(curl_exec($ch), true);

                            curl_close($ch);

                            if (count($response) > 0){

                                foreach ($response as $dispositivo){

                    ?>
                    <form action="code.php" method="POST">
                        <input type="hidden" name="dispositivo_id" value="<?= $dispositivo['_id']; ?>">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Obra asociada</label>
                                <input type="text" name="obra_asociada" value="<?= $dispositivo['obra_asociada'] ?>" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Texto en pantalla</label>
                                <textarea name="texto_pantalla" class="form-control" rows="4"><?= implode(', ', $dispositivo['texto_pantalla']); ?></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Estado</label> </br>
                                <input type="checkbox" name="status" <?= $dispositivo['estado'] == '1' ? 'checked' : ''; ?> class="form-check-input">
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="submit" name="iot_update" class="btn btn-primary">Actualizar dispositivo</button>
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
