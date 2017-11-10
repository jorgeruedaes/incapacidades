//	var Creador = '<?php echo $usuario['id_incapacidades']; ?>'
$(function() {
	var t ='';
	var pagos = {
		inicio: function () {
			pagos.AddClicks();
		},		
		AddClicks: function()
		{
			// $('.nuevo-pago').on("click", function(){

			// 	window.location = "/incapacidades/Admin/pages/pagos/nuevopago.php";


			// });
		}
};
$(document).ready(function () {

	pagos.inicio();

});

});