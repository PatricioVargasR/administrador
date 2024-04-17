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
                    <h4> Ver Post
                        <a href="post-add.php" class="btn btn-primary float-end">Nueva Publicación</a>
                    </h4>

                </div>
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>Identificador</th>
                            <th>Nombre</th>
                            <th>Categoria</th>
                            <th>Imagen</th>
                            <th>Estado</th>
                            <th>Editar</th>
                            <th>Eliminar</th>

                        </thead>
                        <tbody>
                        <!-- Extraemos los datos de la base de datos  -->
                            <?php

                                $endpoint = "https://apiadministrador-757cf479b30b.herokuapp.com/posts";

                                $ch = curl_init($endpoint);

                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                                $response = json_decode(curl_exec($ch), true);

                                curl_close($ch);

                                if (count($response) > 0 ) {
                                    foreach($response as $post){
                                        ?>

                                            <tr>
                                                <td><?= $post['_id']; ?></td>
                                                <td><?= $post['name']; ?></td>
                                                <?php
                                                    $categorias = $post['category_id'];

                                                    $endpoint_categorias = "https://apiadministrador-757cf479b30b.herokuapp.com/buscar_categoria/$categorias";


                                                    $ch_categorias = curl_init($endpoint_categorias);

                                                    curl_setopt($ch_categorias, CURLOPT_RETURNTRANSFER, true);
                                                    $response_categorias = json_decode(curl_exec($ch_categorias), true);


                                                    curl_close($ch_categorias);


                                                    if(count($response_categorias) > 0 ) {

                                                    foreach($response_categorias as $categories){
                                                        ?>
                                                        <td><?= $categories['name']; ?></td>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <td> <img src="data:image/*;base64,<?= $post['image']; ?>" alt="<?=$postItem['name'];?>" width="60px" height="60px"></td>
                                                <td>

                                                        <?= $post['status'] == '1' ? 'Oculto':'Visible';
                                                    ?>


                                                </td>
                                                <td><a href="post-edit.php?_id=<?= $post['_id']; ?>" class="btn btn-success">Editar</a></td>
                                                <td>

                                                    <form action="code.php" method="POST">
                                                        <button type="submit" name="post_delete_btn" value="<?=$post['_id'];?>" class="btn btn-danger">Eliminar</button>
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
