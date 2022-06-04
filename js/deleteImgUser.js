
function deleteImgUser() {

    Swal.fire({
        title: 'Estás seguro/a?',
        text: "Si borras la imagen no podrás recuperarla!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminarla!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                // la URL para la petición
                url: 'api/deleteImgUser.php',

                // la información a enviar
                // (también es posible utilizar una cadena de datos)
                data: {id: document.getElementById('idUsuario').value},

                // especifica si será una petición POST o GET
                type: 'POST',

                // el tipo de información que se espera de respuesta
                dataType: 'json',

                // código a ejecutar si la petición es satisfactoria;
                // la respuesta es pasada como argumento a la función
                success: function (data) {
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Adiós imagen',
                        text: 'Su imagen ha sido borrada satisfactoriamente!',
                        confirmButtonText:
                                'Continuar',

                    }).then((result) => {

                        if (result.isConfirmed) {
                            document.location.reload();
                        }
                    })
                    // Fin script success
                    return


                },

                // código a ejecutar si la petición falla;
                // son pasados como argumentos a la función
                // el objeto de la petición en crudo y código de estatus de la petición
                error: function (error, msg) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Ups...',
                        text: 'No se ha podido borrar la imagen',
                    })

                },

            });

        }
    })


}

