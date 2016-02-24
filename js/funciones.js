var xmlHttp = createXmlHttpRequestObject();
var forms = 0;
var tags = 0;
//addForm();

function init(){
//    document.getElementById("btn-mas").disabled = true; 
    setSuggestions();
}

//Fake input
$(window).ready(function(){
    $('#input-box').keyup(function(e){
       if(e.which == 13 && $(this).val() != 0){
           tags++;
           var valor = $(this).val();
           ($('<span class="tag-box" id="tag'+ tags +' ">'+valor+'<span class="close-tag" id="clos-tag'+tags + '" > X</span></span>')).insertBefore($(this));
           $(this).val('');
           $(this).attr('placeholder','');
           $(this).attr('style', '');
           $('#close-tag'+tags).click(function(){
              $(this).remove(); 
               tags--;
           });
       } 
    });
    $('#fake-input').click(function(e){
        var tagBoxes = $('.tag-box');
        if(!tagBoxes.is(e.target) && tagBoxes.has(e.target).length === 0){
            $('input-box').focus();
        }else if($('.close-tags').is(e.target)){
            e.target(),parent().remove();
        }
    });
    
    //AJAX usuario alta usuario
    $('#user').keyup(function(){
        $.post('userExists.php','q='+$(this).val(),function(data){
            var valor = JSON.parse(data);
            if(valor){
                $('#user').addClass(' error');
            }else{
                $('#user').removeClass(' error');
            }
        });      
    });
});



function createXmlHttpRequestObject(){
    var xmlHttp;
    if(window.XMLHttpRequest){
        xmlHttp = new XMLHttpRequest();
        return xmlHttp;
    }else{
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        return xmlHttp;
    }
}

function setSuggestions(){
$(window).ready(function(){
    $('.suggest-box').hide();
    $('input[id^="name"]').bind('keyup',function(e){
        if(e.which == 40){
            console.log( $(this).next('.suggest-box').find('li'));
            $(this).next('.suggest-box').find('li')[0].className += 'selected';
        }
        var pista = $(this).val();
        var caller = $(this);
        if(pista==''){
            $(this).next('.suggest-box').hide();
        }else{
            $(this).next('.suggest-box').show();
            $.post('suggestNames.php','q=' + pista,function(data){
                data=="<ul></ul>"? caller.next('.suggest-box').hide():
                                        caller.next('.suggest-box').html(data);
                caller.next('.suggest-box').find('li').click(function(){
                caller.val($(this).text());
                    caller.next('.suggest-box').hide();
                    });
                });
            }
    ;})
    //Esconder sugerencias en click    
    $(document).mouseup(function(e){
        var container = $(".suggest-box");
        if(!container.is(e.target) && container.has(e.target).length === 0){
            container.hide();
        }
    });
    
});
}
function btnMasActivar(valor){
    var btnMas = document.getElementById("btn-mas");
    if(valor=="No"){
        btnMas.disabled = true;
        btnMas.style.background = "#F0F0F0";
        btnMas.style.cursor = "default";
    }else{
        btnMas.disabled = false;
        btnMas.style.background = "#8DD322";
        btnMas.style.cursor = "pointer";
    }
}


function addForm(){
    
    //Titulo
    var unForm = document.createElement("div");
    unForm.className +="unForm border-form";
    unForm.id = "form" + forms;
    var node = document.createElement("DIV");
    node.className += "col-1";
    //Crea un nodo complejo
    var node2 =document.createElement("label");
    var node3 = document.createElement("h2");
    var texto = document.createTextNode("Subarticulo: " + (forms +1) );
    node3.appendChild(texto);
    var btn = $('<button/>',{text:'-',class:'dlt-frm-btn'});//document.createElement('button');
    btn.on('click',deleteForm);
    btn.val(forms);
    node2.appendChild(node3);
    btn.appendTo(node2);
    node.appendChild(node2);
    unForm.appendChild(node);
    
    //Distincion
    node = document.createElement("DIV");
    node.className += "col-2";
    //Crea un nodo complejo
    node2 =document.createElement("label");
    node3 = document.createElement("input");
    node3.setAttribute("placeholder","Distinción");
    node3.setAttribute("type","text");
    node3.setAttribute("name","name" + forms);
    node3.setAttribute("autocomplete","off");
    node3.id = "name" + forms;
    var node4 = document.createElement('div');4
    node4.className = "suggest-box suggest-col-2";
    texto = document.createTextNode("Distincion");
    node2.appendChild(texto);
    node2.appendChild(node3);
    node2.appendChild(node4);
    node.appendChild(node2);
    unForm.appendChild(node);
    
    //Codigo
    node = document.createElement("DIV");
    node.className += "col-2";
    //Crea un nodo complejo
    node2 =document.createElement("label");
    node3 = document.createElement("input");
    node3.setAttribute("placeholder","Código del artículo");
    node3.setAttribute("type","text");
    node3.setAttribute("name","codigo" + forms);
    node3.id = "codigo" + forms;
    texto = document.createTextNode("Código");
    node2.appendChild(texto);
    node2.appendChild(node3);
    node.appendChild(node2);
    unForm.appendChild(node);
    
    //tags
    node = document.createElement("DIV");
    node.className += "col-3";
    //Crea un nodo complejo
    node2 =document.createElement("label");
    node3 = document.createElement("input");
    node3.setAttribute("placeholder","Ecuentra artículos más facilmente");
    node3.setAttribute("type","text");
    node3.setAttribute("name","tags" + forms);
    node3.id = "tags" + forms;
    texto = document.createTextNode("Palabras Clave");
    node2.appendChild(texto);
    node2.appendChild(node3);
    node.appendChild(node2);
    unForm.appendChild(node);
    
    //Foto
    node = document.createElement("DIV");
    node.className += "col-3";
    //Crea un nodo complejo
    node2 =document.createElement("label");
    node2.style.height = "60px";
    node3 = document.createElement("input");
    node3.setAttribute("type","file");
    node3.setAttribute("name","foto" + forms);
    node3.id = "foto" + forms;
    texto = document.createTextNode("Foto");
    node2.appendChild(texto);
    node2.appendChild(node3);
    node.appendChild(node2);
    unForm.appendChild(node);
    
    
    //Precio
    node = document.createElement("DIV");
    node.className += "col-3";
    //Crea un nodo complejo
    node2 =document.createElement("label");
    node3 = document.createElement("input");
    node3.setAttribute("placeholder","$");
    node3.setAttribute("type","number");
    node3.setAttribute("name","precio" + forms);
    node3.id = "precio" + forms;
    texto = document.createTextNode("Precio");
    node2.appendChild(texto);
    node2.appendChild(node3);
    node.appendChild(node2);
    unForm.appendChild(node);
    
    //Categorias
    node = document.createElement("DIV");
    node.className += "col-2";
    node.style.float ="left";
    node.id = "col-cat";
    //Crea un nodo complejo
    node2 =document.createElement("label");
    node3 = document.createElement("select");
    node3.setAttribute("data-placeholder","Selecciona varias...");
    node3.className += "chosen-select";
    node3.setAttribute("name","cat" + forms);
    node3.id = "cat" + forms;
    node3.style.width = "85%";
    node3.multiple = true;
    var node4 = document.createElement("span");
    node4.id = "col-cat";
    texto = document.createTextNode("Categorias");
    //Opciones para el select
    var opt1 = document.createElement("option");
    opt1.value = "No";
    opt1.text = "No";
    var opt2 = document.createElement("option");
    opt2.value = "Color";
    opt2.text = "Color";
    var opt3 = document.createElement("option");
    opt3.value = "Modelo";
    opt3.text = "Modelo";
    var opt4 = document.createElement("option");
    opt4.value = "Tamaño";
    opt4.text = "Tamaño";
    node3.add(opt1);
    node3.add(opt2);
    node3.add(opt3);
    node4.appendChild(texto);
    node2.appendChild(node4);
    node2.appendChild(node3);
    node.appendChild(node2);
    unForm.appendChild(node);
    
    //Descripcion
    node = document.createElement("DIV");
    node.className += "col-2";
    node.id = "col-desc" + forms;
    //Crea un nodo complejo
    node2 =document.createElement("label");
    node3 = document.createElement("textarea");
    node3.setAttribute("name","descripcion" + forms);
    node3.id = "descripcion" + forms;
    node4 = document.createElement("span");
    node4.className ="desc-sub-art";
    node4.id = "textoDescripcion" + forms;
    texto = document.createTextNode("Descripcion");
    node4.appendChild(texto);
    node2.appendChild(node4);
    node2.appendChild(node3);
    node.appendChild(node2);
    unForm.appendChild(node);
    
    //Distincion Select
    node = document.createElement("DIV");
    node.className += "col-2 dist";
    //Crea un nodo complejo
    node2 =document.createElement("label");
    node3 = document.createElement("select");
    node3.setAttribute("onchange","btnMasActivar(this.value)");
    node3.className = "no-chosen";
    node3.setAttribute("name","distincionSelect" + forms);
    node3.id = "distincionSelect" + forms;
    node4 = document.createElement("span");
    node4.id = "textoDescripcion" + forms;
    texto = document.createTextNode("Distincion");
    //Opciones para el select
    var opt1 = document.createElement("option");
    opt1.value = "No";
    opt1.text = "No";
    opt1.selected = true;
    var opt2 = document.createElement("option");
    opt2.value = "Color";
    opt2.text = "Color";
    var opt3 = document.createElement("option");
    opt3.value = "Modelo";
    opt3.text = "Modelo";
    var opt4 = document.createElement("option");
    opt4.value = "Tamaño";
    opt4.text = "Tamaño";
    node3.add(opt1);
    node3.add(opt2);
    node3.add(opt3);
    node2.appendChild(texto);
    node.appendChild(node2);
    node.appendChild(node3);
    unForm.appendChild(node);
    
    //is activo
    node = document.createElement("DIV");
    node.className += "col-2 offset";
    //Crea un nodo complejo
    node2 =document.createElement("label");
    node3 = document.createElement("center");
    node4 = document.createElement("input");
    node4.className = "js-switch";
    node4.setAttribute("type","checkbox");
    node4.setAttribute("name","isActivo" + forms);
    node4.id = "isActivo" + forms;
    texto = document.createTextNode("Activo");
    node2.appendChild(texto);
    node3.appendChild(node4);
    node.appendChild(node2);
    node.appendChild(node3);
    unForm.appendChild(node);
    
    var wrapper = document.getElementById("sobre");
    wrapper.appendChild(unForm);
    $('#'+unForm.id).hide();
    $('#'+unForm.id).slideDown(1100);
    
    
    //Activo chosen
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    //Activo Switcheryyyy
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
    
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    var filtrado =[];
    for(var i = forms +1;i<elems.length;i++){
        filtrado.push(elems[i]);
    }
    
    filtrado.forEach(function(html) {
        var switchery = new Switchery(html);
    });
    
    $('.dlt-frm-btn').on('click',function(){
        return false;
    })
    
    setSuggestions();
    forms++;
}

function deleteForm(){
    var index = parseInt($(this).attr('value'));
    $($('#sobre .unForm')[index]).slideUp(1000,function(){$($('#sobre .unForm')[index]).remove();
                                                         
                                                             var restantes = $('#sobre .unForm');
    for(var i = index; i < restantes.length;i++){
        var sig = (i == 0 ? 1 : i + 1);
        $(restantes[i]).find('h2').html("Subarticulo: " + (sig) );
        $(restantes[i]).find('button').attr('value',i);
        $(restantes[i]).find('#code'+sig).attr('id','code'+i).attr('name','code'+i);
        $(restantes[i]).find('#tags'+sig).attr('id','tags'+i).attr('name','tags'+i);
        $(restantes[i]).find('#foto'+sig).attr('id','foto'+i).attr('name','foto'+i);
        $(restantes[i]).find('#precio'+sig).attr('id','precio'+i).attr('name','precio'+i);
        $(restantes[i]).find('#cat'+sig).attr('id','cat'+i).attr('name','cat'+i);
        $(restantes[i]).find('#descripcion'+sig).attr('id','descripcion'+i).attr('name','descripcion'+i);
        $(restantes[i]).find('#descripcionSelect'+sig).attr('id','descripcionSelect'+i).attr('name','descripcionSelect'+i);
        $(restantes[i]).find('#isActivo'+sig).attr('id','isActivo'+i).attr('name','isActivo'+i);
    }
    });
    if(forms>0)forms--;
}