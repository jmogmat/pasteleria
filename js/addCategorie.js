
function addCategorie() {


    fetch('api/addCategorie.php', {
        method: 'POST',
        body: new FormData(document.getElementById("form_categoria"))


    }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Subido',
                        text: 'Se agregó una nueva categoria exitosamente!',
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


