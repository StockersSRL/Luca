/**
 * Created by Bruno on 29-Feb-16.
 */
var tags = 0;
//Init
$(window).ready(function () {

    //Infiinite scrolling
    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() >= ( $(document).height() - 1) && busqueda.length > 1) {
            busqueda[0].busqueda.desde = parseInt(busqueda[0].busqueda.hasta);
            busqueda[0].busqueda.hasta =parseInt(busqueda[0].busqueda.hasta) + 10;
            $.post('AJAX/busqueda.php', busqueda[0].busqueda, function (data) {
                busqueda = JSON.parse(data);
                cargarArticulos();
            });
        }
    });

    $('#orden-check').on('change', function () {
        busqueda[0].busqueda.desde = 0;
        busqueda[0].busqueda.ordenar = parseInt($(this).val());
        $.post('AJAX/busqueda.php', busqueda[0].busqueda, function (data) {
            busqueda = JSON.parse(data);
            $('#resultados').html('');
            cargarArticulos();
        });
    });

    //cargar tags
    var aux = "";
    $('#submit').on('click', function (e) {
        aux = "";
        $('span.tag-box').each(function () {
            aux += $(this).text() + "|";
        });
        $('#s-tags').val(aux.substr(0, aux.length - 1));
    });


    //Activar switchery
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function (html) {
        var switchery = new Switchery(html);
    });

    //Activar Slider
    $('<div id="range-slider"/>').slider({

            range: true,

            min: 0,

            max: 3000,

            values: [0, 3000],
            slide: function (event, ui) {
                $('#slider-min').val('$' + ui.values[0]);
                $('#slider-max').val('$' + ui.values[1]);
            }
        }
    ).appendTo($('#slider > div'));
    $('#slider-min').val('$0');
    $('#slider-max').val('$3000');
    $('#slider-min').on('blur', function () {
        if (parseInt(this.value) <= 3000
            && parseInt(this.value) >= 0
            && parseInt(this.value) <= parseInt($('#slider-max').val().slice(1))) {
            $('#range-slider').slider('values', 0, this.value);
            this.value = '$' + this.value;
        } else {
            $('#range-slider').slider('values', 0, 0);
            this.value = '$' + 0;
        }
    });
    $('#slider-max').on('blur', function () {
        if (parseInt(this.value) <= 3000
            && parseInt(this.value) >= 0
            && parseInt(this.value) >= parseInt($('#slider-min').val().slice(1))) {
            $('#range-slider').slider('values', 1, this.value);
            this.value = '$' + this.value;
        } else {
            $('#range-slider').slider('values', 1, 3000);
            this.value = '$' + 3000;
        }
    });

    $('#slider-max, #slider-min').keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) ||
                // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105) || e.which == 13) {
            e.preventDefault();
            return false;
        }
    });
    fakeInput('');

    if (busqueda.length > 0) {
        cargarArticulos();
    }
});

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
            $(this).css({'width': '40%', 'height': '18px', 'border': '0px'});
            $(this).parent().css({'border': '1px solid rgb(150, 150, 150)', 'height': '32px'});
            $('#close-tag' + tags).click(function () {
                $(this).parent().remove();
                if ($('.close-tag').length == 0) {
                    $('#input-box' + index).attr('placeholder', 'Tags').css(
                        {
                            'margin-top': '0px',
                            'padding-top': '0px',
                            'margin-left': '0px',
                            'padding-left': '0px',
                            'width': '100%',
                            'height': '34px'
                        });
                }
            });
        }
    });

    $('#input-box' + index).keydown(function (e) {
        if (e.which == 13) {
            return false;
        }

    });
}

function cargarArticulos() {
    for (var i = 1; i < busqueda.length; i++) {
        var codigo = busqueda[i].codigo ? "#" + busqueda[i].codigo + "-" : "";
        var nombre = busqueda[i].nombre.length + codigo.length > 20 ? busqueda[i].nombre.substr(0, 16) + "..." : busqueda[i].nombre;
        $('<div class="articulo">' +
            '<a href="articulo.php?sub='+busqueda[i].id+'"><img src="' + busqueda[i].path + '">' +
            '<span class="art-desc"><div class="desc">' +
            '<h3>' + codigo + nombre + '</h3></div>' +
            '<div class="precio">' +
            '<h4>Precio: ' + busqueda[i].precio + '</h4>' +
            '</div>' +
            '</span></a>' +
            '</div>').appendTo('#resultados')
    }
}