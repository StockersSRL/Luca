var forms = 0;
var tags = 0;
var select = 0;
var goingDown = true;
function init() {
    setSuggestions();
    fakeInput('');
    checkDataVisual();
    $('input.default').on('click', function () {
        $(this).closest('div.chosen-container').removeClass("error");
    });

    $('#submit-btn').on('click', function (e) {
        if (!checkDataFunctional()) {
            e.preventDefault();
        } else {
            cargarInputs();
        }
    });
}

function fakeInput(index) {
    $('#input-box' + index).keyup(function (e) {
        if (e.which == 13 && $(this).val() != 0) {
            tags++;
            var valor = $(this).val();
            ($('<span class="tag-box" id="tag' + tags + ' ">' + valor + '<span class="close-tag" id="close-tag'
                + tags + '" ></span></span>')).insertBefore($(this));
            $(this).val('');
            $(this).attr('placeholder', '');
            $(this).attr('style', '');
            $(this).css({'width': '40%'});
            $('#close-tag' + tags).click(function () {
                $(this).parent().remove();
                if ($('.close-tag').length == 0) {
                    $('#input-box' + index).attr('placeholder', 'Encuentra artículos más facilmente').css(
                        {
                            'margin-top': '0px',
                            'padding-top': '0px',
                            'margin-left': '0px',
                            'padding-left': '0px',
                            'width': '90%'
                        });
                }
            });
            return false;
        }
    });
}

function setSuggestions() {
    $(window).ready(function () {
        $('.suggest-box').hide();
        $('input[id^="name"]').on('keydown', function (e) {
            //Para que no se mueva el puto cursor
            if (e.which == 40 || e.which == 38) {//ArrowDown || ArrowUp
                e.preventDefault()
            }
        });

        $('input[id^="name"]').on('keyup', function (e) {
            //Solucionar problema de cambio de direccion
            //hacer el ajuste al principio || hacer booleano para donde va
            if (e.which == 40) {//ArrowDown
                !goingDown ? select++ : "";
                goingDown = true;
                $(this).next('.suggest-box').find('li').removeClass("selected");
                var max = $(this).next('.suggest-box').find('li').length - 1;
                select > max ? select = 0 : "";
                $(this).next('.suggest-box').find('li')[select].className += ' selected';
                select > max ? select = 0 : select++;
            } else if (e.which == 38) {//ArrowUp
                goingDown ? select-- : "";
                goingDown = false;
                var max = $(this).next('.suggest-box').find('li').length - 1;
                select <= 0 ? select = max : select--;
                $(this).next('.suggest-box').find('li').removeClass("selected");
                $(this).next('.suggest-box').find('li')[select].className += ' selected';
                console.log("Up");
                console.log(select);
                console.log(goingDown);
            } else if (e.which == 13) {
                $(this).val($('.selected').text());
                $('.selected').removeClass("selected");
                $(this).next('.suggest-box').hide();
                select = 0;
            } else {
                //Al ingresar una tecla que no sean flechas
                var pista = $(this).val();
                var caller = $(this);
                if (pista == '') {
                    $(this).next('.suggest-box').hide();
                } else {
                    $('.selected').removeClass("selected");
                    select = 0;
                    $(this).next('.suggest-box').show();
                    $.post('suggestNames.php', 'q=' + pista, function (data) {
                        data == "<ul></ul>" ? caller.next('.suggest-box').hide() :
                            caller.next('.suggest-box').html(data);
                        caller.next('.suggest-box').find('li').click(function () {
                            caller.val($(this).text());
                            caller.next('.suggest-box').hide();
                            $('.selected').removeClass("selected");
                            select = 0;
                        });
                    });
                }
            }
        });
        //Esconder sugerencias en click
        $(document).mouseup(function (e) {
            var container = $(".suggest-box");
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                container.hide();
                $('.selected').removeClass("selected");
                select = 0;
            }
        });

        $('.suggest-box').hover(function () {
            $('.selected').removeClass("selected");
            select = 0;
        });

    });
}

function addForm() {

    //Titulo
    var unForm = document.createElement("div");
    unForm.className += "unForm border-form";
    unForm.id = "form" + forms;
    var node = document.createElement("DIV");
    node.className += "col-1";
    //Crea un nodo complejo
    var node2 = document.createElement("label");
    var node3 = document.createElement("h2");
    var texto = document.createTextNode("Subarticulo: " + (forms + 1));
    node3.appendChild(texto);
    var btn = $('<button/>', {text: '-', class: 'dlt-frm-btn', type: 'button'});//document.createElement('button');
    btn.on('click', deleteForm);
    btn.val(forms);
    node2.appendChild(node3);
    btn.appendTo(node2);
    node.appendChild(node2);
    unForm.appendChild(node);

    //Distincion
    node = document.createElement("DIV");
    node.className += "col-2";
    //Crea un nodo complejo
    node2 = document.createElement("label");
    node3 = document.createElement("input");
    node3.setAttribute("placeholder", "Distinción");
    node3.setAttribute("type", "text");
    node3.setAttribute("name", "name" + forms);
    node3.setAttribute("autocomplete", "off");
    node3.id = "name" + forms;
    var node4 = document.createElement('div');
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
    node2 = document.createElement("label");
    node3 = document.createElement("input");
    node3.setAttribute("placeholder", "Código del artículo");
    node3.setAttribute("type", "text");
    node3.setAttribute("name", "codigo" + forms);
    node3.id = "codigo" + forms;
    texto = document.createTextNode("Código");
    node2.appendChild(texto);
    node2.appendChild(node3);
    node.appendChild(node2);
    unForm.appendChild(node);

    //tags
    node = document.createElement("DIV");
    node.className += "col-3";
    node.style.position = "relative";
    //Crea un nodo complejo
    node2 = document.createElement("label");
    node2.setAttribute("for", "input-box" + (forms + 1));
    node3 = document.createElement("input");
    node3.setAttribute("placeholder", "Ecuentra artículos más facilmente");
    node3.setAttribute("type", "text");
    node3.setAttribute("name", "tags" + forms);
    node3.id = "input-box" + (forms);
    node3.classList = "input-box";
    texto = document.createTextNode("Palabras Clave");
    var node4 = document.createElement("div");
    $(node4).attr({'id': "fake-input" + forms, 'name': 'tags' + forms, 'class': 'fake-input'});
    node4.appendChild(node3);
    node2.appendChild(texto);
    node2.appendChild(node4);
    node.appendChild(node2);
    unForm.appendChild(node);

    //Foto
    node = document.createElement("DIV");
    node.className += "col-3";
    //Crea un nodo complejo
    node2 = document.createElement("label");
    node2.style.height = "60px";
    node3 = document.createElement("input");
    node3.setAttribute("type", "file");
    node3.setAttribute("name", "foto" + forms);
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
    node2 = document.createElement("label");
    node3 = document.createElement("input");
    node3.setAttribute("placeholder", "$");
    node3.setAttribute("type", "number");
    node3.setAttribute("name", "precio" + forms);
    node3.id = "precio" + forms;
    texto = document.createTextNode("Precio");
    node2.appendChild(texto);
    node2.appendChild(node3);
    node.appendChild(node2);
    unForm.appendChild(node);

    //Categorias
    node = document.createElement("DIV");
    node.className += "col-2";
    node.style.float = "left";
    node.id = "col-cat" + forms;
    node.style.height = '143px';
    //Crea un nodo complejo
    node2 = document.createElement("label");
    node3 = document.createElement("select");
    node3.setAttribute("data-placeholder", "Selecciona varias...");
    node3.className += "chosen-select";
    node3.setAttribute("name", "cat" + forms);
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
    var node5 = $('<input type="text" style="display: none" id="big-cat' + forms + '" name="big-cat' + forms + '">');
    node3.add(opt1);
    node3.add(opt2);
    node3.add(opt3);
    node4.appendChild(texto);
    node2.appendChild(node4);
    node2.appendChild(node3);
    $(node2).append(node5);
    node.appendChild(node2);
    unForm.appendChild(node);

    //Descripcion
    node = document.createElement("DIV");
    node.className += "col-2";
    node.id = "col-desc" + forms;
    //Crea un nodo complejo
    node2 = document.createElement("label");
    node3 = document.createElement("textarea");
    node3.setAttribute("name", "descripcion" + forms);
    node3.id = "descripcion" + forms;
    node4 = document.createElement("span");
    node4.className = "desc-sub-art";
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
    node2 = document.createElement("label");
    node3 = document.createElement("select");
    node3.className = "no-chosen";
    node3.setAttribute("name", "distincionSelect" + forms);
    node3.id = "distincionSelect" + forms;
    node4 = document.createElement("span");
    node4.id = "textoDescripcion" + forms;
    texto = document.createTextNode("Distincion");
    //Opciones para el select
    var opt2 = document.createElement("option");
    opt2.value = "Color";
    opt2.text = "Color";
    var opt3 = document.createElement("option");
    opt3.value = "Modelo";
    opt3.text = "Modelo";
    var opt4 = document.createElement("option");
    opt4.value = "Tamaño";
    opt4.text = "Tamaño";
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
    node2 = document.createElement("label");
    node3 = document.createElement("center");
    node4 = document.createElement("input");
    node4.className = "js-switch";
    node4.setAttribute("type", "checkbox");
    node4.setAttribute("name", "isActivo" + forms);
    node4.id = "isActivo" + forms;
    texto = document.createTextNode("Activo");
    node2.appendChild(texto);
    node3.appendChild(node4);
    node.appendChild(node2);
    node.appendChild(node3);
    unForm.appendChild(node);

    var wrapper = document.getElementById("sobre");
    wrapper.appendChild(unForm);
    $('#' + unForm.id).hide();
    $('#' + unForm.id).slideDown(1100, function () {
        $('html, body').animate({
            scrollTop: $(document).height()
        }, 'slow');
    });


    //Activo chosen
    var config = {
        '.chosen-select': {},
        '.chosen-select-deselect': {allow_single_deselect: true},
        '.chosen-select-no-single': {disable_search_threshold: 10},
        '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
        '.chosen-select-width': {width: "95%"}
    };
    //Activo Switcheryyyy
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }

    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    var filtrado = [];
    for (var i = forms + 1; i < elems.length; i++) {
        filtrado.push(elems[i]);
    }

    filtrado.forEach(function (html) {
        var switchery = new Switchery(html);
    });

    $('.dlt-frm-btn').on('click', function () {
        return false;
    });

    setSuggestions();
    fakeInput(forms);
    checkDataVisual();
    $('li.search-field > input').on('click', function () {
        $(this).closest('div.chosen-container').removeClass("error");
    });
    forms++;
}

function deleteForm() {
    var index = parseInt($(this).attr('value'));
    $($('#sobre .unForm')[index]).slideUp(1000, function () {
        $($('#sobre .unForm')[index]).remove();

        var restantes = $('#sobre .unForm');
        for (var i = index; i < restantes.length; i++) {
            var sig = (i == 0 ? 1 : i + 1);
            $(restantes[i]).find('h2').html("Subarticulo: " + (sig));
            $(restantes[i]).find('button').attr('value', i);
            $(restantes[i]).find('#code' + sig).attr('id', 'code' + i).attr('name', 'code' + i);
            $(restantes[i]).find('#input-box' + sig).attr('id', 'input-box' + i).attr('name', 'tags' + i);
            $(restantes[i]).find('#foto' + sig).attr('id', 'foto' + i).attr('name', 'foto' + i);
            $(restantes[i]).find('#precio' + sig).attr('id', 'precio' + i).attr('name', 'precio' + i);
            $(restantes[i]).find('#cat' + sig).attr('id', 'cat' + i).attr('name', 'cat' + i);
            $(restantes[i]).find('#descripcion' + sig).attr('id', 'descripcion' + i).attr('name', 'descripcion' + i);
            $(restantes[i]).find('#descripcionSelect' + sig).attr('id', 'descripcionSelect' + i).attr('name', 'descripcionSelect' + i);
            $(restantes[i]).find('#isActivo' + sig).attr('id', 'isActivo' + i).attr('name', 'isActivo' + i);
        }
    });
    if (forms > 0)forms--;
}

function checkDataVisual() {

    $('input[id^="name"]').on('blur', function () {
        if ($(this).val() == '') {
            $(this).addClass('error');
        } else {
            $(this).removeClass('error');
        }
    });

    //$('input[id^="codigo"]').on('blur', function () {
    //    if ($(this).val() == '') {
    //        $(this).addClass('error');
    //    } else {
    //        $(this).removeClass('error');
    //    }
    //});

    $('input[id^="precio"]').on('blur', function () {
        if ($(this).val() == '') {
            $(this).addClass('error');
        } else {
            $(this).removeClass('error');
        }
    });

    $('li.search-field > input').on('blur', function () {
        if ($(this).parent().parent().parent().parent().find('select.chosen-select').find(':selected').length == 0) {
            $(this).closest('div.chosen-container').addClass("error");
        } else {
            $(this).closest('div.chosen-container').removeClass("error");
        }
    });

}

function checkDataFunctional() {
    var ok = true;
    $('input[id^="name"]').each(function () {
        if ($(this).val() == '') {
            $(this).addClass("error");
            ok = false;
        } else {
            $(this).removeClass("error");
        }
    });

    //$('input[id^="codigo"]').each(function () {
    //    if ($(this).val() == '') {
    //        $(this).addClass("error");
    //        ok = false;
    //    } else {
    //        $(this).removeClass("error");
    //    }
    //});

    $('input[id^="precio"]').each(function () {
        console.log($(this).val());
        console.log($(this).val() =='');
        console.log($.isNumeric(parseInt($(this).val())));
        if (!$.isNumeric(parseInt($(this).val())) || $(this).val() == '') {
            $(this).addClass("error");
            ok = false;
        } else {
            $(this).removeClass("error");
        }
    });
    $('select.chosen-select').each(function () {
        if ($(this).find(':selected').length == 0) {
            ok = false;
            $(this).next('div.chosen-container').addClass("error");
        } else {
            $(this).next('div.chosen-container').removeClass("error");
        }
    });
    return ok;
}

function cargarInputs() {
    var fakes = $('div[id^="fake-input"]');
    $.each(fakes, function (index, elem) {
        $(elem).find('span.tag-box').each(function () {
            $(elem).find('input[id^="input-box"]').val($(elem).find('input[id^="input-box"]').val() + '|' + $(this).text());
        });
        $(elem).find('input[id^="input-box"]').hide();
    });

    var colCats = $('div[id^="col-cat"]');
    $.each(colCats, function (index, elem) {
        console.log($(elem).find('select.chosen-select'));
        $(elem).find('input[id^="big-cat"]').val($($(elem).find('select.chosen-select').find(':selected')[0]).val());
    });

    $('input[name="subarticulos"]').val(forms);
}
