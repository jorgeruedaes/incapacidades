
$(function() {

	var perfil = {
		inicio: function () {
			perfil.recargar();
		},
		recargar: function () {
			perfil.enviarDatos();
			perfil.borrarUsuario();
			perfil.seleccionarIcono();
			perfil.cargarModal();
			perfil.activarEditar();
		},
		enviarDatos: function () {
			$('.guardar').off('click').on('click', function () {
				$.ajax({
					url: 'pages/usuarios/peticiones/peticiones.php',
					type: 'POST',
					data: {
						bandera: "modificar",
						id_perfiles: $('.select-perfiles option:selected').val(),
						estado: $('.select-estados option:selected').val(),
						id_perfil: $('#defaultModal').data('usuario')

					},
					success: function (resp) {

						var resp = $.parseJSON(jQuery.trim(resp));;
						if (resp.salida === true && resp.mensaje === true) {
							swal({title: "Información",
								text: "El usuario se ha modificado exitosamente!",
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
			});

		},
		cargarModal: function()
		{
			$('.editar-pass').off('click').on('click', function () {
				$('#defaultModal').modal('show'); 
			});
		},
		activarEditar : function()
		{
			$('.activate-edit').off('click').on('click', function (){
				$('.nombre').attr('disabled',false);
				$('.apellido').attr('disabled',false);
				$('.email').attr('disabled',false);
				$('.respuesta').attr('disabled',false);

				
			});

		}
	};
	$(document).ready(function () {

		perfil.inicio();

	});

});