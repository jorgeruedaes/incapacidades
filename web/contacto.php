<?php
include('../menuinicial.php');
$id_modulos="35";
$ipvisitante=$_SERVER["REMOTE_ADDR"];
ContadorVisitas($ipvisitante,'contacto');
?>S
<div class="container">
		 <ol class="breadcrumb">
		  <li><a href="index.php">Inicio</a></li>
			<?php
			$vector = Array_Get_PadreHijo($id_modulos);
			foreach ($vector as $value)
				{?>
			<li>
				<a href="<?php echo $value['ruta'] ?>" class="active">
					<!--<i class="material-icons"><?php echo $value['icono'] ?></i>-->
					<?php echo $value['nombre'] ?>
				</a>
			</li>
			<?php
		}
		?>
		 </ol>
</div>
<!-- //header -->
<div class="contact">
	 <div class="container">
		 <div class="contact-grids">
			 <h2>CONTÁCTO</h2>
			 
			 <form method="post">
				<input type="text" placeholder="Nombre" name="usuario" required>
				<input type="text" type="email" placeholder="Email" name="email" required>
				<textarea placeholder="Mensaje..." name="comentario" required></textarea>
				<input type="submit" value="Enviar" name="enviar" >
			 </form>
		 </div>
	 </div>
</div>

<?php
// include('../footerinicial.php');
// if (isset($_POST['enviar'])) {

//     $usuario = $_POST['usuario'];
//     $valor = 5;
//     $comentario = $_POST['comentario'];
//     $email = $_POST['email'];
//     $query = mysqli_query($conexion,"INSERT INTO `te_comentarios`(`numero_comentario`, `nombre_usuario`, `contacto`, `valor`, `comentario`) 
//     VALUES('null','$usuario','$email','$valor','$comentario');");
//     if ($query === true) {
//         ?>
//         <script  type="text/javascript">

//             alert("La informacíon se ha guardado exitosamente.");

//         </script>
//         <?php
//     }
//     header("location:index.php");

?>

<?php
// Varios destinatarios
$para  = 'aidan@example.com' . ', '; // atención a la coma
$para .= 'wez@example.com';

// título
$título = 'Recordatorio de cumpleaños para Agosto';

// mensaje
$mensaje = '
<html>
<head>
  <title>Recordatorio de cumpleaños para Agosto</title>
</head>
<body>
  <p>¡Estos son los cumpleaños para Agosto!</p>
  <table>
    <tr>
      <th>Quien</th><th>Día</th><th>Mes</th><th>Año</th>
    </tr>
    <tr>
      <td>Joe</td><td>3</td><td>Agosto</td><td>1970</td>
    </tr>
    <tr>
      <td>Sally</td><td>17</td><td>Agosto</td><td>1973</td>
    </tr>
  </table>
</body>
</html>
';

// Para enviar un correo HTML, debe establecerse la cabecera Content-type
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Cabeceras adicionales
$cabeceras .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
$cabeceras .= 'From: Recordatorio <cumples@example.com>' . "\r\n";
$cabeceras .= 'Cc: birthdayarchive@example.com' . "\r\n";
$cabeceras .= 'Bcc: birthdaycheck@example.com' . "\r\n";

// Enviarlo
if(mail($para, $título, $mensaje, $cabeceras))
{
	echo "si";
}else
{
	echo "NO";
}
?>