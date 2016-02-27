function numToAbc(name){
    var abc = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
    var retorno="";
    for(var i=0; i<abc.length; i++){
        if(parseInt(name)==i) retorno=""+abc[i];
    }
    return retorno;
}

$(document).ready(function(){
    $(".subGran").hide();
    $('#a').show();
    $('.subart').mouseover(function(){
        var src = $(this).children().prop('src');
        $("#grande").attr('src', src);
        $('.subart').css("border-color", "lightgray");
        $(this).css("border-color", "orangered");
        var name = $(this).attr("name");
        $('.subGran').hide();
        var mostrar = numToAbc(name);
        $('#'+mostrar).show();
    });
});