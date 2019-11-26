function cerrarSession(){

    $.session.set('id_user','');
    location.replace('../index.html');


}