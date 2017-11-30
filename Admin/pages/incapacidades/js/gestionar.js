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
				where+= ' AND estado='+$('.select-estado option:selected').val()+' '; 
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


				var resp = $.parseJSON(resp);
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
		'csv', 'excel', 'pdf', 'print'
		],
		order: [[ 10, "desc" ]]

	});

},
enviarDatos: function () {
	$('.filtrar-boton').off('click').on('click', function () {
		
		var total =0;
		$.ajax({
			url: 'pages/incapacidades/peticiones/peticiones.php',
			type: 'POST',
			data: {
				bandera: "filtrar",
				where: incapacidades.Filtrar()

			},
			success: function (resp) {

				var resp = $.parseJSON(resp);
				if (resp.salida === true && resp.mensaje === true) {
					t.row($('#tabla-incapacidades').parents('tr') ).clear().draw();

					for (var i = 0; i < resp.datos.length; i++) {
						total = parseInt(resp.datos[i].valor) + parseInt(total);
					}					
					resp.datos.push({"id_incapacidad":'',"trabajador":'',"nombretrabajador":'',"eps":'',"tipo":'',"fecha_inicial":'',"fecha_final":'',"fecha_corte":'VALOR TOTAL',"cantidad":'',"valor":total,"estado":''})					

					for (var i = 0; i < resp.datos.length; i++) {
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
							resp.datos[i].estado 

							]).draw( false );
					}

					$('#Modalnuevo').modal('hide');
				} else {
					t.row($('#tabla-incapacidades').parents('tr') ).clear().draw();
					swal("Importante!", "No se han encontrado registros para ese filtro, intenta nuevamente.", "info");
				}
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



}
};
$(document).ready(function () {

	incapacidades.inicio();

});

});