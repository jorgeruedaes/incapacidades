$(function() {

	var partidos = {
		inicio: function () {
			
		var docLocation = 'webs/Archivos/Reglamentos/REGLAMENTO_2016.pdf';
		window.open(docLocation,"resizeable,scrollbar"); 
		history.go(-1);

		}
	
	};

$(document).ready(function () {

	partidos.inicio();

});

});