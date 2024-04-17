<?php
    session_start();
    $endpoint = 'https://apisuperadministrador-5b08c9c6f028.herokuapp.com/crear_usuario';

    if (isset($_POST['register_btn'])) {

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['cpassword'];

        if ($password == $confirm_password) {

            // Verificamos el correo
            $endpoint_email = "https://apisuperadministrador-5b08c9c6f028.herokuapp.com/buscar_usuario_email/$email";

            $ch = curl_init($endpoint_email);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = json_decode(curl_exec($ch));

            curl_close($ch);


            if (count($response) > 0){
                $_SESSION['message'] = "Ya existe una cuenta con ese correo";
                header('Location: register.php');
                exit(0);
            }else {


                $data = array(
                    'nombres' => $fname,
                    'apellidos' => $lname,
                    'email' => $email,
                    'contraseña' => $password,
                    'rol' => 1,
                    'estado' => 0,
                );


                $ch = curl_init($endpoint);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                $response = curl_exec($ch);


                curl_close($ch);

                if($response) {

                    $_SESSION['message'] = " Registro con éxito ";
                    header('Location: index.php');
                    exit(0);

                } else {

                    $_SESSION['message'] = " Algo ha salido mal ";
                    header('Location: register.php');
                    exit(0);
                }

            }

        } else {

            $_SESSION['message'] = "Las contraseñas no coinciden";
            header("Location: register.php");
            exit(0);
        }


    } else {

        header('Location: register.php');
        exit(0);

    }
