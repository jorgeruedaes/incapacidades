$(function() {

	var partidos = {
		inicio: function () {
			
			$('[data-toggle="tooltip"]').tooltip(); 
			partidos.detalleProgramacion();
			partidos.Filtro();
		},
		detalleProgramacion: function () {
			$('.calendar-detail').on('click', function () {
				var element = $(this).attr('id');
				window.location.href = "webs/Index/programacion.php?id=" + element + "";
			});

			$('.calendar-category').on('click', function () {
				var element = $(this).attr('id');
				window.location.href = "webs/TorneoMunicipal/Categoria.php?id=" + element + "";
			});
			$('.file-category').on('click', function () {
				var element = $(this).attr('id');
				window.open(element);
			});
			$('.calendar-court').on('click', function () {
				var element = $(this).attr('id');
				window.location.href = "webs/TorneoMunicipal/cancha.php?id=" + element + "";
			});

			$('.positions-detail').on('click', function () {
				var element = $(this).attr('id');
				window.location.href = "webs/TorneoMunicipal/Categoria.php?id=" + element + "";

			});
			$('.results-detail').on('click', function () {
				var element = $(this).attr('id');
				window.location.href = "webs/TorneoMunicipal/resultado.php?id=" + element + "";

			});

			$('.open-category').on('click', function () {
				var element = $(this).attr('id');
				window.location.href = "webs/TorneoMunicipal/Categoria.php?id=" + element + "";
			});
			
			$('.news-detail').on('click', function () {
				var element = $(this).attr('id');
				window.location.href = "webs/Noticias/noticia.php?id=" + element + "";

			});

			jQuery('.calendar-image').hover(function () {
				jQuery(this).find('.court-name-big').css({ 'color': '#e95842' });
				jQuery(this).find('.fa-calendar').css({ 'color': '#e95842' });
			}, function () {
				jQuery(this).find('.court-name-big').css({ 'color': 'black' });
				jQuery(this).find('.fa-calendar').css({ 'color': '#999999' });
			});

			$('#sendEmailBtn').on('click', function () {
				$.ajax({
					url: 'Admin/php/peticiones.php',
					type: 'POST',
					data: {
						bandera: "EnviarCorreo",
						nombre: $('#nombre').val(),
						email :$('#email').val(),
						asunto: $('#asunto').val(),
						mensaje: $('#mensaje').val()
					},
					success: function (resp) {

						var resp = $.parseJSON(resp);
						if (resp.salida === true && resp.mensaje === true) {
							swal({title: "",
								text: "Tu mensaje se envió exitosamente, pronto nos comunicaremos contigo!",
								type: "success",
								showCancelButton: false,
								confirmButtonColor: "rgb(174, 222, 244)",
								confirmButtonText: "Ok",
								closeOnConfirm: false
							}, function (isConfirm) {
								if (isConfirm) {
									window.location.reload();
								}
							});
						} else {
							swal("", "Ha ocurrido un error al enviar el mensaje, intenta nuevamente.", "error");
						}
					}
				});

			});

		},
		Filtro : function()
		{
			$(".filtro").on('keyup', function(){
				var text = $(".filtro").val().toUpperCase();

				if (text == '')
				{
					$('.filtros').each(function() {
						$(this).fadeIn('slow').removeClass('hidden');
					});


				}
				else
				{

					$('.filtros').each(function() {

						if  ($(this).find('.texto').text().includes(text)>0)
						{
							$(this).fadeIn('slow').removeClass('hidden');
						}
						else
						{
							$(this).fadeOut('normal').addClass('hidden');
						}
					});


				}

			});

		}
	};

	$(document).ready(function () {

		partidos.inicio();

	});

});