
$(document).ready(function(){
   $('#lupa').unbind('click');
   $('.descriptionContent').hide(); 
   $('.descriptionUnderContent').hide(); 
   $('.titleAction').click(function(){
        if($(this).parent().children('.descriptionContent').is(':visible')){
           $(this).parent().children('.descriptionContent').slideUp();
        }else{
           $('.descriptionUnderContent').slideUp();
           $('.descriptionContent').slideUp();
           $(this).parent().children('.descriptionContent').slideDown();
        }
    });
    $('.undertitleAction').click(function(){
        if($(this).parent().children('.descriptionUnderContent').is(':visible')){
           $(this).parent().children('.descriptionUnderContent').slideUp();
        }else{
           $('.descriptionUnderContent').slideUp();
           $(this).parent().children('.descriptionUnderContent').slideDown();
        }
    });

    $('.descriptionContent').each(function(index){
        if($(this).html().trim()!="<p>No hay resultados.</p>")
            $(this).slideDown();
    });
    var contador=0;
    $('.descriptionUnderContent').each(function(index){
        if($(this).html().trim().indexOf("<p>No hay resultados.</p>") < 0){
            $(this).slideDown();
        }else{contador++;}
        if(contador==3)
            $(this).parent().closest('.descriptionContent').hide();
    });
    $('#ultimo').click(function(){$("html, body").animate({ scrollTop: $(document).height() }, 1500);});
    $('.paginas').each(function(index){
        $(this).children('.pag[name="cat1"]').addClass('focused');
    });

    if($('#cliUnder').parent().html().indexOf("<p>No hay resultados.</p>") > -1) {
        $('#cliUnder').parent('.descriptionContent').hide();
    }

    $('.pag').click(function(){
        $(this).siblings('.pag').removeClass('focused');
        $(this).addClass('focused');
        var tipo = $(this).parent().parent().siblings('.underTitleAction').html();
        if (tipo === undefined || tipo === null) {
            tipo = $(this).parent().parent().siblings('.titleAction').html();
        }
        var id = $(this).attr('name');
        id = id.substr(3);
        $.post('AJAX/paginar.php', {keyWord: consulta, id: id, tipo: tipo}, function(data){
            switch (tipo){
                case "Clientes":
                    $('#cliUnder').html(data);
                    break;
                case "Subartículos":
                    $('#subArtUnder').html(data);
                    break;
                case "Artículos":
                    $('#artUnder').html(data);
                    break;
                case "Categorías":
                    $('#catUnder').html(data);
                    break;
            }
        });
    });
    
});