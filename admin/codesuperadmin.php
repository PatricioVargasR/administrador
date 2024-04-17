    <?php

        include('authentication.php');
        include('middleware/superadminAuth.php');


        if(isset($_POST['users_delete'])){
            $user_id = $_POST['users_delete'];

            $endpoint_eliminar_emails= "https://apisuperadministrador-5b08c9c6f028.herokuapp.com/eliminar_email/$user_id";

            $ch = curl_init($endpoint_eliminar_emails);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

            $response = curl_exec($ch);
            curl_close($ch);
            if($response){

                $_SESSION['message'] = "Se ha borrado con exito";
                header('Location: view-visitas.php');
                exit(0);

            } else {

                $_SESSION['message'] = "Algo a salido mal";
                header('Location: view-visitas.php');
                exit(0);

            }
        }

    if(isset($_POST['send_correo'])){

        $asunto = $_POST['asunto'];
        $descripcion = $_POST['description'];

        if (!empty($asunto) && !empty($descripcion)) {

            $endpoint_buscar_destinarios = "https://apisuperadministrador-5b08c9c6f028.herokuapp.com/emails";

            $ch = curl_init($endpoint_buscar_destinarios);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = json_decode(curl_exec($ch), true);


            curl_close($ch);

            if(count($response) > 0){

                $endpoint_enviar_email = "https://apisuperadministrador-5b08c9c6f028.herokuapp.com/enviar_email";

                $data = array(
                    'titulo' => $asunto,
                    'contenido' => $descripcion
                );

                $curl = curl_init($endpoint_enviar_email);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                $response = curl_exec($curl);

                curl_close($ch);

                if ($response) {
                    $_SESSION['message'] = "Se ha enviado con éxito";
                    header('Location: view-email.php');
                    exit(0);
                } else {
                    $_SESSION['message'] = "Ocurrió un error al enviar";
                    header('Location: send-email.php');
                    exit(0);
                }

            } else {
                $_SESSION['message'] = "No se encontraron datos";
                header('Location: view-email.php');
                exit(0);
            }

        } else {
            $_SESSION['message'] = "Faltan datos";
            header('Location: send-email.php');
            exit(0);
        }

    }

    if(isset($_POST['update_user_block'])){

        $user_id = $_POST['user_id'];

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];

        $email = $_POST['email'];
        $password = $_POST['password'];

        // $password = md5($password);

        $role = $_POST['role'];
        $status = $_POST['status'] == true ? '1':'0';

        if($password != NULL) {
            $endpoint_actualizar_usuario = "https://apisuperadministrador-5b08c9c6f028.herokuapp.com/actualizar_usuario_contra/$user_id";

            $data = array(
                'nombres' => $fname,
                'apellidos' => $lname,
                'email' => $email,
                'contraseña' => $password,
                'rol' => $role,
                'estado' => $status
            );

            $ch = curl_init($endpoint_actualizar_usuario);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            $response = curl_exec($ch);
            curl_close($ch);
            if($response){
                $_SESSION['message'] = "Actualizado con exito";
                header('Location: view-block.php');
                exit(0);
            } else {
                $_SESSION['message'] = "Ocurrió un error";
                header('Location: block-edit.php');
                exit(0);
            }

        } else {
            $endpoint_actualizar_usuario = "https://apisuperadministrador-5b08c9c6f028.herokuapp.com/actualizar_usuario/$user_id";

            $data = array(
                'nombres' => $fname,
                'apellidos' => $lname,
                'email' => $email,
                'rol' => $role,
                'estado' => $status
            );
            $ch = curl_init($endpoint_actualizar_usuario);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            $response = curl_exec($ch);
            curl_close($ch);
            if($response){
                $_SESSION['message'] = "Actualizado con exito";
                header('Location: view-block.php');
                exit(0);
            } else {
                $_SESSION['message'] = "Ocurrió un error";
                header('Location: block-edit.php');
                exit(0);
            }
        }
    }

    if(isset($_POST['user_delete_block'])){

        $user_id = $_POST['user_delete_block'];


        $endpoint_eliminar_usuario = "https://apisuperadministrador-5b08c9c6f028.herokuapp.com/eliminar_usuario/$user_id";

        $ch = curl_init($endpoint_eliminar_usuario);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

        $response = curl_exec($ch);
        curl_close($ch);
        if($response){

            $_SESSION['message'] = "Se ha borrado con exito";
            header('Location: view-block.php');
            exit(0);

        } else {

            $_SESSION['message'] = "Algo a salido mal";
            header('Location: view-block.php');
            exit(0);

        }
    }

        if(isset($_POST['user_delete'])){

            $user_id = $_POST['user_delete'];


            $endpoint_eliminar_usuario = "https://apisuperadministrador-5b08c9c6f028.herokuapp.com/eliminar_usuario/$user_id";

            $ch = curl_init($endpoint_eliminar_usuario);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

            $response = curl_exec($ch);
            curl_close($ch);
            if($response){

                $_SESSION['message'] = "Se ha borrado con exito";
                header('Location: view-register.php');
                exit(0);

            } else {

                $_SESSION['message'] = "Algo a salido mal";
                header('Location: view-register.php');
                exit(0);

            }
        }



        if(isset($_POST['update_user'])){

            $user_id = $_POST['user_id'];

            $fname = $_POST['fname'];
            $lname = $_POST['lname'];

            $email = $_POST['email'];
            $password = $_POST['password'];

            // $password = md5($password);

            $role = $_POST['role'];
            $status = $_POST['status'] == true ? '1':'0';

            if($password != NULL) {
                $endpoint_actualizar_usuario = "https://apisuperadministrador-5b08c9c6f028.herokuapp.com/actualizar_usuario_contra/$user_id";

                $data = array(
                    'nombres' => $fname,
                    'apellidos' => $lname,
                    'email' => $email,
                    'contraseña' => $password,
                    'rol' => $role,
                    'estado' => $status
                );

                $ch = curl_init($endpoint_actualizar_usuario);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                $response = curl_exec($ch);
                curl_close($ch);
                if($response){
                    $_SESSION['message'] = "Actualizado con exito";
                    header('Location: view-register.php');
                    exit(0);
                } else {
                    $_SESSION['message'] = "Ocurrió un error";
                    header('Location: register-edit.php');
                    exit(0);
                }

            } else {
                $endpoint_actualizar_usuario = "https://apisuperadministrador-5b08c9c6f028.herokuapp.com/actualizar_usuario/$user_id";

                $data = array(
                    'nombres' => $fname,
                    'apellidos' => $lname,
                    'email' => $email,
                    'rol' => $role,
                    'estado' => $status
                );
                $ch = curl_init($endpoint_actualizar_usuario);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                $response = curl_exec($ch);
                curl_close($ch);
                if($response){
                    $_SESSION['message'] = "Actualizado con exito";
                    header('Location: view-register.php');
                    exit(0);
                } else {
                    $_SESSION['message'] = "Ocurrió un error";
                    header('Location: register-edit.php');
                    exit(0);
                }
            }



        }

        if(isset($_POST['add_user'])){

            $fname = $_POST['fname'];
            $lname = $_POST['lname'];

            $email = $_POST['email'];

            $password = $_POST['password'];
            //$password = md5($password);

            $role = $_POST['role'];
            $status = $_POST['status'] == true ? '1':'0';

            $endpoint_crear_usuario = "https://apisuperadministrador-5b08c9c6f028.herokuapp.com/crear_usuario";

            $data = array(
                'nombres' => $fname,
                'apellidos' => $lname,
                'email' => $email,
                'contraseña' => $password,
                'rol' => $role,
                'estado' => $status,
            );

            $ch = curl_init($endpoint_crear_usuario);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);

            curl_close($ch);

            if($response){

                $_SESSION['message'] = "Nuevo usuario agregado con exito";
                header('Location: view-register.php');
                exit(0);

            } else {

                $_SESSION['message'] = "Algo a salido mal";
                header('Location: register-add.php');
                exit(0);

            }

        }

    ?>