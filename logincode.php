<?php

session_start();


 if (isset($_POST['login_btn'])) {

    $endpoint = 'https://apiautenticacion-fe46ba455665.herokuapp.com/validar_usuario/';

    $email =$_POST['email'];
    $password = $_POST['password'];

    // Create a stream
    $opts = array(
        'http' => array(
            'method' => "GET",
            'header' => "Authorization: Basic " . base64_encode("$email:$password")
        )
    );

    $context = stream_context_create($opts);

    // Open the file using the HTTP headers set above
    $result = file_get_contents($endpoint, false, $context);

    $data= json_decode($result);

    $length = count($data);

    if ($length > 0){

        $user_id = $data[0]->_id;
        $user_name = $data[0]->fname . ' ' . $data[0]->lname;
        $user_email = $data[0]->email;
        $role = $data[0]->role;

        $_SESSION['auth'] = true;
        $_SESSION['auth_role'] = "$role"; // 1 -> admin, 0 -> user, 2 -> super

        $_SESSION['auth_user'] = [
            'user_id'=>$user_id,
            'user_name'=> $user_name,
            'user_email'=>$user_email,
        ];

        if($_SESSION['auth_role'] == "1"){ // 1 = Admin

            $_SESSION['message'] = "Bienvenido a tu dashboard";
            header('Location: admin/index.php');
            exit(0);

        } elseif($_SESSION['auth_role'] == "2"){ // 2 = SuperAdmin
            $_SESSION['message'] = "Bienvenido a tu dashboard";
            header('Location: admin/index.php');
            exit(0);

        } elseif($_SESSION['auth_role'] == "0"){ // 0 = user
            $_SESSION['message'] = "Iniciaste sesión";
            header('Location: index.php');
            exit(0);
        } else {

            $_SESSION['message'] = "Ya has iniciado sesión";
            header('Location: index.php');
            exit(0);

        }
    } else {

        $_SESSION['message'] = "No tienes acceso";
        header('Location: index.php');
        exit(0);
    }

} else {
    $_SESSION['message'] = "No tienes acceso";
    header('Location: index.php');
    exit(0);
}

