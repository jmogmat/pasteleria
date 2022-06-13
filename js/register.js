
function registerUser() {


    fetch('api/upsertUser.php', {
        method: 'POST',
        body: new FormData(document.getElementById("registerUserForm"))


    }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Bienvenido...',
                        text: 'Su registro fue exitoso, verifique su cuenta de correo!',
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
                        title: 'Ups...',
                        text: data.msg
                    })

                }
            })


}