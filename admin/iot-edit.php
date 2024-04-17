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

                            <div style="margin-top: 10px;">
                                <h7>Texto en pantalla</h7>
                                <hr>
                            </div>
                            <div class="col-md-10 mb-2">

                                <div style="width:75%; display: flex; flex-direction: row; justify-content: space-between; align-items: last baseline;">
                                    <div id="entradas" style="flex: 2; display: flex; flex-direction: column; justify-content: space-between;">
                                        <div id="datos" style="display: flex; flex-direction: column;">
                                            <?php
                                                    $asociativo = array_keys($dispositivo['texto_pantalla']);
                                                    $contador = 0;
                                                    foreach($dispositivo['texto_pantalla'] as $texto){
                                                ?>

                                            <div style=" display: flex; flex-direction: row; justify-content: space-between; margin-bottom: 10px;">
                                                <div style=" display: flex; flex-direction: column;">
                                                    <label for="idioma1" style="margin-bottom: 5px">Idioma:</label>
                                                    <input type="text" id="idioma1" name="idioma[]" value = "<?= $asociativo[$contador]; ?>">
                                                </div>
                                                <div style=" display: flex; flex-direction: column;">
                                                    <label for="texto1" style="margin-bottom: 5px">Texto:</label>
                                                    <input type="text" id="texto1" name="texto[]" value = "<?= $texto ?>">
                                                </div>
                                            </div>
                                                <?php
                                                $contador++;
                                                }
                                            ?>
                                        </div>
                                    </div>

                                    <div style="flex: 1; display: flex; flex-direction: row; justify-content: start;">
                                        <button type="button" onclick="agregarInput()" style="margin: 20px">+</button>
                                        <button type="button" onclick="quitarInput()" style="margin: 20px">-</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Desactivar</label> </br>
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


<script>
        function agregarInput() {
          // Obtener el contenedor de inputs
          var container = document.getElementById("datos");

          // Crear un nuevo div para el nuevo input
          var newDiv = document.createElement("div");
          newDiv.style.display = "flex";
          newDiv.style.flexDirection = "row";
          newDiv.style.justifyContent = "space-between";
          newDiv.style.marginBottom = '10px';

          // Crear el div para el idioma
          var idiomaDiv = document.createElement("div");
          idiomaDiv.style.display = "flex";
          idiomaDiv.style.flexDirection = "column";

          // Crear el label y el input para el idioma
          var idiomaLabel = document.createElement("label");
          idiomaLabel.innerHTML = "Idioma " + (container.childElementCount + 1) + ":";
          idiomaLabel.style.marginBottom = '5px';

          var idiomaInput = document.createElement("input");
          idiomaInput.type = "text";
          //idiomaInput.name = "idioma" + (container.childElementCount + 1);
          idiomaInput.name = "idioma[]"

          // Añadir el label y el input al div del idioma
          idiomaDiv.appendChild(idiomaLabel);
          idiomaDiv.appendChild(idiomaInput);

          // Crear el div para el texto
          var textoDiv = document.createElement("div");
          textoDiv.style.display = "flex";
          textoDiv.style.flexDirection = "column";

          // Crear el label y el input para el texto
          var textoLabel = document.createElement("label");
          textoLabel.innerHTML = "Texto " + (container.childElementCount + 1) + ":";
          textoLabel.style.marginBotton = "5px";

          var textoInput = document.createElement("input");
          textoInput.type = "text";
          //textoInput.name = "texto" + (container.childElementCount + 1);
          textoInput.name = "texto[]";

          // Añadir el label y el input al div del texto
          textoDiv.appendChild(textoLabel);
          textoDiv.appendChild(textoInput);

          // Agregar los divs de idioma y texto al nuevo div
          newDiv.appendChild(idiomaDiv);
          newDiv.appendChild(textoDiv);

          // Agregar el nuevo div al contenedor
          container.appendChild(newDiv);
        }

        function quitarInput() {
          // Obtener el contenedor de inputs
          var container = document.getElementById("datos");

          // Verificar que hay al menos un input antes de eliminar
          if (container.childElementCount > 1) {
            // Obtener el último div de inputs
            var lastDiv = container.lastElementChild;
            container.removeChild(lastDiv);
          }
        }
    </script>
<?php

    include('includes/footer.php');
    include('includes/scripts.php');

?>
