function updateProduct() {

    fetch('api/updateProduct.php', {
        method: 'POST',
        body: new FormData(document.getElementById("formulario_actualiza_producto"))


    }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({ 
                        icon: 'success',
                        title: 'Actualizado',
                        text: 'Datos actualizados exitosamente!',
                        confirmButtonText:
                                'Continuar'

                    }).then((result) => {

                        if (result.isConfirmed) {
                              document.location.reload();
                        }
                    })
                    
                    return;
                }
                if (data.error && data.msg) {

                    Swal.fire({
                        icon: 'error',
                        title: 'Ups...algo ha ido mal!',
                        text: data.msg,
                        confirmButtonText:
                                'Continuar'
                    })

                }
            })


}

