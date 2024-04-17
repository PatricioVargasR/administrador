<?php

    session_start();


    if(!isset($_SESSION['auth'])){

        $_SESSION['message'] = 'Necesitas una autenticación';
        header('Location: ../index.php');
        exit(0);

    } else {

        // if($_SESSION['auth_role'] != "1"){ 
            if($_SESSION['auth_role'] != '1' && $_SESSION['auth_role'] != '2'){
            $_SESSION['message'] = "No estás autorizado para esto'";
            header('Location: ../index.php');
            exit(0);

        }

    }
