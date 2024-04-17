# Proyecto_Integrador_I
En este respositorio se almacena el módulo de usuario del proyecto integrador realizado en tercer cuatrimestre
siendo nuevamente retomado en el presente quinto cuatrimestre

## Colaboradores
* Desarrollador: [Janneth Santos](https://github.com/jannethsm31)
* Desarrollador: [Jose David](https://github.com/JoseDavidEsquivel)

# Instalación

* ## Descarga
Clona este repositorio en la carpeta htdocs para poder ser visualizado en el empaquetador de aplicaciones
XAMPP utilizando Apache como servidor.
```
https://github.com/PatricioVargasR/administrador.git
```

* ## Configuración de los archivos
Una vez descargado, verifica el que el nombre de la carpeta es *usuario*, esto para evitar conflictos con el archivo *config.php* ubicado
en la ruta *administrador/includes/config/* puesto a que este archivo se encarga de colocar una URL base en ciertos elementos, si deseas modificar esto, basta con modificar la siguiente línea del archivo:
```php
<?php

    function base_url($slug){
        // Línea a modificar, puedes cambiar después cambiar el nombre de "administrador" acorde al nombre de tu carpeta
        echo 'http://localhost/administrador/'.$slug;
    }
?>

```

* ## Configuración de la base de datos
Este proyecto utiliza una base de datos para almacenar desde las publicaciones de la página así como los usuarios administrados, actualmente funciona utilizando API's utilizando el servicio
de Heroku, en este caso al no estar basado en MVC, se debe cambiar cada URL


* ## Configuración de usuarios
Como se mencionó anteriormente, este proyecto consiste de dos partes principales, usuarios y administradores, en caso de querer acceder al dashboard de administrador, puedes redireccionarte a el utilizando la siguiente ruta en tu navegador *http://localhost/dash/login.php*, donde ingresarás las credenciales correspondientes, como se puede ver a continuación.
El sistema actualmente cuenta con tres grados de niveles, usuario, administrador y superadministrador, a continuación se presentan las credenciales almacenadas en la base de datos:
```sql
-- Administrador:
-- usuario: janneth@gmail.com
-- contraseña: janneth

-- Superadministrador:
-- usuario: varrapa25@gmail.com
-- contraseña: patricio
```
Si dedeas agregar un nuevo usuario puedes hacerlo desde el menú que te ofrece el módulo de superadministrador o dirigiendote a la url: *http://localhost/administrador/register.php*
_
Con las configuraciones anteriormente puestas, el proyecto debería de funcionar sin problemas, en caso de surgir un incoveniente, reportarlo.

## Estructura del proyecto
```bash
├── 404.php
├── admin
│   ├── about-email.php
│   ├── artwork-add.php
│   ├── artwork-edit.php
│   ├── artwork-view.php
│   ├── assets
│   │   ├── demo
│   │   │   ├── chart-area-demo.js
│   │   │   ├── chart-bar-demo.js
│   │   │   ├── chart-pie-demo.js
│   │   │   └── datatables-demo.js
│   │   └── img
│   │       └── error-404-monochrome.svg
│   ├── authentication.php
│   ├── block-edit.php
│   ├── category-add.php
│   ├── category-edit.php
│   ├── category-view.php
│   ├── code.php
│   ├── codesuperadmin.php
│   ├── config
│   │   └── dbconn.php
│   ├── css
│   │   └── styles.css
│   ├── curiosity-edit.php
│   ├── efemeride-add.php
│   ├── efemeride-edit.php
│   ├── img
│   ├── includes
│   │   ├── footer.php
│   │   ├── header.php
│   │   ├── navbar-top.php
│   │   ├── scripts.php
│   │   └── sidebar.php
│   ├── index.php
│   ├── iot-add.php
│   ├── iot-edit.php
│   ├── iot-view.php
│   ├── js
│   │   ├── datatables-simple-demo.js
│   │   └── scripts.js
│   ├── message.php
│   ├── middleware
│   │   └── superadminAuth.php
│   ├── post-add.php
│   ├── post-edit.php
│   ├── post-view.php
│   ├── register-add.php
│   ├── register-edit.php
│   ├── send-email.php
│   ├── view-block.php
│   ├── view-curiosity.php
│   ├── view-efemeride.php
│   ├── view-email.php
│   ├── view-register.php
│   └── view-visitas.php
├── allcode.php
├── assets
│   ├── css
│   │   ├── bootstrap5.min.css
│   │   └── custom.css
│   ├── img
│   │   ├── 65054.jpg
│   │   └── logo.jpg
│   └── js
│       ├── bootstrap5.min.js
│       ├── jquery.min.js
│       └── scripts.js
├── errors
│   └── dberror.php
├── includes
│   ├── config.php
│   ├── footer.php
│   ├── header.php
│   └── navbar.php
├── index.php
├── logincode.php
├── message.php
├── registercode.php
└── register.php

17 directories, 65 files
```
