function add30Minutes() { 

    countDownDateInit = new Date();
    countDownDateInit.setMinutes( countDownDateInit.getMinutes() + 30 ); 

    var countDownDate = countDownDateInit.getTime();

    //var countDownDate = new Date("Jan 5, 2021 15:37:25").getTime();

    // Armamos un interval de cada un segundo
    interval = setInterval(function() {

      // Tomamos la fecha de hoy
      var now = new Date().getTime();

      // Buscamos la distancia entre la fecha de ahora y la fecha de ahora + 30minutos
      distance = countDownDate - now;

      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);

      // Mostramos el timer en el div con el id = TiempoDeExpiracionDeCita
      document.getElementById("TiempoDeExpiracionDeCita").innerHTML = hours + "h " 
      + minutes + "m " + seconds + "s ";

      if(new Date(distance).getMinutes() <= 5){

        document.getElementById("TiempoDeExpiracionDeCita").style.display = 'block';     
        document.getElementById("TiempoDeExpiracionDeCita").style.color = 'red';
      
        let buttons = `<button class="btnExp" onclick="add10Minutes()">Añadir 10 minutos</button>`;
  
        document.getElementById("TiempoDeExpiracionDeCita").innerHTML = hours + "h " 
        + minutes + "m " + seconds + "s   "+ buttons;
  
          }

      // Si termina el tiempo mostramos un mensaje y a los segundos lo sacamos de la sala
      if (distance < 0) {
        clearInterval(interval);
        document.getElementById("TiempoDeExpiracionDeCita").innerHTML = "CITA FINALIZADA";
        setTimeout( () => {location.replace('index.html');},3000 ) // A LOS 3 SEG LO RAJO
      }
    }, 1000);

 }

 function add10Minutes() { 

    clearInterval(interval);

    countDownDate = new Date(countDownDateInit);
    countDownDate.setMinutes( countDownDate.getMinutes() + 10 ); 

    countDownDate = countDownDate.getTime();

    //var countDownDate = new Date("Jan 5, 2021 15:37:25").getTime();

    // Armamos un interval de cada un segundo
    interval = setInterval(function() {

      // Tomamos la fecha de hoy
      var now = new Date().getTime();

      // Buscamos la distancia entre la fecha de ahora y la fecha de ahora + 30minutos
      distance = countDownDate - now;

      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)); 
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);

      // Mostramos el timer en el div con el id = TiempoDeExpiracionDeCita
      document.getElementById("TiempoDeExpiracionDeCita").style.color = 'black';
      document.getElementById("TiempoDeExpiracionDeCita").innerHTML = hours + "h " 
      + minutes + "m " + seconds + "s ";

      // Si termina el tiempo mostramos un mensaje y a los segundos lo sacamos de la sala
    if(new Date(distance).getMinutes() <= 5){
            
        document.getElementById("TiempoDeExpiracionDeCita").style.color = 'red';
        document.getElementById("TiempoDeExpiracionDeCita").style.display = 'block';
  
        document.getElementById("TiempoDeExpiracionDeCita").innerHTML = hours + "h " 
        + minutes + "m " + seconds + "s ";
  
          }

      if (distance < 0) {
        clearInterval(interval);
        document.getElementById("TiempoDeExpiracionDeCita").innerHTML = "CITA FINALIZADA";
        
        setTimeout( () => {location.replace('index.html');},3000 ) // A LOS 3 SEG LO RAJO
        
      }
    }, 1000);

 }