var timer; 
var currentBackground = 0;
var backgrounds = [];
backgrounds[0] = 'images/4.jpg';
backgrounds[1] = 'images/1.jpg';
backgrounds[2] = 'images/2.jpg';
backgrounds[3] = 'images/3.jpg';

function original(uno, dos, tres){
	$(uno).attr( "src", "images/slide1.svg" );
	$(dos).attr( "src", "images/slide1.svg" );
	$(tres).attr( "src", "images/slide1.svg" );
}

function cambio(destino){
	switch(destino){
	case 0:
		$("#in").html("<font size=7>4</font>");
		$("#i4").attr( "src", "images/slide2.svg" );
		original("#i1", "#i2", "#i3");
		break;
	case 1:
		$("#in").html("<font size=7>1</font>");
		$("#i1").attr( "src", "images/slide2.svg" );
		original("#i4", "#i2", "#i3");
		break;
	case 2:
		$("#in").html("<font size=7>2</font>");
		$("#i2").attr( "src", "images/slide2.svg" );
		original("#i4", "#i1", "#i3");
		break;
	case 3:
		$("#in").html("<font size=7>3</font>");
		$("#i3").attr( "src", "images/slide2.svg" );
		
		original("#i1", "#i2", "#i4");
		break;
	}

}
function foto(currentBackground){
	if(currentBackground == 4) currentBackground = 0;
	$('#img').fadeOut(500,function() {
		$('#img').css({
			'background' : "url('" + backgrounds[currentBackground] + "') no-repeat center center fixed"
		});
        $('#img').css("background-size", "cover");
        $('#img').css("height", "100%");
		$('#img').fadeIn(500);
	});
	return currentBackground;
}

function changeBackground() {
	currentBackground++;
	currentBackground = foto(currentBackground);
	cambio(currentBackground);
	timer = setTimeout(changeBackground, 5000);
}

function changeBackgroundTo(destination){
	currentBackground = destination;
	currentBackground = foto(currentBackground);
	cambio(currentBackground);
	timer = setTimeout(changeBackground, 5000);
}

$(document).ready(function(){
    $('#prop').hide();
    var height = $( window ).height();
    $('#img').css("height", height);
    setTimeout(changeBackground, 0);  
    $(".bsl").click(function(){
		var id = $(this).attr('id');
		var destination = parseInt(id.charAt(1));
        if(destination != currentBackground){
		  if(destination != currentBackground+1){
             clearTimeout(timer);
			 changeBackgroundTo(destination);
		  }else{
             clearTimeout(timer);
			 changeBackground();
		  }
        }
	});
    $('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});
    
});