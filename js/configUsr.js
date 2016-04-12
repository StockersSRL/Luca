function comprobarPass(){
    $('#errorP1').html("");
    $('#errorP2').html("");
    $('#errorA').html("");
    
    var clave1 = $('#nueva').val();
   	var clave2 = $('#repetir').val();
    var actual = $('#actual').val();
    $.post('js/configUsrAjax/passCheck.php', {password: actual}, function(data){
        console.log(data);
        if(data.trim()=="Contraseña actual incorrecta"){
            $('#errorA').text(data);
        }
    });
    var control = true;
    if (clave1 != clave2) {
      	 $('#errorP1').html("Las contraseñas no coinciden!");
         control=false;
		 document.getElementById("passBut").disabled = true;
	}
    if(clave1.length < 6){
                control=false;
				document.getElementById("passBut").disabled = true;	
				$('#errorP2').html("Nueva contraseña muy corta!");
    }
	if(control) document.getElementById("passBut").disabled = false;	
    if(clave1==clave2)      $('#errorP1').html("");
    if(clave1.lenght>5)      $('#errorP2').html("");
}

$(document).ready(function(){
    document.getElementById("passBut").disabled = true;
   $('.descriptionContent').hide(); 
   $('.titleAction').click(function(){
        if($(this).parent().children('.descriptionContent').is(':visible')){
           $(this).parent().children('.descriptionContent').slideUp();
        }else{
           $('.descriptionContent').slideUp();
           $(this).parent().children('.descriptionContent').slideDown();
        }
    });
    $('#ultimo').click(function(){$("html, body").animate({ scrollTop: $(document).height() }, 1500);});
});