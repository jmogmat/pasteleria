
function deleteCategorie() {

 Swal.fire({
        title: 'Estás seguro/a?',
        text: "Si borras la categoria dejará de estar asociada en los productos donde esté referenciada",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, borrar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                // la URL para la petición
                url: 'api/deleteCategorie.php',

                // la información a enviar
                // (también es posible utilizar una cadena de datos)
                data: {cod_categoria: document.getElementById('cod_categoria').value},

                // especifica si será una petición POST o GET
                type: 'POST',

                // el tipo de información que se espera de respuesta
                dataType: 'json',

                // código a ejecutar si la petición es satisfactoria;
                // la respuesta es pasada como argumento a la función
                success: function (data) {
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Borrada',
                        text: 'La categoría ha sido borrada satisfactoriamente!',
                        confirmButtonText:
                                'Continuar',

                    }).then((result) => {

                        if (result.isConfirmed) {
                            document.location.reload();
                        }
                    })
                   
                    return;


                },

                // código a ejecutar si la petición falla;
                // son pasados como argumentos a la función
                // el objeto de la petición en crudo y código de estatus de la petición
                error: function (error, msg) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Ups...',
                        text: '',
                    })

                },

            });

        }
    })
    }


