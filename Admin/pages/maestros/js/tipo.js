//	var Creador = '<?php echo $usuario['id_tipo']; ?>'
$(function() {

	var tipo = {
		inicio: function () {
			tipo.recargar();
		},
		recargar: function () {
			tipo.enviarDatos();
			tipo.addPerfil();
			tipo.Nuevo();
			tipo.ModalImagen();
		},
		ValidarEditar : function()
		{
			if (/\w/gi.test($('.nombre').val())) 
			{
				if (/\w/gi.test($('.select-estado option:selected').val())) 
				{
					return true;
				}
				else
				{
					$('.select-estado').focus();
					swal("Error", "Debes seleccionar un estado.", "error");
					return false;

				}

			}
		else
		{
			$('.nombre').focus();
			swal("Error", "La tipo de incapacidad debe tener un nombre.", "error");
			return false;

		}


	},
	ValidarNuevo : function()
	{
		if (/\w/gi.test($('.n-nombre').val())) 
		{
			if (/[0-9]{1,9}(\.[0-9]{0,10})?$/.test($('.n-codigo').val())) 
			{
				if (/\w/gi.test($('.select-n-estado option:selected').val())) 
				{
					return true;
				}
				else
				{
					$('.select-n-estado').focus();
					swal("Error", "Debes seleccionar un estado.", "error");
					return false;

				}

			}
			else
			{
				$('.n-codigo').focus();
				swal("Error", "La tipo de incapacidad debe tener un codigo validó.", "error");
				return false;
			}


		}
		else
		{
			$('.n-nombre').focus();
			swal("Error", "La tipo de incapacidad debe tener  un nombre.", "error");
			return false;

		}


	}
	,
	Nuevo : function ()
	{
		$('.guardar-nuevo').off('click').on('click', function () {	

			if(tipo.ValidarNuevo())
			{
				$.ajax({
					url: 'pages/maestros/peticiones/tipo/peticiones.php',
					type: 'POST',
					data: {
						bandera: "nuevo",
						nombre:	$('.n-nombre').val(),
						codigo :$('.n-codigo').val(),
						estado :$('.select-n-estado option:selected').val()


					},
					success: function (resp) {

						var resp = $.parseJSON(jQuery.trim(resp));;
						if (resp.salida === true && resp.mensaje === true) {
							swal({title: "Información",
								text: "El tipo de incapacidad se ha creado exitosamente!.",
								type: "success",
								showCancelButton: false,
								confirmButtonColor: "rgb(174, 222, 244)",
								confirmButtonText: "Aceptar",
								closeOnConfirm: false
							}, function (isConfirm) {
								if (isConfirm) {
									window.location.reload();
								}
							});
						} else {
							swal("", "Ha ocurrido un error, intenta nuevamente.  No se pueden repetir codigo del tipo de incapacidad", "error");
						}
					}
				});
			}

		});
},

enviarDatos: function () {
	$('.guardar').off('click').on('click', function () {
		if(tipo.ValidarEditar())
		{
			$.ajax({
				url: 'pages/maestros/peticiones/tipo/peticiones.php',
				type: 'POST',
				data: {
					bandera: "modificar",
					nombre:	$('.nombre').val(),
					estado :$('.select-estado option:selected').val(),
					tipo : $('#defaultModal').data('tipo')


				},
				success: function (resp) {

					var resp = $.parseJSON(jQuery.trim(resp));;
					if (resp.salida === true && resp.mensaje === true) {
						swal({title: "Información",
							text: "El tipo de incapacidad se ha modificado exitosamente!",
							type: "success",
							showCancelButton: false,
							confirmButtonColor: "rgb(174, 222, 244)",
							confirmButtonText: "Aceptar",
							closeOnConfirm: false
						}, function (isConfirm) {
							if (isConfirm) {
								window.location.reload();
							}
						});
					} else {
						swal("", "Ha ocurrido un error, intenta nuevamente.", "error");
					}
				}
			});
		}

	});

},
addPerfil : function()
{
	$('.add-perfil').off('click').on('click', function () {	
		$('#nuevoPerfil').modal('show'); 
	});

},
ModalImagen :function()
{

	$('#tabla-incapacidades').on("click", ".edit-item", function(){
		var tipo = $(this).data('tipo');
		var nombre = $(this).data('nombre');
		var estado = $(this).data('estado');
		$('.nombre').val(nombre);
		$('.select-estado').val(estado);
		$('.select-estado').change();
		$('#defaultModal').data('tipo',tipo);
		$('#defaultModal').modal('show'); 
		tipo.recargar();

	});
}
};
$(document).ready(function () {

	tipo.inicio();

});

});