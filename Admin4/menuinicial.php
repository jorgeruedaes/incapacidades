<?php
session_start();
global $ubicacion;
require($ubicacion.'php/principal.php');
require($ubicacion.'php/usuario.php');
if(!isset($_SESSION['id_usuarios']))
{
 $ruta = $ubicacion.'error.php';
 header("location:$ruta");
}
$usuario = Array_Get_Usuario($_SESSION['id_usuarios']);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <base  href="<?php echo base_url();?>"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo String_Get_Valores('titulo');?></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Google fonts - Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="css/custom.css">
  <!-- Favicon-->
  <link rel="icon" href="<?php echo String_Get_Valores('favicon');?>" type="image/x-icon">

  <!-- Font Awesome CDN-->
  <!-- you can replace it by local Font Awesome-->
  <script src="https://use.fontawesome.com/99347ac47f.js"></script>
  <!-- Font Icons CSS-->
  <link rel="stylesheet" href="https://file.myfontastic.com/da58YPMQ7U5HY8Rb6UxkNf/icons.css">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
      </head>
      <body>
        

        <!-- Javascript files-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="js/tether.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.cookie.js"> </script>
        <script src="js/jquery.validate.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
        <script src="js/charts-home.js"></script>
        <script src="js/front.js"></script>
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID.-->
        <!---->
        <script>
          (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
          e=o.createElement(i);r=o.getElementsByTagName(i)[0];
          e.src='//www.google-analytics.com/analytics.js';
          r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
          ga('create','UA-XXXXX-X');ga('send','pageview');
        </script>
      </body>
      </html>