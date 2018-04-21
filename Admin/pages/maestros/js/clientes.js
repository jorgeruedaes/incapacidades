//	var Creador = '<?php echo $usuario['id_clientes']; ?>'
$(function() {

	var clientes = {
		inicio: function () {
			clientes.recargar();
		},
		recargar: function () {
			clientes.enviarDatos();
			clientes.addPerfil();
			clientes.Nuevo();
			clientes.ModalImagen();
		},
		ValidarEditar : function()
		{
			if (/\w/gi.test($('.nombre').val())) 
			{
				if (/\w/gi.test($('.acronimo').val())) 
				{
					if (/\w/gi.test($('.select-estado option:selected').val())) 
					{
						if (/\w/gi.test($('.select-empresa option:selected').val())) 
						{

							return true;
							
						}
						else
						{

							$('.select-empresa').focus();
							swal("Error", "Debes seleccionar una empresa.", "error");
							return false;

						}
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
					swal("Error", "La clientes  debe tener un acronimo.", "error");
					return false;
				}


			}
			else
			{
				$('.nombre').focus();
				swal("Error", "La clientes debe tener un nombre.", "error");
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
						if (/\w/gi.test($('.select-n-empresa option:selected').val())) 
						{

							return true;
						}
						else
						{
							$('.select-n-empresa').focus();
							swal("Error", "Debes seleccionar una empresa.", "error");
							return false;

						}
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
					swal("Error", "La clientes debe tener una acronimo.", "error");
					return false;
				}


			}
			else
			{
				$('.n-nombre').focus();
				swal("Error", "La clientes debe tener  un nombre.", "error");
				return false;

			}


		}
		,
		Nuevo : function ()
		{
			$('.guardar-nuevo').off('click').on('click', function () {	

				if(clientes.ValidarNuevo())
				{
					$.ajax({
						url: 'pages/maestros/peticiones/clientes/peticiones.php',
						type: 'POST',
						data: {
							bandera: "nuevo",
							nombre:	$('.n-nombre').val(),
							acronimo :$('.n-acronimo').val(),
							estado :$('.select-n-estado option:selected').val(),
							empresa : $('.select-n-empresa option:selected').val()


						},
						success: function (resp) {

							var resp = $.parseJSON(jQuery.trim(resp));;
							if (resp.salida === true && resp.mensaje === true) {
								swal({title: "Información",
									text: "El cliente se ha creado exitosamente!.",
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
		if(clientes.ValidarEditar())
		{
			$.ajax({
				url: 'pages/maestros/peticiones/clientes/peticiones.php',
				type: 'POST',
				data: {
					bandera: "modificar",
					nombre:	$('.nombre').val(),
					acronimo :$('.acronimo').val(),
					estado :$('.select-estado option:selected').val(),
					empresa :$('.select-empresa option:selected').val(),
					clientes : $('#defaultModal').data('clientes')


				},
				success: function (resp) {

					var resp = $.parseJSON(jQuery.trim(resp));;
					if (resp.salida === true && resp.mensaje === true) {
						swal({title: "Información",
							text: "El cliente se ha modificado exitosamente!",
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

	$('#tabla-clientes').on("click", ".edit-item", function(){
		var clientes = $(this).data('clientes');
		var nombre = $(this).data('nombre');
		var acronimo = $(this).data('acronimo');
		var estado = $(this).data('estado');
		var empresa = $(this).data('empresa');
		$('.nombre').val(nombre);
		$('.acronimo').val(acronimo);
		$('.select-estado').val(estado);
		$('.select-estado').change();
		$('.select-empresa').val(empresa);
		$('.select-empresa').change();
		$('#defaultModal').data('clientes',clientes);
		$('#defaultModal').modal('show'); 
		clientes.recargar();

	});
}
};
$(document).ready(function () {

	clientes.inicio();

});

});