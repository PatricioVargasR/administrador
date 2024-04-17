<?php

    include('authentication.php');

    if (isset($_POST['iot_delete'])){

        $dispositivo_id = $_POST['iot_delete'];

        $endpoint_eliminar_dispositivo = "https://apiadministrador-757cf479b30b.herokuapp.com/eliminar_dispositivo/$dispositivo_id";

        $ch = curl_init($endpoint_eliminar_dispositivo);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

        $response = curl_exec($ch);

        curl_close($ch);


        if($response){

            $_SESSION['message'] = "Se ha borrado con éxito";
            header('Location: iot-view.php');
            exit(0);

        } else {

            $_SESSION['message'] = "Algo ha salido mal";
            header('Location: iot-view.php');
            exit(0);
        }
    }

    if(isset($_POST['iot_update'])){

        $dispositivo_id = $_POST['dispositivo_id'];

        $obra_asociada = $_POST['obra_asociada'];
        $estado = $_POST['status'] == true ? '1' : '0';
        $idiomas = $_POST['idioma'];
        $textos = $_POST['texto'];

        $idiomaTextoArray = [];

        if(count($idiomas) == count($textos)){

            for ($i = 0; $i < count($idiomas); $i++){
                $idiomaTextoArray[$idiomas[$i]] = $textos[$i];
            }

        }

        $endpoint_insertar_dispositivo = "https://apiadministrador-757cf479b30b.herokuapp.com/actualizar_dispositivo/$dispositivo_id";

        $data = array(
            'obra_asociada' => $obra_asociada,
            'estado' => $estado,
            'texto_pantalla' => $idiomaTextoArray
        );

        $ch = curl_init($endpoint_insertar_dispositivo);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);

        curl_close($ch);

        if($response){
            $_SESSION['message'] = "Se ha actualizado con éxito";
            header('Location: iot-edit.php?_id='.$dispositivo_id);
            exit(0);
        } else {
            $_SESSION['message'] = "Ocurrió algún error";
            header('Location: iot-add.php?_id='.$dispositivo_id);
            exit(0);
        }

    }

    if(isset($_POST['iot_add'])){

        $obra_asociada = $_POST['obra_asociada'];
        $estado = $_POST['status'] == true ? '1' : '0';
        $idiomas = $_POST['idioma'];
        $textos = $_POST['texto'];

        $idiomaTextoArray = [];

        if(count($idiomas) == count($textos)){

            for ($i = 0; $i < count($idiomas); $i++){
                $idiomaTextoArray[$idiomas[$i]] = $textos[$i];
            }

        }

        $endpoint_insertar_dispositivo = "https://apiadministrador-757cf479b30b.herokuapp.com/agregar_dispositivo";

        $data = array(
            'obra_asociada' => $obra_asociada,
            'estado' => $estado,
            'texto_pantalla' => $idiomaTextoArray
        );

        $ch = curl_init($endpoint_insertar_dispositivo);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close($ch);

        if($response){
            $_SESSION['message'] = "Se ha agregado con éxito";
            header('Location: iot-view.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Ocurrió algún error";
            header('Location: iot-add.php');
            exit(0);
        }

    }

    if(isset($_POST['artwork_delete'])){

        $artwork_id = $_POST['artwork_delete'];

        $endpoint_eliminar_artwork = "https://apiadministrador-757cf479b30b.herokuapp.com/eliminar_imagen/$artwork_id";

        $ch = curl_init($endpoint_eliminar_artwork);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

        $response = curl_exec($ch);

        curl_close($ch);

        if($response) {

            $_SESSION['message'] = "Se ha borrado con éxito";
            header('Location: artwork-view.php');
            exit(0);

        } else {

            $_SESSION['message'] = "Algo a salido mal";
            header('Location: artwork-view.php');
            exit(0);

        }


    }

    if(isset($_POST['artwork-update'])){

        $artwork_id = $_POST['artwork_id'];

        $name = $_POST['name'];

        $image = $_FILES['image']['tmp_name'];

        $filename = $_FILES['image']['name'];
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        $status = $_POST['status'] == true ? '1' : '0';

        if($image != NULL){

            $endpoint_actualizar = "https://apiadministrador-757cf479b30b.herokuapp.com/actualizar_imagen_nueva/" . urlencode($artwork_id) . "?nombre=" . urlencode($name) . "&estado=" . urlencode($status);
            $curl = curl_init($endpoint_actualizar);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($curl, CURLOPT_POSTFIELDS, array(
                'file' => new CURLFile($image, "image/$extension", 'file')
            ));
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'accept: application/json'
            ));

            // Ejecutar la solicitud y obtener la respuesta
            $response = curl_exec($curl);

            // Cerrar la conexión cURL
            curl_close($curl);

            if($response){

                $_SESSION['message'] = "Se actulizó correctamente";
                header('Location: artwork-view.php');
                exit(0);
            } else {

                $_SESSION['message'] = "Ocurrió algún error";
                header('Location: artwork-edit.php');
                exit(0);
            }

        } else {
            $endpoint_actualizar = "https://apiadministrador-757cf479b30b.herokuapp.com/actualizar_imagen/" . urlencode($artwork_id) . "?nombre=" . urlencode($name) . "&estado=" . urlencode($status);

            $curl = curl_init($endpoint_actualizar);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");

            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'accept: application/json'
            ));

            // Ejecutar la solicitud y obtener la respuesta
            $response = curl_exec($curl);

            // Cerrar la conexión cURL
            curl_close($curl);

            if($response){

                $_SESSION['message'] = "Se actulizó correctamente";
                header('Location: artwork-view.php');
                exit(0);
            } else {

                $_SESSION['message'] = "Ocurrió algún error";
                header('Location: artwork-edit.php');
                exit(0);
            }

        }


    }


    if(isset($_POST['artwork-add'])){

        $name = $_POST['name'];

        $image = $_FILES['image']['tmp_name'];

        $filename = $_FILES['image']['name'];
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        $status = $_POST['status'] == true ? '1' : '0';

        // URL de destino con parámetros en la URL
        $url = "https://apiadministrador-757cf479b30b.herokuapp.com/crear_imagenes?nombre=$name&estado=$status";

        // Configuración de la solicitud cURL
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, array(
            'file' => new CURLFile($image, "image/$extension", 'file')
        ));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'accept: application/json'
        ));

        // Ejecutar la solicitud y obtener la respuesta
        $response = curl_exec($curl);

        // Cerrar la conexión cURL
        curl_close($curl);

        if($response){

            $_SESSION['message'] = "Se ha agregado con exito";
            header('Location: artwork-view.php');
            exit(0);

        } else {

            $_SESSION['message'] = "Ocurrió algún error";
            header('Location: artwork-add.php');
            exit(0);

        }

    }


    if(isset($_POST['curiosity_update'])){

        $curiosity_id = $_POST['curiosity_id'];

        $description = $_POST['description'];

        $status = $_POST['status'] == true ? '1':'0';

        $endpoint_actualizar_curiosidad = "https://apiadministrador-757cf479b30b.herokuapp.com/actualizar_curiosidad/$curiosity_id";

        $data = array(
            "descripcion" => $description,
            "estado" => $status
        );

        $ch = curl_init($endpoint_actualizar_curiosidad);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);

        curl_close($ch);

        if($response){

            $_SESSION['message'] = "Se ha actualizado con exito";
            header('Location: view-curiosity.php');
            exit(0);

        } else {

            $_SESSION['message'] = "Ha ocurrido algo";
            header('Location: view-curiosity.php');
            exit(0);
        }
    }


    if(isset($_POST['efemeride_delete_btn'])){

        $efemeride_id = $_POST['efemeride_delete_btn'];

        $endpoint_eliminar_efemeride = "https://apiadministrador-757cf479b30b.herokuapp.com/eliminar_efemeride/$efemeride_id";

        $ch = curl_init($endpoint_eliminar_efemeride);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

        $response = curl_exec($ch);

        curl_close($ch);

        if($response){

            $_SESSION['message'] = "Se ha eliminado correctamente";
            header('Location: view-efemeride.php');
            exit(0);

        } else {

            $_SESSION['message'] = "Ha ocurrido algo";
            header('Location: view-efemeride.php');
            exit(0);
        }


    }

    if(isset($_POST['efemeride_update'])){

        $efemeride_id = $_POST['efemeride_id'];

        $name = $_POST['name'];

        $date = date('Y-m-d', strtotime($_POST['date']));

        $description = $_POST['description'];


        $status = $_POST['status'] == true ? '1':'0';

        $endpoint_actualizar_categoria = "https://apiadministrador-757cf479b30b.herokuapp.com/actualizar_efemeride/$efemeride_id";

        $data_categoria = array(
            "nombre" => $name,
            "fecha_efemeride" => $date,
            "descripcion" => $description,
            "estado" => $status,
        );

        $ch = curl_init($endpoint_actualizar_categoria);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data_categoria));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);

        curl_close($ch);


        if($response){

            $_SESSION['message'] = "Se ha actualizado con exito";
            header('Location: view-efemeride.php');
            exit(0);

        } else {

            $_SESSION['message'] = "Ha ocurrido algo";
            header('Location: efemeride-edit.php');
            exit(0);
        }
    }

    if(isset($_POST['efemeride_add'])){

        $name = $_POST['name'];

        $date = date('Y-m-d', strtotime($_POST['date']));

        $description = $_POST['description'];

        $status = $_POST['status'] == true ? '1' : '0';

        $endpoint_insertar_efemeride = "https://apiadministrador-757cf479b30b.herokuapp.com/crear_efemerides";

        $data = array(
            'nombre' => $name,
            'fecha_efemeride' => $date,
            'descripcion' => $description,
            'estado' => $status
        );

        $ch = curl_init($endpoint_insertar_efemeride);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close($ch);

        if($response){

            $_SESSION['message'] = "Se ha agregado con exito";
            header('Location: view-efemeride.php');
            exit(0);

        } else {

            $_SESSION['message'] = "Ha ocurrido algo";
            header('Location: efemeride-add.php');
            exit(0);
        }

    }

    if(isset($_POST['post_delete_btn'])){

        $post_id = $_POST['post_delete_btn'];

        $endpoint_eliminar_post= "https://apiadministrador-757cf479b30b.herokuapp.com/eliminar_post/$post_id";

        $ch = curl_init($endpoint_eliminar_post);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

        $response = curl_exec($ch);

        curl_close($ch);

        if($response){

            $_SESSION['message'] = "Se ha borrado con exito";
            header('Location: post-view.php');
            exit(0);

        } else {

            $_SESSION['message'] = "Algo a salido mal";
            header('Location: post-view.php?');
            exit(0);

        }

    }

    if(isset($_POST['post_update'])){

        $post_id = $_POST['post_id'];
        $category_id = $_POST['category_id'];

        $name = $_POST['name'];

        $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $_POST['slug']); // Remover los caracteres especiales
        $final_string = preg_replace('/-+/', '-', $string);
        $slug = $final_string;

        $description = $_POST['description'];

        $meta_title = $_POST['meta_title'];
        $meta_description = $_POST['meta_description'];

        $meta_keyword = $_POST['meta_keyword'];
        $keywords_array = preg_split('/[\s,]+/', $meta_keyword);

        $image = $_FILES['image']['tmp_name'];
        $filename = $_FILES['image']['name'];
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        $status =  $_POST['status'] == true ? '1':'0';

        if($image != NULL){

            $endpoint_insertar_post = "https://apiadministrador-757cf479b30b.herokuapp.com/actualizar_post_nuevaImagen/" . urlencode($post_id);

            // Construir el cuerpo de la solicitud
            $queryParams = array(
                'id_categoria' => $category_id,
                'nombre' => $name,
                'slug' => $slug,
                'descripcion' => $description,
                'meta_titulo' => $meta_title,
                'meta_descripcion' => $meta_description,
                'estado' => $status,
            );
            $endpoint_insertar_post .= '?' . http_build_query($queryParams);
            $curl = curl_init($endpoint_insertar_post);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($curl, CURLOPT_POSTFIELDS, array(
                'file' => new CURLFile($image, "image/$extension", 'file'),
                'meta_palabrasClaves' => implode(',', $keywords_array),
            ));
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'accept: application/json'
            ));
            // Ejecutar la solicitud y obtener la respuesta
            $response = curl_exec($curl);
            // Cerrar la conexión cURL
            curl_close($curl);
            if($response){
                $_SESSION['message'] = "Se ha agregado con exito";
                header('Location: post-view.php');
                exit(0);
            } else {
                $_SESSION['message'] = "Ocurrió algún error";
                header('Location: artwork-add.php');
                exit(0);
            }


        } else {

            $endpoint_actualizar_post = "https://apiadministrador-757cf479b30b.herokuapp.com/actualizar_post/$post_id";

            // Construir el cuerpo de la solicitud
            $data = array(
                'id_categoria' => $category_id,
                'nombre' => $name,
                'slug' => $slug,
                'descripcion' => $description,
                'meta_titulo' => $meta_title,
                'meta_descripcion' => $meta_description,
                'meta_palabrasClaves' => $keywords_array,
                'estado' => $status

            );

            $ch = curl_init($endpoint_actualizar_post);


            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

            // Ejecutar la solicitud y obtener la respuesta
            $response = curl_exec($ch);

            // Cerrar la conexión cURL
            curl_close($ch);

            if($response){
                $_SESSION['message'] = "Se ha agregado con exito";
                header('Location: post-view.php');
                exit(0);
            } else {
                $_SESSION['message'] = "Ocurrió algún error";
                header('Location: artwork-add.php');
                exit(0);
            }
        }


    }


    if(isset($_POST['post_add'])){

        $category_id = $_POST['category_id'];

        $name = $_POST['name'];

        $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $_POST['slug']); // Remover los caracteres especiales
        $final_string = preg_replace('/-+/', '-', $string);

        $slug = $final_string;

        $description = $_POST['description'];

        $meta_title = $_POST['meta_title'];
        $meta_description = $_POST['meta_description'];
        $meta_keyword = $_POST['meta_keyword'];

        $keywords_array = preg_split('/[\s,]+/', $meta_keyword);

        $image = $_FILES['image']['tmp_name'];

        $filename = $_FILES['image']['name'];
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        $status = $_POST['status'] == true ? '1': '0';

        $endpoint_buscar_slug = "https://apiadministrador-757cf479b30b.herokuapp.com/buscar_post_slug/$slug";

        $ch = curl_init($endpoint_buscar_slug);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = json_decode(curl_exec($ch));

        curl_close($ch);

        if (count($response) > 0){
            $_SESSION['message'] = "El slug ya está en uso";
            header('Location: post-add.php');
            exit(0);
        }

        $endpoint_insertar_post = "https://apiadministrador-757cf479b30b.herokuapp.com/crear_posts";

        // Construir el cuerpo de la solicitud
        $queryParams = array(
            'id_categoria' => $category_id,
            'nombre' => $name,
            'slug' => $slug,
            'descripcion' => $description,
            'meta_titulo' => $meta_title,
            'meta_descripcion' => $meta_description,
            'estado' => $status,

        );

        $endpoint_insertar_post .= '?' . http_build_query($queryParams);

        $curl = curl_init($endpoint_insertar_post);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, array(
            'file' => new CURLFile($image, "image/$extension", 'file'),
            'meta_palabrasClaves' => implode(',', $keywords_array),
        ));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'accept: application/json'
        ));

        // Ejecutar la solicitud y obtener la respuesta
        $response = curl_exec($curl);

        // Cerrar la conexión cURL
        curl_close($curl);

        if($response){

            $_SESSION['message'] = "Se ha agregado con exito";
            header('Location: post-view.php');
            exit(0);

        } else {

            $_SESSION['message'] = "Ocurrió algún error";
            header('Location: artwork-add.php');
            exit(0);

        }

   }

   if(isset($_POST['category_delete'])){

       $category_id = $_POST['category_delete'];

       $endpoint_eliminar_categoria = "https://apiadministrador-757cf479b30b.herokuapp.com/eliminar_categorias/$category_id";

       $ch = curl_init($endpoint_eliminar_categoria);

       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

       $response = curl_exec($ch);

       curl_close($ch);


       if($response){

           $_SESSION['message'] = "Se ha borrado con exito";
           header('Location: category-view.php');
           exit(0);

       } else {

           $_SESSION['message'] = "Algo a salido mal";
           header('Location: category-view.php');
           exit(0);

       }
    }

    if(isset($_POST['category_update'])){

        $category_id = $_POST['category_id'];

        $name = $_POST['name'];

        $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $_POST['slug']); // Remover los caracteres especiales
        $final_string = preg_replace('/-+/', '-', $string);

        $slug = $final_string;

        $description = $_POST['description'];

        $meta_title = $_POST['meta_title'];
        $meta_description = $_POST['meta_description'];

        $meta_keyword = $_POST['meta_keyword'];
        $keywords_array = preg_split('/[\s,]+/', $meta_keyword);

        $navbar_status = $_POST['navbar_status'] == true ? '1': '0';
        $status = $_POST['status'] == true ? '1': '0';

        $endpoint_buscar_slug = "https://apiadministrador-757cf479b30b.herokuapp.com/buscar_categoria_slug/$slug";

        $ch = curl_init($endpoint_buscar_slug);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = json_decode(curl_exec($ch));

        curl_close($ch);

        if (count($response) > 0) {
            $_SESSION['message'] = "El slug ya está en uso";
            header('Location: category-edit.php?_id='.$category_id);
            exit(0);
        }

        $endpoint_actualizar_categoria = "https://apiadministrador-757cf479b30b.herokuapp.com/actualizar_categorias/$category_id";

        $data = array(
            "nombre" => $name,
            "slug" => $slug,
            "descripcion" => $description,
            "meta_titulo" => $meta_title,
            "meta_descripcion" => $meta_description,
            "meta_palabrasClave" => $keywords_array,
            "estado_navegacion" => $navbar_status,
            "estado" => $status
        );

        $ch = curl_init($endpoint_actualizar_categoria);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);

        curl_close($ch);

        if($response){

            $_SESSION['message'] = "Actualizado con éxito";
            header('Location: category-edit.php?_id='.$category_id);
            exit(0);

        } else {

            $_SESSION['message'] = "Ocurrió algún error";
            header('Location: category-edit.php?_id='.$category_id);
            exit(0);

        }

    }

    if(isset($_POST['category_add'])){

        $name = $_POST['name'];

        $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $_POST['slug']); // Remover los caracteres especiales
        $final_string = preg_replace('/-+/', '-', $string);
        $slug = $final_string;

        $description = $_POST['description'];

        $meta_title = $_POST['meta_title'];
        $meta_description = $_POST['meta_description'];

        $meta_keyword = $_POST['meta_keyword'];
        $keywords_array = preg_split('/[\s,]+/', $meta_keyword);

        $navbar_status = $_POST['navbar_status'] == true ? '1': '0';
        $status = $_POST['status'] == true ? '1': '0';

        $endpoint_buscar_slug = "https://apiadministrador-757cf479b30b.herokuapp.com/buscar_categoria_slug/$slug";

        $ch = curl_init($endpoint_buscar_slug);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = json_decode(curl_exec($ch));

        curl_close($ch);

        if (count($response) > 0) {
            $_SESSION['message'] = "El slug ya está en uso";
            header('Location: category-add.php');
            exit(0);
        }

        $endpoint_insertar_categoria= "https://apiadministrador-757cf479b30b.herokuapp.com/crear_categorias";

        $data = array(
            'nombre'=> $name,
            'slug' => $slug,
            'descripcion' => $description,
            'meta_titulo' => $meta_title,
            'meta_descripcion' => $meta_description,
            'meta_palabrasClave' => $keywords_array,
            'estado_navegacion' => $navbar_status,
            'estado' => $status,
        );

        $ch = curl_init($endpoint_insertar_categoria);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close($ch);

        if($response){

            $_SESSION['message'] = "Se ha agregado con exito";
            header('Location: category-add.php');
            exit(0);

        } else {

            $_SESSION['message'] = "Ocurrió algún error";
            header('Location: category-add.php');
            exit(0);

        }

    }



