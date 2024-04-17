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
                            <div class="col-md-15 mb-2">
                                <label for="">Obra asociada</label>
                                <input type="text" name="obra_asociada" class="form-control" required>
                            </div>
                            <div style="margin-top: 10px;">
                                <h7>Texto en pantalla</h7>
                                <hr>
                            </div>
                            <div class="col-md-10 mb-2">
                                <div style="width:75%; display: flex; flex-direction: row; justify-content: space-between; align-items: last baseline;">
                                    <div id="entradas" style="flex: 2; display: flex; flex-direction: column; justify-content: space-between;">
                                        <div id="datos" style="display: flex; flex-direction: column;">
                                            <div style=" display: flex; flex-direction: row; justify-content: space-between; margin-bottom: 10px;">
                                                <div style=" display: flex; flex-direction: column;">
                                                    <label for="idioma1" style="margin-bottom: 5px">Idioma:</label>
                                                    <input type="text" id="idioma1" name="idioma[]">
                                                </div>
                                                <div style=" display: flex; flex-direction: column;">
                                                    <label for="texto1" style="margin-bottom: 5px">Texto:</label>
                                                    <input type="text" id="texto1" name="texto[]">
                                                </div>
                                            </div>
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


  <div id="inputs-container">
    <div>

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
</body>
</html>
