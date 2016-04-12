$(document).ready(function(){
    var scroll;
    var total_width;
    window.setInterval(bug, 100);
    
    var total_width = $(window).width();
    
    function bug(){
        var scroll = $(window).scrollTop();
            if(scroll < 120){ 
                $('#logo2').hide();
                $('#b2').hide();
                $('#scrollup').hide();
            }
    }
    
    function hidePlus(){
        $('#lupa').hide();
        $('#usr').hide();
        $('#co').hide();
        $('#menuplus').hide();
        $('#menuplustri').hide();
    }
    
    function showPlus(){
        $('#lupa').show();
        $('#usr').show();
        $('#co').show();
        $('#menuplus').show();
        $('#menuplustri').show();
    }
    
    function adaptar(){
                $('#subheader').css("margin-top", "90px");
                $('#subheader').css("height", "35px");
                $('.sizable').css("height", "30px");
                $('.sizable').css("padding-top", "0px");
                $('.borde').css("height", "35px");
                $('#scrollup').hide();
                $('#logo2').hide();
                $('#acs').hide();
                if($('#searchheader').is(":visible")){
                    $('#searchheader').css("margin-top", "125px");
                    $('#content').css("margin-top", "160px")
                }
                $('#usr').css("position","relative");
                $('#usr').css("margin-top","0px");
                $('#co').css("position","relative");
                $('#co').css("top","0px");
                $('#co').css("margin-top","0px");
                $('#lupa').css("margin-top","0px");
                $('#lupa').css("margin-right","30px");
                $('#lupa').css("position","relative");
                $('#co').css("margin-right","10px");
                $('#co').css("right","0px");
                $('#usr').css("margin-right","10px");
                $('#usr').css("right","0px");
                $('#lupa').css("top","0px");
                $('#lupa').css("right","0px");
                $('#usermenu').css("margin-right", "80px");
                $('#usermenu').css("margin-top", "85px");
    }
    
    function scroller(){
    scroll = $(window).scrollTop();
            if (scroll >= 115){
                $('#header').css("position", "absolute");
                $('#subheader').css("position", "fixed");
                $('#subheader').css("margin-top", "0px");
                $('#subheader').css("height", "50px");
                $('.sizable').css("height", "40px");
                $('.sizable').css("padding-top", "5px");
                $('.borde').css("height", "50px");
                $('#scrollup').fadeIn(500);
                $('#listaInt1').css("margin-top", "8px");
                $('#listaInt2').css("margin-top", "8px");
                $('#listaInt3').css("margin-top", "8px");
                $('#listaInt4').css("margin-top", "8px");
                $('#listaInt5').css("margin-top", "8px");
                $('#listaInt6').css("margin-top", "8px");
                if(total_width>944) $('#logo2').fadeIn(500);
                if(movido){
                    $('#searchc').animate({"margin-right": '-='+input_width}, "slow");
                    $('#usermenu').animate({"margin-right": '-='+input_width}, "slow"); 
                    movido=false;
                }
                if($('#searchheader').is(":visible")){
                    $('#searchheader').css("margin-top", "50px");
                    $('#content').css("margin-top", "190px")
                }
                
                $('#usr').css("position","fixed");
                $('#co').css("position","fixed");
                $('#co').css("margin-right","100px");
                $('#co').css("right","30px");
                $('#co').css("top","-1e-05px");
                $('#co').css("margin-top","4px");
                $('#lupa').css("position","fixed");
                $('#lupa').css("float","right");
                $('#lupa').css("z-index","9");
                $('#lupa').css("top","2px");
                $('#lupa').css("right","1px");
                $('#lupa').css("margin-right","10px");
                $('#lupa').css("margin-top","2px");
                $('#usr').css("margin-top","10px");
                $('#usr').css("right","60px");
                $('#usr').css("margin-top","-20px");
                 $('#usermenu').css("margin-right", "66px");
                $('#usermenu').css("margin-top", "65px");
            }else{
                $('#header').css("position", "fixed");
                adaptar();
                $('#listaInt1').css("margin-top", "0px");
                $('#listaInt2').css("margin-top", "0px");  
                $('#listaInt3').css("margin-top", "0px");
                $('#listaInt4').css("margin-top", "0px");
                $('#listaInt5').css("margin-top", "0px");
                $('#listaInt6').css("margin-top", "0px");
            }
    }
    
    function mobile(){
        total_width = $(window).width();
        if(total_width<944){
            
            if(scroll>115){
                adaptar();
            }
            /*START MOBILE*/
         //   $('#1').css("height", "60px");
          //  $('#menu').css("width")
            /*END MOBILE*/
            $('#subheader').hide();
            $('#rayas').hide();
            $('#nombre').hide();
            $('#date').hide();
            $('#nav-toggle').show();
            $('#plus').show();
            $('#lupa').css("margin-right", "-155px");
            $('#lupa').css("margin-top", "7px");
            $('#usr').css("margin-right", "-107px");
            $('#usr').css("margin-top", "7px");
            $('#co').css("margin-right", "-55px");
            $('#co').css("margin-top", "7px")
            $('#searchheader').css("margin-top", "90px");
            $('#plus').css("margin-top", "-55px");
            $('#plus').css("margin-right", "20px")
            $('#header').css("position", "fixed");
            $('#header').css("height", "90px");
            $('#logo').css("height", "30px");
            $('#content').css("margin-top", "80px");
            $('#limage').css("margin-left", "-10px");
            $('#usermenu').css("margin-right", "138px");
            $('#usermenu').css("margin-top", "140px");
            $('#tri2').css("margin-right", "-60px");
            if(movido){
                    $('#searchc').animate({"margin-right": '-='+input_width}, "slow");
                    $('#usermenu').animate({"margin-right": '-='+input_width}, "slow"); 
                    movido=false;
            }

            $('#searchheader').css("margin-top", "90px");
                $('#listaInt1').css("margin-top", "-35px");
                $('#listaInt2').css("margin-top", "-35px");  
                $('#listaInt3').css("margin-top", "-35px");
                $('#listaInt4').css("margin-top", "-35px");
                $('#listaInt5').css("margin-top", "-35px");
                $('#listaInt6').css("margin-top", "-35px");
            hidePlus();
        }else{
            $('#menuplustri').hide();
            $('#subheader').show();
            if($('#mmenu').is(':visible')){
                $('#mmenu').hide();
            }
            $('#plus').hide();
            $('#co').show();
             $('#usr').show();
            $('#usr').css("margin-top", "0px");
            $('#usr').css("margin-right", "10px");
            $('#lupa').show();
            $('#rayas').show();
            $('#nombre').show();
            $('#date').show();
            $('#nav-toggle').hide();
            $('#header').css("position", "absolute");
            $('#header').css("height", "90px");
            $('#logo').css("height", "40px");
            $('#content').css("margin-top", "130px");
            $('#tri2').css("margin-right", "0px");
            $('#limage').css("margin-left", "0px");
            if(scroll>115){
                $('#usr').css("margin-top","10px");
                $('#usr').css("right","60px");
                $('#usr').css("margin-top","-20px");
                $('#searchheader').css("margin-top", "50px");
                $('#usermenu').css("margin-right", "66px");
            }else{
                $('#usermenu').css("margin-right", "80px");
                $('#searchheader').css("margin-top", "125px"); 
                $('#searchheader').css("margin-top", "125px"); 
            }
        }
    }
    
    function searchf(){
        if($('#searchheader').is(":hidden")){
            $('#searchheader').show();
            $('#content').css("margin-top", "160px");
            if(scroll>115){
                $('#searchheader').css("margin-top", "50px");
            }else{
                $('#searchheader').css("margin-top", "125px");
            }
            if(total_width<944){
                 $('#searchheader').css("margin-top", "90px");
            }
        }else{
            $('#searchheader').hide();
            $('#content').css("margin-top", "130px");
        }
    }
    
    $('#scrollup').hide();
    $('#logo2').hide();
    $('#usermenu').hide();
    $('#nav-toggle').hide();
    $('#searchheader').hide();
    $('#listaInt1').hide();
    $('#listaInt2').hide();
    $('#listaInt3').hide();
     $('#listaInt4').hide();
      $('#listaInt5').hide();
      $('#listaInt6').hide();
    $('#plus').hide();
    
    var movido = false;
    
    var input_width = $('#big').width()+70;
    
    function animateBk(id, color){
        $(id).css("background-color", color);
        $(id).css("color", "white");
    }
    
    function animateBki(id){
        $(id).css("background-color", "white");
        $(id).css("color", "black");
    }
    
    $(window).scroll(function () {
        var total_width = $(window).width();
        var scroll = $(window).scrollTop();
        if (scroll >= 115)   $("#scrollup").show();
        if(total_width>944){
           scroller();
        }
    });
    
    $('#lupa').click(function(){
        $('#usermenu').hide();
        if(!$('#searchheader').is(':visible') && total_width<944) hidePlus();
        searchf();
    });
    
    mobile();
    
	$('#exit').mouseover(function () {
        this.src = 'images/exit2.svg';
    });
    
	$('#exit').mouseout(function () {
        this.src = 'images/exit1.svg';
    });

    $('#1').mouseover(function(){animateBk('#1', "#5F64B7");});
    $('#2').mouseover(function(){animateBk('#2', "#68B4FA");});
    $('#3').mouseover(function(){animateBk('#3', "#C53139");});
    $('#4').mouseover(function(){animateBk('#4', "green");});
    $('#5').mouseover(function(){animateBk('#5', "#EF8B13");});
    $('#6').mouseover(function(){animateBk('#6', "#52206E");});
    
    $('#1').mouseout(function(){animateBki('#1');});
    $('#2').mouseout(function(){animateBki('#2');});
    $('#3').mouseout(function(){animateBki('#3');});
    $('#4').mouseout(function(){animateBki('#4');});
    $('#5').mouseout(function(){animateBki('#5');});
    $('#6').mouseout(function(){animateBki('#6');});
    
    $('#exit').click(function(){
        $('#searchc').animate({"margin-right": '-='+input_width}, "slow");
        if(movido){
            $('#usermenu').animate({"margin-right": '-='+input_width}, "slow");
        }
        movido = false;
    });

    $('#usr').click(function(){
        if($('#usermenu').is(":visible")){
            $('#usermenu').hide();
        }else{
            $('#usermenu').show();
        }
    });
    $('#plus').click(function(){
        if($('#subheader').is(':visible')) $('#subheader').hide();
        if($('#menuplus').is(":visible") && total_width<944){
            hidePlus();
            $('#usermenu').hide();
        }else{
            showPlus();
        }
    });
    
    $("#scrollup").click(function() {
        $('html, body').animate({
            scrollTop: $("#target").offset().top}, 2000);
    });
    
    $( window ).resize(function() {
        $('#usermenu').hide();
        var total_width = $(window).width();
        scroller();
        mobile();
    });
    var rayas = 1;
	$('#mmenu').hide();
	$('#nav-toggle').click(function(){
        $('#usermenu').hide();
        hidePlus();
		if($("#subheader").is(":hidden")){
						$("#subheader").fadeIn(1000);
				  } else {
					    $("#subheader").hide();
				  }
        $('#1').css("background-color", "white");
        $('#2').css("background-color", "white");
        $('#3').css("background-color", "white");
        $('#4').css("background-color", "white");
        $('#5').css("background-color", "white");
        $('#6').css("background-color", "white");
        
        
	});
	$('#nav-toggle').click(function () {
        if(rayas == 1){
			rayas = 0;
		}else{
			rayas = 1;
		}
    });
    $( "#1" ).mouseover(function(){$('#listaInt1').show();});
    $( "#1" ).mouseout(function(){$('#listaInt1').hide();  if(scroll<115){$( "#1" ).css("height", "30px");}});
    $( "#2" ).mouseover(function(){$('#listaInt2').show();});
    $( "#2" ).mouseout(function(){$('#listaInt2').hide();  if(scroll<115){$( "#2" ).css("height", "30px");}});
    $( "#3" ).mouseover(function(){$('#listaInt3').show();});
    $( "#3" ).mouseout(function(){$('#listaInt3').hide();  if(scroll<115){$( "#3" ).css("height", "30px");}});
    $( "#4" ).mouseover(function(){$('#listaInt4').show();});
    $( "#4" ).mouseout(function(){$('#listaInt4').hide();  if(scroll<115){$( "#4" ).css("height", "30px");}});
    $( "#5" ).mouseover(function(){$('#listaInt5').show();});
    $( "#5" ).mouseout(function(){$('#listaInt5').hide();  if(scroll<115){$( "#5" ).css("height", "30px");}});
    $( "#6" ).mouseover(function(){$('#listaInt6').show();});
    $( "#6" ).mouseout(function(){$('#listaInt6').hide();  if(scroll<115){$( "#6" ).css("height", "30px");}});
    $('#wrapper').click(function () {
        if($('#usermenu').is(":visible")){
            $('#usermenu').hide();
        }
        if($('#menuplus').is(":visible") && total_width<944){
            hidePlus();
        }
        if($("#subheader").is(":visible") && total_width<944) $('#subheader').hide();
    });
    document.querySelector( "#nav-toggle" )  .addEventListener( "click", function() {    this.classList.toggle( "active" );  });
});

