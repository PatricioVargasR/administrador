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
                    <h4> Agregar publicación
                        <a href="post-view.php" class="btn btn-danger float-end">Regresar</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="">Categorias</label>

                                <?php

                                    $endpoint = "https://apiadministrador-757cf479b30b.herokuapp.com/categorias";

                                    $ch = curl_init($endpoint);

                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                                    $response = json_decode(curl_exec($ch), true);

                                    curl_close($ch);

                                    if(count($response) > 0 ){

                                        ?>

                                        <select name="category_id" class="form-control" required>
                                            <option value="">--Selecciona una categoria--</option>
                                            <?php 

                                                foreach($response as $categoryitem){
                                                    ?>
                                                        <option value="<?=$categoryitem['_id'] ?>"> <?=$categoryitem['name'] ?> </option>
                                                    <?php
                                                }
                                            ?>
                                        </select>

                                        <?php

                                    } else {

                                        ?>
                                            <h5>Ninguna categoria disponible</h5>

                                        <?php
                                    }
                                ?>


                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Nombre</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for=""> Identificador en la URL </label>
                                <input type="text" name="slug" class="form-control" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="">Descripción</label>
                                <textarea name="description" id="summernote" class="form-control" rows="4" required></textarea>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="">Título resumen</label>
                                <input type="text" name="meta_title" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Descripción resumen</label>
                                <textarea name="meta_description" class="form-control" rows="4" required></textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Palabras Clave</label>
                                <textarea name="meta_keyword" class="form-control" rows="4" required></textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Imagen </label>
                                <input accept="image/*" type="file" name="image" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Ocultar</label> </br>

                                <input type="checkbox" name="status" class="form-check-input">
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" name="post_add"class="btn btn-primary">Guardar publicación</button>
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
