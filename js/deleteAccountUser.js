
function deleteAccountUser() {

    Swal.fire({
        title: 'Estás seguro/a?',
        text: "Lamentamos mucho que nos dejes!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar mi cuenta!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                // la URL para la petición
                url: 'api/deleteAccountUser.php',

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
                        title: 'Adiós!',
                        text: 'Su perfil ha sido borrado satisfactoriamente! Vuelve cuando quieras serás bienvenido/a!',
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
                        text: 'No se ha podido borrar su cuenta. Ponte en contacto con nostros para resolverlo!',
                    })

                },

            });

        }
    })


}
