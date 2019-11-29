function cerrarSession(){

/*     $.session.set('id_user',''); */
    localStorage.clear();
    location.replace('../index.html');


}