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
                    <h4> Ver Categoria
                        <a href="category-add.php" class="btn btn-primary float-end">Agregar Categoia</a>
                    </h4>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                        <table class="table table-bordered table-stripe">
                            <thead>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Estado</th>
                                <th>Editar</th>
                                <th>Eliminar</th>

                            </thead>
                            <tbody>
                            <!-- Extraemos los datos de la base de datos  -->
                                <?php

                                    $endpoint = "https://apiadministrador-757cf479b30b.herokuapp.com/categorias";

                                    $ch = curl_init($endpoint);
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                                    $response = json_decode(curl_exec($ch), true);

                                    curl_close($ch);

                                    if (count($response) > 0) {

                                        foreach($response as $item){
                                            ?>

                                                <tr>
                                                    <td><?= $item['_id']; ?></td>
                                                    <td><?= $item['name']; ?></td>
                                                    <td>

                                                         <?= $item['status'] == '1' ? 'Oculto':'Visible';
                                                        ?>

                                                    </td>
                                                    <td><a href="category-edit.php?_id=<?= $item['_id']; ?>" class="btn btn-success">Editar</a></td>
                                                    <td>
                                                        <form action="code.php" method="POST">

                                                            <button type="submit" name="category_delete" value="<?=$item['_id'];?>" onclick='return confirmar()' class="btn btn-danger">Eliminar</button>

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
    function confirmar(){
        return confirm("Desea eliminar la categoría?")
    }
</script>


<?php

    include('includes/footer.php');
    include('includes/scripts.php');

?>
