//	var Creador = '<?php echo $usuario['id_incapacidades']; ?>'
$(function() {
	var t ='';
	var pagos = {
		inicio: function () {
			pagos.GetTotal();
			pagos.AddClicks();
		},		
		GetTotal: function()
		{
			var total = "";
			$('#tabla-detalle tr').find("td:nth-child(7)").each(function(indice, elemento) {

				    total += $(elemento).text();
				    $('#totalinc').text(total);

		    }); 
		},
		AddClicks: function()
		{
			$('.boton-volver').on("click", function(){

				 window.location.href = "pages/pagos/gestionar.php";

			});
		}
	};
	$(document).ready(function () {

		pagos.inicio();

	});

});