

<?php //Ejemplo aprenderaprogramar.com
$texto = file_get_contents("http://www.resultados-futbol.com/finalizacion_colombia2017/grupo1/calendario");
echo $texto;
?>
   
 
<script src="plugins/jquery/jquery.min.js"></script>

    <script>
	var goblal='';
	var cargador = {
		inicio: function () {
			cargador.recargar();
		},
		recargar: function () {
			cargador.Cargar();

		},
		Cargar : function()
		{
			alert($('.boxhome-2col').find('.titlebox').text());
		}
	};
	$(document).ready(function () {

		cargador.inicio();

	});

    </script>