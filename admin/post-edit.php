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
                    <h4> Modificar publicación
                        <a href="post-view.php" class="btn btn-danger float-end">Regresar</a>
                    </h4>
                </div>
                <div class="card-body">

                <?php

                    if(isset($_GET['_id'])){

                        $post_id = $_GET['_id'];

                        $endpoint_actualizar = "https://apiadministrador-757cf479b30b.herokuapp.com/buscar_post/$post_id";

                        $ch = curl_init($endpoint_actualizar);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                        $response = json_decode(curl_exec($ch), true);


                        curl_close($ch);

                        if(count($response) > 0){

                            $post_row = $response;


                ?>
                    <form action="code.php" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="post_id" value="<?= $post_row[0]['_id']?>">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="">Categorias</label>

                                <?php

                                    if(isset($_GET['_id'])){

                                        $category_id = $_GET['_id'];

                                        $endpoint_actualizar = "https://apiadministrador-757cf479b30b.herokuapp.com/categorias";

                                        $ch = curl_init($endpoint_actualizar);
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
                                                        <option value="<?=$categoryitem['_id'] ?>" <?=$categoryitem['_id'] == $post_row[0]['category_id'] ? 'selected':'' ?>>
                                                            <?= $categoryitem['name']?>
                                                        </option>
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
                                <input type="text" name="name" value="<?= $post_row[0]['name']; ?>" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Identificador en la URL </label>
                                <input type="text" name="slug" value="<?= $post_row[0]['slug']; ?>" class="form-control" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="">Descripción</label>
                                <textarea name="description" id="summernote" class="form-control" rows="4" required><?= $post_row[0]['description']; ?></textarea>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="">Título resumen</label>
                                <input type="text" name="meta_title" value="<?= $post_row[0]['meta_title']; ?>" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Descripción resumen</label>
                                <textarea name="meta_description" class="form-control" rows="4" required><?= $post_row[0]['meta_description']; ?></textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Palabras clave</label>
                                <textarea name="meta_keyword" class="form-control" rows="4"><?= implode(', ', $post_row[0]['meta_keyword']); ?></textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Imagen </label>
                                <input type="hidden" name="old_image" value="data:image/jpeg;base64,<?= $post_row[0]['image']; ?>">
                                <input accept="image/*" type="file" name="image" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Ocultar</label> </br>
                                <input type="checkbox" name="status"  <?= $post_row[0]['status'] == '1' ? 'checked' : '' ?>   class="form-check-input">
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" name="post_update"class="btn btn-primary">Actualizar</button>
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
