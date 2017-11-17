//	var Creador = '<?php echo $usuario['id_incapacidades']; ?>'
$(function() {
	var t ='';
	var pagos = {
		inicio: function () {
			pagos.AddClicks();
			pagos.Cargar();
			pagos.recargar();
			pagos.Tabla();
		},		
		AddClicks: function()
		{
			
		},
		recargar: function () 
		{
			pagos.enviarDatos();
			pagos.cargarModal();
			pagos.AgregarItem();
		},
		Tabla : function()
		{
			t = $('#tabla-pagos').DataTable({
				// dom: 'Bfrtip',
				// searching: true,
				// paging: false,
				// ordering: true,
				// info:     true,
				// buttons: [
				// 'csv', 'excel', 'pdf', 'print'
				// ],
				// order: [[ 10, "desc" ]]

			});

		},
		Filtrar : function()
		{
			var where="WHERE 1=1 ";

			if ($('.f-fechapago').val().length>0)
			{
				where+= ' AND pg.fecha_pago = "'+('.f-fechapago').val()+'"'; 
			}
			if ($('.select-estado option:selected').val().length>0)
			{
				where+= ' AND pg.estado="'+$('.select-estado option:selected').val()+'"'; 
			}
			if ($('.select-eps option:selected').val().length>0)
			{
				where+= ' AND pg.id_eps='+$('.select-eps option:selected').val()+' '; 
			}

			return where;
			},
		Cargar : function()
		{
			var $demoMaskedInput = $('.demo-masked-input');

		    //Date
		    $demoMaskedInput.find('.date').inputmask('yyyy-mm-dd', { placeholder: '____-__-__' });

		},
		enviarDatos: function () {
			$('.filtrar-boton').off('click').on('click', function () {
		
					var total =0;
					$.ajax({
						url: 'pages/pagos/peticiones/peticiones.php',
						type: 'POST',
						data: {
							bandera: "filtrar",
							where: pagos.Filtrar()

						},
						success: function (resp) {

							var resp = $.parseJSON(resp);
							if (resp.salida === true && resp.mensaje === true) {
								t.row($('#tabla-pagos').parents('tr') ).clear().draw();

								// for (var i = 0; i < resp.datos.length; i++) {
								// 	total = parseInt(resp.datos[i].valor) + parseInt(total);
								// }					
								//resp.datos.push({"id_pago":'',"eps":'',"valor":'',"fechapago":'',"estado":'',"fechacreacion":'',"usuario":''})					

								for (var i = 0; i < resp.datos.length; i++) {

									if(resp.datos[i].estado == 'pendiente')
									{
										t.row.add( [ 
										resp.datos[i].id_pago,
										resp.datos[i].eps,
										resp.datos[i].valor,
										resp.datos[i].fechapago,
										resp.datos[i].estado,
										resp.datos[i].fechacreacion,
										resp.datos[i].usuario,
										'<div class="btn-group btn-group-xs" data-id="'+resp.datos[i].id_pago+'" role="group" aria-label="Small button group"><button data-nivel="1" data-nombre="Administrador" data-id="1" type="button" class="btn btn-success waves-effect edit-item"><i class="material-icons">edit</i></button></div>'
										]).draw( false );
									}else
									{
										t.row.add( [ 
										resp.datos[i].id_pago,
										resp.datos[i].eps,
										resp.datos[i].valor,
										resp.datos[i].fechapago,
										resp.datos[i].estado,
										resp.datos[i].fechacreacion,
										resp.datos[i].usuario,
										''
										]).draw( false );

									}
								
								}

								$('#Modalnuevo').modal('hide');
							} else {
								t.row($('#tabla-pagos').parents('tr') ).clear().draw();
								swal("Importante!", "No se han encontrado registros para ese filtro, intenta nuevamente.", "info");
							}
							pagos.recargar();
						}
					});
			});
	},
	cargarModal: function()
	{
		$('.filtro').on("click", function(){
			$('#Modalnuevo').modal('show'); 
			pagos.Cargar();
			pagos.enviarDatos();
		});
	},

		AgregarItem: function()
		{
			$('#tabla-pagos tbody').off('click').on('click', '.edit-item', function () {

				//idpago
				var id = $(this).parent().data('id');
				window.location.href = "pages/pagos/editarpago.php?id="+id;  

			});
				
		},
};
$(document).ready(function () {

	pagos.inicio();

});

});