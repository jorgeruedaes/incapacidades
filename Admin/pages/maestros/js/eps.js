//	var Creador = '<?php echo $usuario['id_eps']; ?>'
$(function() {

	var eps = {
		inicio: function () {
			eps.recargar();
		},
		recargar: function () {
			eps.enviarDatos();
			eps.addPerfil();
			eps.Nuevo();
			eps.ModalImagen();
		},
		ValidarEditar : function()
		{
			if (/\w/gi.test($('.nombre').val())) 
			{
				if (/[0-9]{1,9}(\.[0-9]{0,10})?$/.test($('.codigo').val())) 
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
					$('.codigo').focus();
					swal("Error", "La eps  debe tener un codigo validó.", "error");
					return false;
				}


			}
			else
			{
				$('.nombre').focus();
				swal("Error", "La eps debe tener un nombre.", "error");
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
					swal("Error", "La eps debe tener un codigo validó.", "error");
					return false;
				}


			}
			else
			{
				$('.n-nombre').focus();
				swal("Error", "La eps debe tener  un nombre.", "error");
				return false;

			}


		}
		,
		Nuevo : function ()
		{
			$('.guardar-nuevo').off('click').on('click', function () {	

				if(eps.ValidarNuevo())
				{
					$.ajax({
						url: 'pages/maestros/peticiones/eps/peticiones.php',
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
									text: "La eps se ha creado exitosamente!.",
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
								swal("", "Ha ocurrido un error, intenta nuevamente.  No se pueden repetir codigo de EPS", "error");
							}
						}
					});
				}

			});
		},

		enviarDatos: function () {
			$('.guardar').off('click').on('click', function () {
				if(eps.ValidarEditar())
				{
					$.ajax({
						url: 'pages/maestros/peticiones/eps/peticiones.php',
						type: 'POST',
						data: {
							bandera: "modificar",
							nombre:	$('.nombre').val(),
							codigo :$('.codigo').val(),
							estado :$('.select-estado option:selected').val(),
							eps : $('#defaultModal').data('eps')


						},
						success: function (resp) {

							var resp = $.parseJSON(jQuery.trim(resp));;
							if (resp.salida === true && resp.mensaje === true) {
								swal({title: "Información",
									text: "La eps se ha modificado exitosamente!",
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

	$('#tabla-eps').on("click", ".edit-item", function(){
		var eps = $(this).data('eps');
		var nombre = $(this).data('nombre');
		var codigo = $(this).data('eps');
		var estado = $(this).data('estado');
		$('.nombre').val(nombre);
		$('.codigo').val(codigo);
		$('.select-estado').val(estado);
		$('.select-estado').change();
		$('#defaultModal').data('eps',eps);
		$('#defaultModal').modal('show'); 
		eps.recargar();

	});
}
};
$(document).ready(function () {

	eps.inicio();

});

});