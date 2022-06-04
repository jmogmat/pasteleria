
function updateAccountUser() {

    fetch('api/updateAccountUser.php', {
        method: 'POST',
        body: new FormData(document.getElementById("form_edit_profile"))


    }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Datos actualizados',
                        text: 'Se han actualizados sus datos exitosamente!',
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
