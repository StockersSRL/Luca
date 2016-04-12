function content (){
    var altura = $(window).height();
    altura -= 180;
    $('#content').css("height", ""+altura);
}
$(document).ready(function(){
    $(document).click(function(){
        $('#msgHome').fadeOut(500);
    });

    var inicial_width = $(window).width();
    content();
    $('#lupa').click(function(){
        $('#content').css("height", "500px");
    });
    $(window).resize(function(){
        content();
        if(inicial_width!=$(window).width() && $(window).width()<944){
            $('#content').css("height", "553px");
        }
    });
    
});
