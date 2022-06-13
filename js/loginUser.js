
function loginUser() {

    fetch('api/loginUser.php', {
        method: 'POST',
        body: new FormData(document.getElementById("form_login"))


    }).then(response => response.json())
            .then(data => {
                
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Hola...',
                        text: 'Nos alegramos de verte por aquí!',
                        confirmButtonText:
                                'Continuar',

                    }).then((result) => {

                        if (result.isConfirmed) {
                          
                           location.href ="./index.php";

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


