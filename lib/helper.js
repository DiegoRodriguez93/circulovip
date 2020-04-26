$(".solo_numeros").keydown(function (e) {
        
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 40]) !== -1 ||
         // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)) {
             // let it happen, don't do anything
             return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
    if(e.altKey){
        return false;
    }
});

function comprobarCI(cedi){
//Inicializo los coefcientes en el orden correcto
var arrCoefs = [2,9,8,7,6,3,4,1];
var suma = 0;
//Para el caso en el que la CI tiene menos de 8 digitos
//calculo cuantos coeficientes no voy a usar
var difCoef = parseInt(arrCoefs.length - cedi.length);
//var difCoef = parseInt(arrCoefs.length – ci.length);
//recorro cada digito empezando por el de más a la derecha
//o sea, el digito verificador, el que tiene indice mayor en el array
for(var i=cedi.length - 1; i> -1;i--){
//for (var i = ci.length – 1; i > -1; i–) {
//ooObtengo el digito correspondiente de la ci recibida
var dig = cedi.substring(i, i+1);
//Lo tenía como caracter, lo transformo a int para poder operar
var digInt = parseInt(dig);
//Obtengo el coeficiente correspondiente al ésta posición del digito
var coef = arrCoefs[i+difCoef];
//Multiplico dígito por coeficiente y lo acumulo a la suma total
suma = suma + digInt * coef;
}
// si la suma es múltiplo de 10 es una ci válida
if ( (suma % 10) == 0 ) {
    return true;
}else{
    return false;
}
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function validateEmail2(valor) {
    if (/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/i.test(valor)){
     return true;
    } else {
     return false;
    }
  }

function validatePhone(phone) {
    var n = phone.startsWith("09");
    return n;
  }

  function compare(a, b) {

    const A = a.horario;
    const B = b.horario;
  
    let comparison = 0;
    if (A > B) {
      comparison = 1;
    } else if (A < B) {
      comparison = -1;
    }
    return comparison;
  }