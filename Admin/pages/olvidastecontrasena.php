<?php
require('../php/configuracion.php');
    session_start();
?>
    <!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Recuperar Contraseña |<?php echo String_Get_Valores('titulo') ?></title>
    <!-- Favicon-->
    <link rel="icon" href="../<?php echo String_Get_Valores('favicon') ?>" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="../css/google-fonts.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">
</head>

<body class="fp-page">
    <div class="fp-box">
        <div class="logo">
            <a href="javascript:void(0);">Módulo<b>Administrador</b></a>
            <small style="font-size: 1.1em"><?php echo String_Get_Valores('titulo') ?></small>
        </div>
        <div class="card">
            <div class="body">
                <form action="../php/peticiones.php" id="forgot_password" method="POST">
                	<div class="msg">
                        Ingresa el email con el cuál te registraste.
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" placeholder="Email" required autofocus>
                        </div>
                    </div>
                    <input type="hidden" value="recuperar" name="bandera" />
                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Enviar</button>

                    <div class="row m-t-20 m-b--5 align-center">
                    <a href="inicio.php">Volver</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="../plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <script src="../js/pages/examples/forgot-password.js"></script>
</body>
</html>