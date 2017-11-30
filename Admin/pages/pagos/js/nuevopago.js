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

			$('#payment-eps').on("change", function(){

				t.clear().draw();

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
									bandera: "guardar-pago",
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
												//window.location.reload();
												window.location.href = "pages/pagos/gestionar.php";  
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
				
				if(pagos.ValidarFinalizado())
				{

					swal({title: "El valor total del pago y el valor sumado de las incapacidades tienen una diferencia de " + $('.payment-difference').text()  + ". Desea continuar y FINALIZAR el pago ?",
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
									bandera: "guardar-pago",
									valor: $(".payment-full-value").val(),
									fecha: $(".payment-date").val(),
									estado : "completado",
									eps : $(".payment-eps option:selected").val(),
									json  : pagos.TomarDatos_Incapacidades(),
									
								},
								success: function (resp) {

									var resp = $.parseJSON(resp);
									if (resp.salida === true && resp.mensaje === true) {
										swal({title: "Información",
											text: "Se ha finalizado el pago No. " + resp.idpago + "  de manera exitosa!",
											type: "success",
											confirmButtonText: "Aceptar",
											showCancelButton: false,
											confirmButtonColor: "rgb(174, 222, 244)",
											closeOnConfirm: false
										}, function (isConfirm) {
											if (isConfirm) {
												//window.location.reload();
												window.location.href = "pages/pagos/gestionar.php";  
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

			$('.payment-full-value').on("change", function(){
				
				var value = $(this).val();
				$('.payment-value-2').text(value);
				var difference = $(this).val() - $('.payment-total-value').text();
				$('.payment-difference').text(difference);
				
			});
		},
		ValidarPendiente : function()
		{

			var today = new Date();
			var dd = today.getDate();
			var mm = today.getMonth()+1; //January is 0!

			var yyyy = today.getFullYear();
			if(dd<10){
				dd='0'+dd;
			} 
			if(mm<10){
				mm='0'+mm;
			} 
			var today = yyyy+'-'+mm+'-'+dd;

			if($('.payment-date').val() > today)
			{
				swal("Error", "Debe ingresar una fecha de pago válida.", "error");
				return false;

			} else if($('.payment-full-value').val() == "")
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
			} 
			else {
				return true;
			}

		},
		ValidarFinalizado : function()
		{

			var today = new Date();
			var dd = today.getDate();
			var mm = today.getMonth()+1; //January is 0!

			var yyyy = today.getFullYear();
			if(dd<10){
				dd='0'+dd;
			} 
			if(mm<10){
				mm='0'+mm;
			} 
			var today = yyyy+'-'+mm+'-'+dd;

			if($('.payment-date').val() > today)
			{
				swal("Error", "Debe ingresar una fecha de pago válida.", "error");
				return false;

			}else if($('.payment-full-value').val() == "")
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
			}else if ($('.payment-difference').text() != '0')
			{
				swal("Error","Para poder finalizar el pago , el valor total del pago y el valor sumado No deben tener diferencia.", "error");	
				return false;
			} else if ($('#tabla-detalle-pago tbody').find('tr').size() == 0)
			{
				swal("Error", "Debe agregar alguna incapacidad a su pago.", "error");	
				return false;
			} else {
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
					objeto.push($(elemento).parent().find("td:nth-child(8) .btn-group").data('tipo-inc')); //tipo inc
					objeto.push($(elemento).parent().find("td:nth-child(5)").text()); //fecha corte
					objeto.push($(elemento).data('parcial')); //si es parcial o no
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
				var isParcial = false;

				var id = $(this).parent().data('id');
				var tipoinc = $(this).parent().data('tipo-inc');

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
						}else
						{
							isParcial = true;
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


							if(isParcial == true)
							{
								if(money > parent.find("td:nth-child(7)").text())
								{
									swal("Importante!", "El valor parcial no puede ser mayor al valor de la incapacidad.", "info");
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
							$('#tabla-detalle-pago tbody').find("tr:last").find('td:last').after('<td class="valor-incapacidad" data-parcial="'+isParcial+'">' + money + '</td>')
							//agregamos boton eliminar
							$('#tabla-detalle-pago tbody').find("tr:last").find('td:last').after('<td><div class="btn-group btn-group-xs" data-tipo-inc="'+ tipoinc +'" data-id="' + id + '"  role="group" aria-label="Small button group"><button data-nivel="1" data-nombre="Administrador" data-id="1" type="button" class="btn btn-success waves-effect delete-item"><i class="material-icons">delete</i></button></div></td>')
							$('#tabla-detalle-pago tbody tr').each(function(fila) {
								$this = $(this);
								total += parseFloat($this.find("td:nth-child(7)").text()); //$this.find("td:nth-child(5)").text();
								
							});

							$('.payment-total-value').text("");
							$('.payment-total-value').text(total);
							var difference = $('.payment-value-2').text() - $('.payment-total-value').text();
							$('.payment-difference').text(difference);
						}
					}else{

						var row = $(this).parents('tr').prop('outerHTML');
						$('#tabla-detalle-pago tbody').append(row);

							//eliminamos las dos ultimas columnas
							$('#tabla-detalle-pago tbody').find("tr:last").find("td:last").remove();
							$('#tabla-detalle-pago tbody').find("tr:last").find("td:last").remove();
							$('#tabla-detalle-pago tbody').find("tr:last").find("td:last").remove();
							$('#tabla-detalle-pago tbody').find("tr:last").find("td:last").remove();
							//agregamos valor
							$('#tabla-detalle-pago tbody').find("tr:last").find('td:last').after('<td class="valor-incapacidad" data-parcial="'+isParcial+'">' + money + '</td>')
							//agregamos boton eliminar
							$('#tabla-detalle-pago tbody').find("tr:last").find('td:last').after('<td><div class="btn-group btn-group-xs" data-tipo-inc="'+ tipoinc +'" data-id="' + id + '"  role="group" aria-label="Small button group"><button data-nivel="1" data-nombre="Administrador" data-id="1" type="button" class="btn btn-success waves-effect delete-item"><i class="material-icons">delete</i></button></div></td>')
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
			}

		});

$('#tabla-detalle-pago tbody').off('click').on('click', '.delete-item', function () {

	var total = 0;
	var row = $(this).parents('tr').remove();
	$('#tabla-detalle-pago tbody tr').each(function(fila) {
		$this = $(this);
					total += parseFloat($this.find("td:nth-child(7)").text()); //$this.find("td:nth-child(5)").text();
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

		    $('#eps-selected').val($('#payment-eps').val());
		    $('#eps-selected').change();
		    $('#eps-selected').attr('disabled',true);
		    $('#eps-selected').selectpicker("refresh");
		},
		Tabla : function()
		{
			t = $('#tabla-incapacidades').DataTable({
				
			});
		},
		cargarModal: function()
		{
			$('#open-filter').on("click", function(){

				if($('#payment-eps').val() == "")
				{
					swal("Error", "Debe seleccionar la EPS del pago.", "error");
				}else
				{
					$('#Modalnuevo').modal('show'); 
					pagos.Cargar();
					pagos.enviarDatos();

				}
				
			});
		},
		FiltrarInc : function()
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
			if ($('#eps-selected option:selected').val().length>0)
			{
				where+= ' AND inc.eps='+$('#eps-selected option:selected').val()+' '; 
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

			where+= ' AND inc.estado !=1 '; 
			return where;
		},
		enviarDatos: function () {
			$('.filtrar-boton').off('click').on('click', function () {
				
				$.ajax({
					url: 'pages/incapacidades/peticiones/peticiones.php',
					type: 'POST',
					data: {
						bandera: "filtrar",
						where: pagos.FiltrarInc()

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
									resp.datos[i].saldo,
									'<div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12"><input type="checkbox" id="' + i + '"><label for="' + i + '"></label></div>',
									'<div class="form-group"><div class="form-line"><input type="number" style="font-size:1.2em;width:65px" min="0" class="form-control payment-value" placeholder="$" /></div></div>',
									'<div class="btn-group btn-group-xs" data-tipo-inc="' + resp.datos[i].tipoincapacidad + '" data-id="' + resp.datos[i].id_incapacidad + "-" + resp.datos[i].fecha_corte + "-" + resp.datos[i].tipoincapacidad +'" role="group" aria-label="Small button group"><button data-nivel="1" data-nombre="Administrador" data-id="1" type="button" class="btn btn-success waves-effect add-item"><i class="material-icons">add</i></button></div>'
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