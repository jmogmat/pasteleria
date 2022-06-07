function addToCart(id) {
    let element = document.getElementById("formCart" + id);

    fetch('api/addToCart.php', {
        method: 'POST',
        body: new FormData(element)


    }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Añadido',
                        text: 'Se ha agregado un elemento al carrito!',
                        confirmButtonText:
                                'Continuar',

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

