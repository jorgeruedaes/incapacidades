
var principal = {
    inicio: function()
    {

       $.ajax({
        url: 'php/peticiones.php',
        type: 'POST',
        data: {
            bandera: "get_menu"
        },
        success: function (resp) {

            var resp = $.parseJSON(resp);
            if (resp.salida === true && resp.mensaje === true) {
                var seleccionado;

                $('.menu-item').each(function(indice, elemento) 
                {

                    if($(elemento).data('padre')==resp.padre)
                    {
                       $(elemento).addClass("menu-item-active toggled");  
                       $(elemento).parent().find('ul').css("display", "block");
                   }

               });
                $('.submenu-item').parent().removeClass("active");
                $('.submenu-item').each(function(indice, elemento) 
                {

                    if($(elemento).data('hijo')==resp.hijo)
                    {
                        $(elemento).parent('li').addClass('active');
                    } 
                });

            } else {

            }
        }
    });
principal.recargar();
},
recargar : function()
{
    $('.submenu-item').off('click').on('click', function () {  
        var padre =$(this).data('padre');
        var hijo =$(this).data('hijo');
        $.ajax({
            url: 'php/peticiones.php',
            type: 'POST',
            data: {
                bandera: "set_menu",
                padre:  padre,
                hijo : hijo
            },
            success: function (resp) {

                var resp = $.parseJSON(resp);
                if (resp.salida === true && resp.mensaje === true) {

                } else {

                }
            }
        });
    });
    
    $('.init-item').off('click').on('click', function () {  
        var padre =$(this).data('padre');
        var hijo =$(this).data('hijo');
        $.ajax({
            url: 'php/peticiones.php',
            type: 'POST',
            data: {
                bandera: "delete_menu"
            },
            success: function (resp) {

                var resp = $.parseJSON(resp);
                if (resp.salida === true && resp.mensaje === true) {

                } else {

                }
            }
        });
    });

}

};
$( document ).ready(function() {     
    principal.inicio();
});