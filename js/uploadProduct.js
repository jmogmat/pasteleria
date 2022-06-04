function uploadProduct() {
    
console.log('entra')
    fetch('api/uploadProduct.php', {
        method: 'POST',
        body: new FormData(document.getElementById("form_upload_product"))


    }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Subido',
                        text: 'Producto subido exitosamente!',
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

