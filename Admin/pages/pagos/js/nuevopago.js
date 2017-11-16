//	var Creador = '<?php echo $usuario['id_incapacidades']; ?>'
$(function() {
	var t ='';
	var pagos = {
		inicio: function () {
			pagos.AddClicks();
			pagos.Cargar();
			pagos.cargarModal();
			pagos.Tabla();
		},		
		Recargar: function()
		{
			pagos.AgregarItem();
		},
		AddClicks: function()
		{
			$('.nuevo-pago').on("click", function(){

				$('.caja-nuevopago').show();
				$('.caja-listadopago').hide();

			});

			$('.boton-menu').on("click", function(){
				if($('#leftsidebar').width() == 0)

				{
					$('#leftsidebar').css('width','300px');
					$('.content').css('margin-left','300px');
				}else
				{
					$('#leftsidebar').css('width','0px');
					$('.content').css('margin-left','10px');
				}
				 

			});

			$('.go-back').on("click", function(){
				
				window.location.reload();
				
			});

			$('.boton-cancelar').on("click", function(){
				
				window.location.reload();
				
			}); 

			$('.boton-pendiente').on("click", function(){
			 
				if(pagos.ValidarPendiente())
				{

				swal({title: "¿Está seguro que desea GUARDAR el pago como PENDIENTE?",
						text: "",
						type: "warning",
						confirmButtonText: "Aceptar",
						showCancelButton: true,
						confirmButtonColor: "rgb(174, 222, 244)",

						closeOnConfirm: false
					}, function (isConfirm) {
						if (isConfirm) {

							$.ajax({
								url: 'pages/pagos/peticiones/peticiones.php',
								type: 'POST',
								data: {
									bandera: "guardar-pendiente",
									valor: $(".payment-full-value").val(),
									fecha: $(".payment-date").val(),
									estado : "pendiente",
									eps : $(".payment-eps option:selected").val(),
									json  : pagos.TomarDatos_Incapacidades(),
									
								},
								success: function (resp) {

									 var resp = $.parseJSON(resp);
									if (resp.salida === true && resp.mensaje === true) {
										swal({title: "Información",
											text: "Se ha creado el pago No. " + resp.idpago + "  de manera exitosa!",
											type: "success",
											confirmButtonText: "Aceptar",
											showCancelButton: false,
											confirmButtonColor: "rgb(174, 222, 244)",
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
				}

			}); 

			$('.boton-finalizar').on("click", function(){
				
				alert('finalizó');
				
			}); 

			$('.payment-full-value').on("change", function(){
				
				 var value = $(this).val();
				 $('.payment-value-2').text(value);
				 var difference = $(this).val() - $('.payment-total-value').text();
				 $('.payment-difference').text(difference);
				
			});
		},
		ValidarPendiente : function()
		{
				if($('.payment-full-value').val() == "")
				{
					$('.payment-full-value').focus();
					swal("Error", "Debe ingresar el valor del pago.", "error");
					return false;

				} else if ($('.payment-date').val() == "")
				{

					$('.payment-date').focus();
					swal("Error", "Debe ingresar la fecha del pago.", "error");
					return false;

				} else if ($( ".payment-eps option:selected" ).val() == ""){

						$('.payment-eps').focus();
						swal("Error", "Debe seleccionar la EPS del pago.", "error");	
						return false;
				}else {
					return true;
				}
			 
		},
		TomarDatos_Incapacidades : function ()
		{
			var array =[];
			var objeto =[];

			if($('#tabla-detalle-pago .valor-incapacidad').size() > 0)

			{
				$('#tabla-detalle-pago .valor-incapacidad').each(function(indice, elemento) {
				  
					var objeto =[];
					objeto.push($(elemento).parent().find("td:nth-child(1)").text()); //idincapacidad
					objeto.push($(elemento).text()); //valor
					array.push(objeto);
				 
				}); 
			}
			
			return array;
		},
		AgregarItem: function()
		{
			$('#tabla-incapacidades tbody').off('click').on('click', '.add-item', function () {

				var bandera = false;
				var bandera1 = false;
				var bandera2 = false;

				var id = $(this).parent().data('id');

				$('#tabla-detalle-pago tbody').find('.delete-item').parent().each(function() {
				  
				  if(id == $( this ).data('id'))
				  {
				  	 bandera = true;
				  } 
				});

				if(bandera == true)
				{
					swal("Importante!", "No se puede agregar la incapacidad, ya existe.", "info");

				}else
				{
				
				var total = 0;
				var money = 0;

				var parent = $(this).parents('tr');
				if(parent.find("td:nth-child(8)").find('input').is(':checked'))
				{
					money = parent.find("td:nth-child(9)").find('input').val();

					if(money == "")
					{
						bandera1= true;
					} 
				}else
				{
					if(parent.find("td:nth-child(9)").find('input').val() != "")
					{
						bandera2= true;
					}
					money = parent.find("td:nth-child(7)").text();
				}

				if(bandera1 == true)
				{
					swal("Importante!", "Debe digitar un valor parcial.", "info");
				}else
				{
				
					if(bandera2 == true)
				{
					swal("Importante!", "Debe remover el texto de la casilla valor parcial o seleccionar la opción 'Tomar vr. parcial'.", "info");
				}else
				{

				var row = $(this).parents('tr').prop('outerHTML');
				$('#tabla-detalle-pago tbody').append(row);

				//eliminamos las dos ultimas columnas
				$('#tabla-detalle-pago tbody').find("tr:last").find("td:last").remove();
				$('#tabla-detalle-pago tbody').find("tr:last").find("td:last").remove();
				$('#tabla-detalle-pago tbody').find("tr:last").find("td:last").remove();
				$('#tabla-detalle-pago tbody').find("tr:last").find("td:last").remove();
				//agregamos valor
				$('#tabla-detalle-pago tbody').find("tr:last").find('td:last').after('<td class="valor-incapacidad">' + money + '</td>')
				//agregamos boton eliminar
				$('#tabla-detalle-pago tbody').find("tr:last").find('td:last').after('<td><div class="btn-group btn-group-xs" data-id="' + id + '"  role="group" aria-label="Small button group"><button data-nivel="1" data-nombre="Administrador" data-id="1" type="button" class="btn btn-success waves-effect delete-item"><i class="material-icons">delete</i></button></div></td>')
				$('#tabla-detalle-pago tbody tr').each(function(fila) {
					$this = $(this);
					total += parseFloat($this.find("td:nth-child(7)").text()); //$this.find("td:nth-child(5)").text();
					
				});

				$('.payment-total-value').text("");
				$('.payment-total-value').text(total);
				var difference = $('.payment-value-2').text() - $('.payment-total-value').text();
				$('.payment-difference').text(difference);

				}
				}
				}
			
			});

			$('#tabla-detalle-pago tbody').off('click').on('click', '.delete-item', function () {

				var total = 0;
				var row = $(this).parents('tr').remove();
				//$('#tabla-detalle-pago tbody').append(row);

				//$('#tabla-detalle-pago tbody').find("tr:last").find("td:last").remove();
				//$('#tabla-detalle-pago tbody').find("tr:last").find('td:last').after('<td><div class="btn-group btn-group-xs" role="group" aria-label="Small button group"><button data-nivel="1" data-nombre="Administrador" data-id="1" type="button" class="btn btn-success waves-effect delete-item"><i class="material-icons">delete</i></button></div></td>')
				$('#tabla-detalle-pago tbody tr').each(function(fila) {
					$this = $(this);
					total += parseFloat($this.find("td:nth-child(5)").text()); //$this.find("td:nth-child(5)").text();
				});

				$('.payment-total-value').text("");
				$('.payment-total-value').text(total);
				var difference = $('.payment-value-2').text() - $('.payment-total-value').text();
				$('.payment-difference').text(difference);


			});
			
		},
		Cargar : function()
		{
			$('#leftsidebar').css('width','0px');
			$('.content').css('margin-left','10px');
			var $demoMaskedInput = $('.demo-masked-input');
		    //Date
    		$demoMaskedInput.find('.date').inputmask('yyyy-mm-dd', { placeholder: '____-__-__' });
		},
		Tabla : function()
		{
			t = $('#tabla-incapacidades').DataTable({
				
			});
		},
		cargarModal: function()
		{
			$('#open-filter').on("click", function(){
				$('#Modalnuevo').modal('show'); 
				pagos.Cargar();
				pagos.enviarDatos();
			});
		},
		Filtrar : function()
		{
			var where="WHERE 1=1 ";

			if ($('.f-codigo').val().length>0)
			{
				where+= ' AND inc.id_incapacidad='+$('.f-codigo').val()+' '; 
			}
			if ($('.f-codigodesde').val().length>0 && $('.f-codigohasta').val().length>0 )
			{
				where+= ' AND inc.id_incapacidad BETWEEN '+$('.f-codigodesde').val()+' AND '+$('.f-codigohasta').val()+'  '; 
			}
			if ($('.f-fechacortedesde').val().length>0 && $('.f-fechacortehasta').val().length>0 )
			{
				where+= ' AND inc.fecha_corte BETWEEN "'+$('.f-fechacortedesde').val()+'" AND "'+$('.f-fechacortehasta').val()+'"  '; 
			}
			if ($('.f-fechainicialdesde').val().length>0 && $('.f-fechainicialhasta').val().length>0 )
			{
				where+= ' AND inc.fecha_inicial BETWEEN "'+('.f-fechainicialdesde').val()+'" AND "'+$('.f-fechainicialhasta').val()+'"  '; 
			}
			if ($('.select-estado option:selected').val().length>0)
			{
				where+= ' AND inc.estado='+$('.select-estado option:selected').val()+' '; 
			}
			if ($('.select-tipo option:selected').val().length>0)
			{
				where+= ' AND inc.tipo='+$('.select-tipo option:selected').val()+' '; 
			}
			if ($('.select-eps option:selected').val().length>0)
			{
				where+= ' AND inc.eps='+$('.select-eps option:selected').val()+' '; 
			}
			if ($('.select-ciudad option:selected').val().length>0)
			{
				where+= ' AND inc.ciudad='+$('.select-ciudad option:selected').val()+' '; 
			}
			if ($('.select-empresa option:selected').val().length>0)
			{
				where+= ' AND inc.empresa='+$('.select-empresa option:selected').val()+' '; 
			}
			if ($('.select-cliente option:selected').val().length>0)
			{
				where+= ' AND inc.cliente='+$('.select-cliente option:selected').val()+' '; 
			}
			if ($('.f-cedula').val().length>0)
			{
				where+= ' AND inc.trabajador='+$('.f-cedula').val()+' '; 
			}

			return where;
		},
		enviarDatos: function () {
			$('.filtrar-boton').off('click').on('click', function () {
				
				$.ajax({
					url: 'pages/incapacidades/peticiones/peticiones.php',
					type: 'POST',
					data: {
						bandera: "filtrar",
						where: pagos.Filtrar()

					},
					success: function (resp) {

						var resp = $.parseJSON(resp);
						if (resp.salida === true && resp.mensaje === true) {
							t.row($('#tabla-incapacidades').parents('tr') ).clear().draw();
							for (var i = 0; i < resp.datos.length; i++) {
								t.row.add( [ 
									resp.datos[i].id_incapacidad,
									resp.datos[i].trabajador,
									resp.datos[i].nombretrabajador,
									resp.datos[i].cantidad,
									resp.datos[i].fecha_corte,
									resp.datos[i].nombreincapacidad,
									resp.datos[i].valor,
									'<div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12"><input type="checkbox" id="' + i + '"><label for="' + i + '"></label></div>',
									'<div class="form-group"><div class="form-line"><input type="number" style="font-size:0.8em;width:65px" min="0" class="form-control payment-value" placeholder="$" /></div></div>',
									'<div class="btn-group btn-group-xs" data-id="' + resp.datos[i].id_incapacidad + "-" + resp.datos[i].fecha_corte + "-" + resp.datos[i].tipoincapacidad +'" role="group" aria-label="Small button group"><button data-nivel="1" data-nombre="Administrador" data-id="1" type="button" class="btn btn-success waves-effect add-item"><i class="material-icons">add</i></button></div>'
									]).draw( false );
							}
							$('#Modalnuevo').modal('hide');
						} else {
							t.row($('#tabla-incapacidades').parents('tr') ).clear().draw();
							swal("Importante!", "No se han encontrado registros para ese filtro, intenta nuevamente.", "info");
						}
						pagos.Recargar();
					}
				});
		});
}
};
$(document).ready(function () {

	pagos.inicio();

});

});


