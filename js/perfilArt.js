function doesExist(elem){
                return elem.length > 0;
            }

            function numToAbc(name){
                var abc = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
                var retorno="";
                for(var i=0; i<abc.length; i++){
                    if(parseInt(name)==i) retorno=""+abc[i];
                }
                return retorno;
            }
        
            function selectArt(subart){
                 $('.subart').children('.innerPrice').removeClass('orangered');
                 $('.subart'+subart).children('.innerPrice').toggleClass('orangered');
                 var src = $('.subart'+subart).children().prop('src');
                 $("#grande").attr('src', src);
                 $('.subart').css("border-color", "lightgray");
                 $('.subart'+subart).css("border-color", "orangered");
                 var name = $('.subart'+subart).attr("name");
                 $('.subGran').hide();
                 var mostrar = numToAbc(name);
                 $('#'+mostrar).show();
            }
