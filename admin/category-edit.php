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
                    <h4> Modificar Categoria
                        <a href="category-view.php" class="btn btn-danger float-end">Regresar</a>
                    </h4>
                </div>
                <div class="card-body">
                <?php

                    if(isset($_GET['_id'])){

                        $category_id = $_GET['_id'];

                        $endpoint_actualizar = "https://apiadministrador-757cf479b30b.herokuapp.com/buscar_categoria/$category_id";

                        $ch = curl_init($endpoint_actualizar);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                        $response = json_decode(curl_exec($ch), true);

                        curl_close($ch);

                        if (count($response) > 0){

                            //$category = mysqli_fetch_array($category_run)

                            foreach ($response as $category){

                ?>
                    <form action="code.php" method="POST">

                        <input type="hidden" name="category_id" value="<?= $category['_id']; ?>">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Nombre</label>
                                <input type="text" name="name" value="<?= $category['name']; ?>" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Identificador en la URL </label>
                                <input type="text" name="slug" value="<?= $category['slug']; ?>" class="form-control" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="">Descripción</label>
                                <textarea name="description" class="form-control" rows="4" required><?= $category['description']; ?></textarea>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="">Titulo resumen</label>
                                <input type="text" name="meta_title" value="<?= $category['meta_title']; ?>" class="form-control" >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Descripción resumen</label>
                                <textarea name="meta_description" class="form-control" rows="4"><?= $category['meta_description']; ?></textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Palabras clave</label>
                                <textarea name="meta_keyword" class="form-control" rows="4"><?= implode(', ', $category['meta_keywords']); ?></textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Desactivar en la barra de navegación</label> <br/>
                                <!-- <input type="checkbox" name="status" width="70px" height="70px" /> -->
                                <input type="checkbox" name="navbar_status" <?= $category['navbar_status'] == '1' ? 'checked' : '' ?> class="form-check-input">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Desactivar</label> </br>
                                <!-- <input type="checkbox" name="status" width="70px" height="70px" /> -->
                                <input type="checkbox" name="status"  <?= $category['status'] == '1' ? 'checked' : '' ?>  class="form-check-input">
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" name="category_update"class="btn btn-primary">Actualizar</button>
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
