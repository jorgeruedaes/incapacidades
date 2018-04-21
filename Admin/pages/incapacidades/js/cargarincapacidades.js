//	var Creador = '<?php echo $usuario['id_cargador']; ?>'
$(function() {
	var goblal='';
	var cargador = {
		inicio: function () {
			cargador.recargar();
		},
		recargar: function () {
			cargador.add();
			cargador.close();
			cargador.DropeZone();
			cargador.DropeZone();
			cargador.ModalImagen();
		},
		ModalImagen :function()
		{	$('.ver-resultados').off('click').on('click', function () {
			$('#mensaje').modal('show');
		});
	},
		close : function()
		{
			$('.guardar-files').off('click').on('click', function () {	
				window.location.reload();
			});
		},
		DropeZone : function()
		{
			var torneo = $('.selector-campeonato-nuevo option:selected').val();
			var bandera = $('#bandera').val();
			//	Dropzone.autoDiscover = false;		
			//var carpeta = $('.guardar-files').data('carpeta');
			//$('.dropzone').attr('action','pages/partidos/peticiones/subir.php?carpeta=Temporal&&torneo='+torneo);

			Dropzone.options.dropzone = {
				url: 'pages/incapacidades/peticiones/subir.php?carpeta=Temporal',
				maxFilesize: 20,
				maxFiles: 1,
				acceptedFiles : ".csv",
				init: function() {
					var myDropZone = this;

					this.on("sending", function(file, xhr, formData) {
						formData.append("bandera",bandera);
					});
					this.on("success", function(file, responseText) {
						var resp = $.parseJSON(jQuery.trim(responseText));
						if (resp.salida === true && resp.mensaje === true) {
							$('#nuevaarchivos').modal('hide');
							swal({title: "Información",
								text: "Las Incapacidades se han cargado de manera exitosa!.",
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
						}
						else
						{
							myDropZone.removeAllFiles();
							$('.ver-resultados').css("display","inline");
							$('#nuevaarchivos').modal('hide');	
							$('.respuesta').html('');
							$('.respuesta').html(resp.datos);
							swal("Importante!", "Ha ocurrido un error en los datos que intentas subir revisa los resultados e intenta nuevamente.", "error");
		cargador.ModalImagen();
						}
						
					});
				}

			};

			var dropzone  = new Dropzone("#archivos", {
				url: 'pages/incapacidades/peticiones/subir.php?carpeta=Temporal'
			});


			
		},
		add : function()
		{
			$('.add-files').off('click').on('click', function () {	
				$('#nuevaarchivos').modal('show'); 
				cargador.recargar();

			});

		}
	};
	$(document).ready(function () {

		cargador.inicio();

	});

});