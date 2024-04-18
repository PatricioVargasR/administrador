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
                    <h4> Ver Imagenes
                        <a href="artwork-add.php" class="btn btn-primary float-end">Subir nueva imagen</a>
                    </h4>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>Id</th>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Editar</th>
                            <th>Eliminar</th>

                        </thead>
                        <tbody>
                        <!-- Extraemos los datos de la base de datos  -->
                            <?php

                                $endpoint = "https://apiadministrador-757cf479b30b.herokuapp.com/imagenes";

                                $ch = curl_init($endpoint);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                                $response = json_decode(curl_exec($ch), true);

                                curl_close($ch);

                                if (count($response) > 0) {
                                    foreach($response as $artworks){
                                        ?>  

                                            <tr>
                                                <td><?= $artworks['_id']; ?></td>
                                                <td> <img src="data:image/*;base64,<?= $artworks['image']; ?>" alt="<?=$artworks['name'];?>" width="60px" height="60px"></td>
                                                <td><?= $artworks['name']; ?></td>
                                                <td>
                                                        <?= $artworks['status'] == '1' ? 'Oculto':'Visible'; ?>

                                                </td>
                                                <td><a href="artwork-edit.php?_id=<?= $artworks['_id']; ?>" class="btn btn-success">Editar</a></td>
                                                <td>

                                                    <form action="code.php" method="POST">
                                                        <button type="submit" name="artwork_delete" value="<?=$artworks['_id'];?>" onclick="return confirmacion()" class="btn btn-danger">Eliminar</button>
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

<script>

    function confirmacion(){
        return confirm("Realmetne desea borrar el registro?")
    }

</script>


<?php

    include('includes/footer.php');
    include('includes/scripts.php');

?>
