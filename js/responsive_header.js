/* document.addEventListener('DOMContentLoaded', () => {
    var menuStatus = 'hidden';
    document.getElementById('hambButton').addEventListener('click', () => {
        if (menuStatus == 'hidden') {
            document.getElementById('hambMenu').setAttribute('class', 'hambMenu displayHambMenu');
            menuStatus = 'display';
        }
        else if (menuStatus == 'display') {
            document.getElementById('hambMenu').setAttribute('class', 'hambMenu');
            menuStatus = 'hidden';
        }
    });


Media Query en JS para modificar el DOM en este caso 

    var ventana = window;

    var cambiar = true; // Variable bandera para que no se repitan acciones

    ventana.addEventListener('resize', function (mql) {
        var ancho_ventana = window.innerWidth; // Obtenemos el ancho actual de la ventana

        if(ancho_ventana< 830) { // Si la pantalla se vuelve más pequeña de 830px
            cambiar = true;
        }

        if (ancho_ventana > 830) {
            if(cambiar) { // Comprobamos si tenemos que ocultar el menu desplegable
                // Ocultamos el menu desplegable
                document.getElementById('hambMenu').setAttribute('class', 'hambMenu'); // Ocultamos el menu desplegable
                cambiar= false; // Ponemos false en nuestra variable bandera ya que no tenemos que realizar más cambios por el momento
            }

        }
    });
});

*/

