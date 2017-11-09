//	var Creador = '<?php echo $usuario['id_incapacidades']; ?>'
$(function() {
	var t ='';
	var pagos = {
		inicio: function () {
			pagos.AddClicks();
			pagos.Cargar();

		},		
		AddClicks: function()
		{
			$('.nuevo-pago').on("click", function(){

				$('.caja-nuevopago').show();
				$('.caja-listadopago').hide();

			});

			$('.go-back').on("click", function(){
				
				window.location.reload();
				
			});

			$('.boton-cancelar').on("click", function(){
				
				window.location.reload();
				
			});

			$('.payment-value').on("change", function(){
				
				 var value = $(this).val();
				 $('.payment-value-2').text(value);
				 var difference = $(this).val() - $('.payment-total-value').text();
				 $('.payment-difference').text(difference);
				
			});
		},
		Cargar : function()
		{
			var $demoMaskedInput = $('.demo-masked-input');
		    //Date
    		$demoMaskedInput.find('.date').inputmask('yyyy-mm-dd', { placeholder: '____-__-__' });
		}
};
$(document).ready(function () {

	pagos.inicio();

});

});