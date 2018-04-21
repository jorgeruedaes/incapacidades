//	var Creador = '<?php echo $usuario['id_incapacidades']; ?>'
$(function() {
	var t ='';
	var incapacidades = {
		inicio: function () {
			incapacidades.recargar();
			incapacidades.Cargar();
		},
		recargar: function () {
			incapacidades.enviarDatos();
			incapacidades.Tabla();
			incapacidades.SeleccionEmpresa();
			incapacidades.BuscarCliente();
			incapacidades.AgregarItem();
			incapacidades.cargarModal();


		},
		Filtrar : function()
		{
			var where="WHERE 1=1 ";

			if ($('.f-codigo').val().length>0)
			{
				where+= ' AND id_incapacidad='+$('.f-codigo').val()+' '; 
			}
			if ($('.f-codigodesde').val().length>0 && $('.f-codigohasta').val().length>0 )
			{
				where+= ' AND id_incapacidad BETWEEN '+$('.f-codigodesde').val()+' AND '+$('.f-codigohasta').val()+'  '; 
			}
			if ($('.f-fechacortedesde').val().length>0 && $('.f-fechacortehasta').val().length>0 )
			{
				where+= ' AND fecha_corte BETWEEN "'+$('.f-fechacortedesde').val()+'" AND "'+$('.f-fechacortehasta').val()+'"  '; 
			}
			if ($('.f-fechainicialdesde').val().length>0 && $('.f-fechainicialhasta').val().length>0 )
			{
				where+= ' AND fecha_inicial BETWEEN "'+('.f-fechainicialdesde').val()+'" AND "'+$('.f-fechainicialhasta').val()+'"  '; 
			}
			if ($('.select-estado option:selected').val().length>0)
			{
				where+= ' AND inc.estado='+$('.select-estado option:selected').val()+' '; 
			}
			if ($('.select-tipo :selected').val().length>0)
			{
				var x =[];
				where+= ' AND tipo in(' 
					$('.select-tipo :selected').map(function(i, el) {
						if ($(el).val().length>0){
							x.push($(el).val());
						}
					});
					where+=x.join();

					where+= ' )'
}
if ($('.select-eps option:selected').val().length>0)
{
	where+= ' AND eps='+$('.select-eps option:selected').val()+' '; 
}
if ($('.select-ciudad option:selected').val().length>0)
{
	where+= ' AND ciudad='+$('.select-ciudad option:selected').val()+' '; 
}
if ($('.select-empresa option:selected').val().length>0)
{
	where+= ' AND cliente in (select id_clientes from tb_clientes where empresa='+$('.select-empresa option:selected').val()+') '; 
}
if ($('.select-cliente option:selected').val().length>0)
{
	where+= ' AND cliente='+$('.select-cliente option:selected').val()+' '; 
}
if ($('.f-cedula').val().length>0)
{
	where+= ' AND trabajador='+$('.f-cedula').val()+' '; 
}

return where;
},
Cargar : function()
{
	var $demoMaskedInput = $('.demo-masked-input');

    //Date
    $demoMaskedInput.find('.date').inputmask('yyyy-mm-dd', { placeholder: '____-__-__' });

},

BuscarCliente : function()
{
	$( ".f-acronimo" ).blur(function() {
		var acronimo;
		var numero="";
		for (var i = 1; i <$('#select-cliente').children().size(); i++) 
		{
			acronimo = $('#select-cliente').find('option')[i].dataset.acronimo;

			if(acronimo == $('.f-acronimo').val().toUpperCase())
			{
				numero = $('#select-cliente').find('option')[i].value;
			}
		}
		if(numero.length < 1)
		{
			swal("Importante", "No hay ningun Cliente que tenga ese Acronimo", "info");
		}


		$('.select-cliente').val(numero);
		$('.select-cliente').change();
		incapacidades.BuscarCliente();
	});


},
AgregarItem: function()

{

	$('#tabla-incapacidades tbody').on('click', '.delete-item', function () {

				//idpago
				var id = $(this).parent().data('id');
				var tipo = $(this).parent().data('tipo');
				var fechacorte = $(this).parent().data('corte');
		
				swal({title: "¿Está seguro que desea ELIMINAR la INCAPACIDAD?",
						text: "",
						type: "warning",
						confirmButtonText: "Aceptar",
						showCancelButton: true,
						confirmButtonColor: "rgb(174, 222, 244)",

						closeOnConfirm: false
					}, function (isConfirm) {
						if (isConfirm) {

							$.ajax({
								url: 'pages/incapacidades/peticiones/peticiones.php',
								type: 'POST',
								data: {
									bandera: "eliminar-incapacidad",
									idincapacidad: id,
									tipo: tipo,
									fechacorte: fechacorte,
									
								},
								success: function (resp) {

									var resp = $.parseJSON(jQuery.trim(resp));;
									if (resp.salida === true && resp.mensaje === true) {
										swal({title: "Información",
											text: "Se ha eliminado la incapacidad de manera exitosa!",
											type: "success",
											confirmButtonText: "Aceptar",
											showCancelButton: false,
											confirmButtonColor: "rgb(174, 222, 244)",
											closeOnConfirm: false
										}, function (isConfirm) {
											if (isConfirm) {
												window.location.reload();
												//window.location.href = "pages/pagos/gestionar.php";  
											}
										});

									} else {
										swal("", "Ha ocurrido un error, intenta nuevamente.", "error");
									}
								}
							});
						}
					});

			});
$('#tabla-incapacidades tbody').on('click', '.edit-item', function () {

	//idpago
	var id = $(this).parent().data('id');
	var tipo = $(this).parent().data('tipo');
	var fechacorte = $(this).parent().data('corte');
			 
		window.location.href = "pages/incapacidades/editarincapacidad.php?id="+id + "&tipo=" + tipo + "&corte=" + fechacorte;  
	});

},
SeleccionEmpresa : function()
{
	$('.select-empresa').on('change', function () {
		$.ajax({
			url: 'pages/incapacidades/peticiones/peticiones.php',
			type: 'POST',
			data: {
				bandera: "getclientes",
				empresa:  $('.select-empresa option:selected').val()

			},
			success: function (resp) {


				var resp = $.parseJSON(jQuery.trim(resp));;
				if (resp.salida === true && resp.mensaje === true) {
					$('#select-cliente').html('').selectpicker('refresh');
					$('.f-acronimo').val('');
					$('#select-cliente').append('<option value="">--Selecciona Cliente --</option>').selectpicker('refresh');
					for (var i = 0; i < resp.datos.length; i++) {
						$('#select-cliente').append('<option value='+resp.datos[i].id_clientes+'  data-acronimo='+resp.datos[i].acronimo+'   >'+resp.datos[i].nombre+'</option>').selectpicker('refresh');

					}
				} else {
					$('#select-cliente').html('').selectpicker('refresh');
					$('#select-cliente').append('<option value="">--Selecciona Cliente --</option>').selectpicker('refresh');

				}
			}
		});


	});


},
Tabla : function()
{
	t = $('#tabla-incapacidades').DataTable({
		dom: 'Bfrtip',
		searching: true,
		paging: false,
		ordering: true,
		info:     true,
		buttons: [
		'csv', 'excel', {
			extend: 'pdfHtml5',
			orientation: 'landscape',
			pageSize: 'LEGAL',
			customize: function ( doc ) {
                // Splice the image in after the header, but before the table
                doc.content.splice( 1, 0, {
                	margin: [ 0, 0, 0, 12 ],
                	alignment: 'left',
                	image: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAEm0lEQVRYhb2XXWwUVRTHf3dm2m4LrW1YUSkIJkuVVE1hw0cjIBFFEwMK4YkHLLGJig+CSEltCGIFw4cfm1R9sCGmhgRNeFBeJApopDyUuDxIxFQKFKgtUArdbbf7MTPHh90psDvddqFykpud3Jy5/98599xzZxV3a42zS9HZjkYFmtpMXfD03Syjcn6jYbaBTi0GjejKiw7omGg0A1vZFOz9/wC2VC1BJ4Cunk4Jg6649cxNFI2YNPFeMD5+AHVVM7DZg8bqTNG0Zw1A2hE2szH442hLa6M5rHrDtx6RMyhWY0PmEBBSQ1JhqQo09QOfzzl8zwBfdF974cClHk9FPJVRR2hY1AVKxIF57p4BAJ6NRDlyvouPrl6n1LTSxNKAGM5CcowHAIABvH4zxIlzl1nXF0J3Uu+AKCCPZB2MQThnAMfKbJudV67zS8dlFoUjSeFCBR5Ay/1U5wzg2BOxBN+d72F/wQUey4/lFPW4AEAy+Jfpp42/+JDLFGPdXwDHChA2cIVTnGYtvWhOId4vAMcmY9JEJ79yhmrC4wAQ8Oe3T5rmzRWkiiF+op1vrl2ji9pHs/m6V07AD7AC+GRV+fu+5d29LDyxl4mDVzNcC6vDaEX2HXMSNYj/XEX82FNg6RFgL7CrnObI6AAB/5PAZ8DzACunNlBRXI2RiDD3j6/xn9qHYcVcAUTAPOkjdmguEpqQvvJFYAtwoJxmF4CA3ws0ArUk+w63AzhWHOpiUetuZnYcTraAFIDV+SDRg9XYnZMzYkqz48A75TQHkwABfz6wHtgGlKZ7pwM4Vt7VxpLfdzLtodPEj/gx22aSw+1uA/uABp2XHtkJNKKUx81zVsliJhVMy5i/WTyFb6evpHJHlz2x3asU+ljFEUQdrOyb8+aKDmWAyseS5LVqMGo7FREuxCxa++OELGHAjmk3VDdFUoaHUtQoB6ujLEr9sk5ap4dB0Ib3GguIAYYNHvcLpS9h0xqKcymW1vGUEFF9RCVEkXjJZwIqbTtiuk3T/B6a5ncT1yW5CTjF5jQuERgCBgWKgMLUy7ZwMhznz0Eza4+zlcmA6sGQQiaIF4MCAI5PD1G/rJNzZbGMd4yMGScbN2wYgLNlJscHI0RtV09XM9UQ/VwiWlRs71oa0Q5W9qXqMy2rIhi3onf5jcM//SZ5JWMXBzA14ftnEnz54r+EhrKQy0gZyOEySbcTFSa7V8Y497Cd3NJs38aSUQN3r3/Ra7PnlSi/VVp3ZlrPcqpGzkDKxtBXBj3Cp8uj7F+cIOG2WjYFGwxEDiG8ijDDoRqj2UDL27U3znSXJhoA90oZqT+JHAW+0ng3eBRLZiGyFWFgGCI7SBtQHa7xrevedmw38DjQwvDpvh1ApQ16UbxGXC2l/tTZO5P8wewpmOzClDWYaGjgmVpHXsk8x6MHqAdawjW+TLGAfwEQAOalorRBpVqjgNCCzabb/z+67/KWqnlYBNBYkAKIA03A9nCNL5Q1NwG/BqwFPkZkMkppiLQjvMXG4NF095HLrK5KA9Z4yjcsz3tg4bZwje/vrMKZICXYshVFFIsdbApG3dz+A/Py0oPaSa/CAAAAAElFTkSuQmCC'
                } );
                // Data URL generated by http://dataurl.net/#dataurlmaker
            }
        }, {
        	extend: 'print',
        	text: 'Imprimir',
        	messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.'
        }

        ],
        order: [[ 11, "desc" ]]

    });

},
enviarDatos: function () {
	$('.filtrar-boton').off('click').on('click', function () {
		 $('body').css( "cursor", "wait" );
		var total =0;
		var saldo = 0;
		var totaldias =0;
		$.ajax({
			url: 'pages/incapacidades/peticiones/peticiones.php',
			type: 'POST',
			data: {
				bandera: "filtrar",
				where: incapacidades.Filtrar()

			},
			success: function (resp) {

				var resp = $.parseJSON(jQuery.trim(resp));
				if (resp.salida === true && resp.mensaje === true) {
					t.row($('#tabla-incapacidades').parents('tr') ).clear().draw();

					for (var i = 0; i < resp.datos.length; i++) {
						total = parseInt(resp.datos[i].valor) + parseInt(total);
						saldo = parseInt(resp.datos[i].saldo) + parseInt(saldo);
						totaldias = parseInt(resp.datos[i].cantidad) + parseInt(totaldias);

					}	
					// falta agregar los dias 				
					resp.datos.push({"id_incapacidad":'TOTALES: ',"trabajador":'',"nombretrabajador":'',"eps":'',"tipo":'',"fecha_inicial":'',"fecha_final":'',"saldo":saldo,"fecha_corte":'',"cantidad":totaldias,"valor":total,"estado":''})					

					for (var i = 0; i < resp.datos.length; i++) {

						if(resp.datos[i].estado == "PENDIENTE" || resp.datos[i].estado=="CORRESPONDE A EMPRESA" || resp.datos[i].estado=="MAS DE 180 DIAS")
						{
							t.row.add( [ 
							resp.datos[i].id_incapacidad,
							resp.datos[i].trabajador,
							resp.datos[i].nombretrabajador,
							resp.datos[i].eps,
							resp.datos[i].tipo,
							resp.datos[i].fecha_inicial,
							resp.datos[i].fecha_final,
							resp.datos[i].fecha_corte,
							resp.datos[i].cantidad,
							resp.datos[i].valor,
							resp.datos[i].saldo,
							resp.datos[i].estado,
							'<div class="btn-group btn-group-xs" data-corte="'+resp.datos[i].fecha_corte+'" data-tipo = "'+ resp.datos[i].tipoincapacidad +'" data-id="'+ resp.datos[i].id_incapacidad + '" role="group" aria-label="Small button group"><button data-nivel="1" data-nombre="Administrador" data-id="1" type="button" class="btn btn-success waves-effect edit-item"><i style="font-size:15px" class="material-icons">edit</i></button><button data-nivel="1" data-nombre="Administrador" data-id="1" type="button" class="btn btn-danger waves-effect delete-item"><i class="material-icons" style="font-size:15px">delete</i></button></div>'
							]).draw( false );

						}else
						{
							t.row.add( [ 
							resp.datos[i].id_incapacidad,
							resp.datos[i].trabajador,
							resp.datos[i].nombretrabajador,
							resp.datos[i].eps,
							resp.datos[i].tipo,
							resp.datos[i].fecha_inicial,
							resp.datos[i].fecha_final,
							resp.datos[i].fecha_corte,
							resp.datos[i].cantidad,
							resp.datos[i].valor,
							resp.datos[i].saldo,
							resp.datos[i].estado,
							''


							]).draw( false );

						}
					}

					$('#Modalnuevo').modal('hide');
					 $('body').css( "cursor", "auto" );
				} else {
					 $('body').css( "cursor", "auto" );
					t.row($('#tabla-incapacidades').parents('tr') ).clear().draw();
					swal("Importante!", "No se han encontrado registros para ese filtro, intenta nuevamente.", "info");
				}
						incapacidades.AgregarItem();

			}
		});
});
},
cargarModal: function()
{
	$('.filtro').on("click", function(){
		$('#Modalnuevo').modal('show'); 
		incapacidades.Cargar();
		incapacidades.enviarDatos();
	});

	$('.add-incapacidad').on("click", function(){
		incapacidades.Cargar();
		incapacidades.enviarDatos();
		window.location.href = "pages/incapacidades/nuevo.php";  
	});


}
};
$(document).ready(function () {

	incapacidades.inicio();

});

});