//	var Creador = '<?php echo $usuario['id_trabajadores']; ?>'
$(function() {

	var trabajadores = {
		inicio: function () {
			trabajadores.recargar();
		},
		recargar: function () {
			trabajadores.enviarDatos();
			trabajadores.addPerfil();
			trabajadores.Nuevo();
			trabajadores.ModalImagen();
		},
		ValidarEditar : function()
		{
			if (/\w/gi.test($('.nombre').val())) 
			{
				if (/[0-9]{1,9}(\.[0-9]{0,10})?$/.test($('.cedula').val())) 
				{
					if (/\w/gi.test($('.apellido').val())) 
					{
						return true;
					}
					else
					{
						$('.apellido').focus();
						swal("Error", "El trabajador debe tener un apellido.", "error");
						return false;

					}

				}
				else
				{
					$('.codigo').focus();
					swal("Error", "El trabajador  debe tener un documento validó.", "error");
					return false;
				}


			}
			else
			{
				$('.nombre').focus();
				swal("Error", "El trabajador debe tener un nombre.", "error");
				return false;

			}


		},
		ValidarNuevo : function()
		{
			if (/\w/gi.test($('.n-nombre').val())) 
			{
				if (/[0-9]{1,9}(\.[0-9]{0,10})?$/.test($('.n-cedula').val())) 
				{
					if (/\w/gi.test($('.n-apellido').val())) 
					{
						return true;
					}
					else
					{
						$('.n-apellido').focus();
						swal("Error", "El trabajador debe tener un apellido.", "error");
						return false;

					}

				}
				else
				{
					$('.n-codigo').focus();
					swal("Error", "El trabajador debe tener un documento validó.", "error");
					return false;
				}


			}
			else
			{
				$('.n-nombre').focus();
				swal("Error", "El trabajador debe tener  un nombre.", "error");
				return false;

			}


		}
		,
		Nuevo : function ()
		{
			$('.guardar-nuevo').off('click').on('click', function () {	

				if(trabajadores.ValidarNuevo())
				{
					$.ajax({
						url: 'pages/maestros/peticiones/trabajadores/peticiones.php',
						type: 'POST',
						data: {
							bandera: "nuevo",
							nombre:	$('.n-nombre').val(),
							apellido:$('.n-apellido').val(),
							cedula :$('.n-cedula').val()


						},
						success: function (resp) {

							var resp = $.parseJSON(jQuery.trim(resp));;
							if (resp.salida === true && resp.mensaje === true) {
								swal({title: "Información",
									text: "EL trabajador se ha creado exitosamente!.",
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
								swal("", "Ha ocurrido un error, intenta nuevamente.  No se pueden repetir el documento del trabajador", "error");
							}
						}
					});
				}

			});
},

enviarDatos: function () {
	$('.guardar').off('click').on('click', function () {
		if(trabajadores.ValidarEditar())
		{
			$.ajax({
				url: 'pages/maestros/peticiones/trabajadores/peticiones.php',
				type: 'POST',
				data: {
					bandera: "modificar",
					nombre:	$('.nombre').val(),
					apellido:$('.apellido').val(),
					cedula :$('.cedula').val(),
					trabajadores : $('#defaultModal').data('trabajadores')


				},
				success: function (resp) {

					var resp = $.parseJSON(jQuery.trim(resp));;
					if (resp.salida === true && resp.mensaje === true) {
						swal({title: "Información",
							text: "eL trabajador se ha modificado exitosamente!",
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

	$('#tabla-trabajadores').on("click", ".edit-item", function(){
		var trabajadores = $(this).data('trabajadores');
		var nombre = $(this).data('nombre');
		var cedula = $(this).data('cedula');
		var apellido = $(this).data('apellido');
		$('.nombre').val(nombre);
		$('.cedula').val(cedula);
		$('.apellido').val(apellido);
		$('#defaultModal').data('trabajadores',trabajadores);
		$('#defaultModal').modal('show'); 
		trabajadores.recargar();

	});
}
};
$(document).ready(function () {

	trabajadores.inicio();

});

});