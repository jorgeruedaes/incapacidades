//	var Creador = '<?php echo $usuario['id_ciudades']; ?>'
$(function() {

	var ciudades = {
		inicio: function () {
			ciudades.recargar();
		},
		recargar: function () {
			ciudades.enviarDatos();
			ciudades.addPerfil();
			ciudades.Nuevo();
			ciudades.ModalImagen();
		},
		ValidarEditar : function()
		{
			if (/\w/gi.test($('.nombre').val())) 
			{
				if (/\w/gi.test($('.acronimo').val())) 
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
					$('.acronimo').focus();
					swal("Error", "Las ciudades  debe tener un acronimo.", "error");
					return false;
				}


			}
			else
			{
				$('.nombre').focus();
				swal("Error", "Las ciudades debe tener un nombre.", "error");
				return false;

			}


		},
		ValidarNuevo : function()
		{
			if (/\w/gi.test($('.n-nombre').val())) 
			{
				if (/\w/gi.test($('.n-acronimo').val())) 
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
					$('.n-acronimo').focus();
					swal("Error", "Las ciudades debe tener una acronimo.", "error");
					return false;
				}


			}
			else
			{
				$('.n-nombre').focus();
				swal("Error", "La ciudades debe tener  un nombre.", "error");
				return false;

			}


		}
		,
		Nuevo : function ()
		{
			$('.guardar-nuevo').off('click').on('click', function () {	

				if(ciudades.ValidarNuevo())
				{
					$.ajax({
						url: 'pages/maestros/peticiones/ciudades/peticiones.php',
						type: 'POST',
						data: {
							bandera: "nuevo",
							nombre:	$('.n-nombre').val(),
							acronimo :$('.n-acronimo').val(),
							estado :$('.select-n-estado option:selected').val()


						},
						success: function (resp) {

							var resp = $.parseJSON(jQuery.trim(resp));;
							if (resp.salida === true && resp.mensaje === true) {
								swal({title: "Información",
									text: "La ciudades se ha creado exitosamente!.",
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

		enviarDatos: function () {
			$('.guardar').off('click').on('click', function () {
				if(ciudades.ValidarEditar())
				{
					$.ajax({
						url: 'pages/maestros/peticiones/ciudades/peticiones.php',
						type: 'POST',
						data: {
							bandera: "modificar",
							nombre:	$('.nombre').val(),
							acronimo :$('.acronimo').val(),
							estado :$('.select-estado option:selected').val(),
							ciudad : $('#defaultModal').data('ciudades')


						},
						success: function (resp) {

							var resp = $.parseJSON(jQuery.trim(resp));;
							if (resp.salida === true && resp.mensaje === true) {
								swal({title: "Información",
									text: "La ciudad se ha modificado exitosamente!",
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

	$('#tabla-ciudades').on("click", ".edit-item", function(){
		var ciudades = $(this).data('ciudad');
		var nombre = $(this).data('nombre');
		var acronimo = $(this).data('acronimo');
		var estado = $(this).data('estado');
		$('.nombre').val(nombre);
		$('.acronimo').val(acronimo);
		$('.select-estado').val(estado);
		$('.select-estado').change();
		$('#defaultModal').data('ciudades',ciudades);
		$('#defaultModal').modal('show'); 
		ciudades.recargar();

	});
}
};
$(document).ready(function () {

	ciudades.inicio();

});

});