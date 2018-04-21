
$(function() {
	var t='';
	var asistencia = {
		inicio: function () {
			asistencia.recargar();
		},
		recargar: function () {
			asistencia.enviarDatos();
			asistencia.Tabla();
			asistencia.Cargar_Goles();
			asistencia.Tablas();
			asistencia.TomarDatos_Resultados();
			asistencia.SeleccionCampeonato_Goles();


		},
		Tablas : function()
		{
			$('#tabla1').dataTable( {
				fixedColumns: true,
				scrollY:        "400px",
				scrollX:true,
				paging:         false
			} );

		},
		SeleccionCampeonato_Goles : function()
		{


			$('.selector-campeonato-asistencia').on('change', function () {
				$.ajax({
					url: 'pages/partidos/peticiones/peticiones.php',
					type: 'POST',
					data: {
						bandera: "getequipos",
						campeonato:  $('.selector-campeonato-asistencia option:selected').val()

					},
					success: function (resp) {

						var resp = $.parseJSON(jQuery.trim(resp));;
						if (resp.salida === true && resp.mensaje === true) {
							t.row($('.tabla-resultados').parents('tr') ).clear().draw();
							for (var i = 0; i < resp.datos.length; i++) {
								t.row.add( [ 
									resp.datos[i].id_equipo,
									resp.datos[i].nombre_equipo,
									resp.datos[i].colegio,
									resp.datos[i].grupo,
									resp.datos[i].estado,
									'<div class="btn-group btn-group-xs" role="group" aria-label="Small button group"><button data-id="'+resp.datos[i].id_equipo+'"data-estado="'+resp.datos[i].estado+'"data-tecnico="'+resp.datos[i].tecnico1+'"data-nombre="'+resp.datos[i].nombre_equipo+'"data-club="'+resp.datos[i].colegio+'"data-grupo="'+resp.datos[i].grupo+'"data-torneo="'+resp.datos[i].torneo+'" type="button" class="btn btn-primary waves-effect edit-item"><i class="material-icons">edit</i></button></div>'
									] ).draw( false );
							}
							asistencia.Botones();
						} else {
							t.row($('.tabla-resultados').parents('tr') ).clear().draw();
							swal("Importante", "No hay partidos para Editar la Asistencia.", "info");
						}
					}
				});


			});
		},
		Cargar_Goles : function()
		{
			$.ajax({
				url: 'pages/partidos/peticiones/peticiones.php',
				type: 'POST',
				data: {
					bandera: "get_campeonato",
					campeonato:  $('.selector-campeonato-asistencia:selected').val()
				},
				success: function (resp) {

					var resp = $.parseJSON(jQuery.trim(resp));;
					if (resp.salida === true && resp.mensaje === true) {
						$('.selector-campeonato-asistencia').val(resp.datos);
						$('.selector-campeonato-asistencia').change();
					} else {
						swal("Importante", "Selecciona un campeonato.", "info");
					}
				}
			});
		},
		TomarDatos_Resultados : function ()
		{
			var array =[];
			var objeto =[];

			$('.fila-tabla').each(function(indice, elemento) {
				if($(elemento).find('.confirmacion').is(':checked'))
				{ 
					var objeto =[];

					objeto.push($(elemento).data('jugador'));
					objeto.push($(elemento).find('.gol').val());
					objeto.push($(elemento).find('.autogol').val());
					objeto.push($(elemento).find('.select-tarjeta option:selected').val());
					array.push(objeto);
				} ;
			}); 
			return array;
		},

		Tabla : function()
		{
			t = $('.tabla-resultados').DataTable();

		},
		enviarDatos: function () {


			$('.guardar').off('click').on('click', function () {
				if(asistencia.Validar()){
					$.ajax({
						url: 'pages/partidos/peticiones/peticiones.php',
						type: 'POST',
						data: {
							bandera: "nuevo",
							equipoa: $('.select-equipoa option:selected').val(),
							equipob: $('.select-equipob option:selected').val(),
							fecha:   $('#fecha').val(),
							hora:    $('#hora').val(),
							lugar:   $('.select-lugar option:selected').val(),
							ronda:   $('#ronda').val()


						},
						success: function (resp) {

							var resp = $.parseJSON(jQuery.trim(resp));;
							if (resp.salida === true && resp.mensaje === true) {
								swal({title: "Información",
									text: "El partido se ha creado exitosamente!",
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
		Botones : function ()
		{
			$('.tabla-resultados').on("click", ".edit-item", function(){
				var equipo = $(this).data('id');
				var	url = "pages/partidos/editarasistencia.php?id="+equipo; 
				window.open(url, '_self');

			});
		}
	};
	$(document).ready(function () {

		asistencia.inicio();

	});

});