$(function() {

	var torneo = {
		inicio: function () {
			
		var docLocation = 'http://ligasantandereanadefutbol.co/torneocmarte/';
		window.open(docLocation,"resizeable,scrollbar"); 
		history.go(-1);
		}
	
	};

$(document).ready(function () {

	torneo.inicio();

});

});