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
                    <h4> Agregar nuevo dispositivo
                        <a href="iot-view.php" class="btn btn-danger float-end">Regresar</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Obra asociada</label>
                                <input type="text" name="obra_asociada" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Texto en pantalla</label>
                                <textarea name="texto_pantalla" class="form-control" rows="4"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Estado</label> </br>
                                <input type="checkbox" name="status" class="form-check-input">
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="submit" name="iot_add" class="btn btn-primary">Agregar dispositivo</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php

    include('includes/footer.php');
    include('includes/scripts.php');

?>
