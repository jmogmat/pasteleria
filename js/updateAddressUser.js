
function updateAddressUser() {
    console.log('hola')
    fetch('api/updateAddressUser.php', {
        method: 'POST',
        body: new FormData(document.getElementById("form_edit_address"))


    }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Datos actualizados',
                        text: 'Se ha actualizado su dirección exitosamente!',
                        confirmButtonText:
                                'Continuar',

                    }).then((result) => {

                        if (result.isConfirmed) {
                            document.location.reload();
                        }
                    })
                    // Fin script success
                    return
                }
                if (data.error && data.msg) {

                    Swal.fire({
                        icon: 'error',
                        title: 'Ups...',
                        text: data.msg
                        
                    })
                    
                }
            })

}
