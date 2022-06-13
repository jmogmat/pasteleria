<div class="modal fade" id="modalcart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mi carrito</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div>
                        <div class="p-2">
                            <ul class="list-group mb-3">
                                <?php
                                if (isset($_SESSION['carrito'])) {
                                    $total = 0;
                                    $myCart = $_SESSION['carrito'];

                                    for ($i = 0; $i <= count($myCart) - 1; $i++) {
                                        if (isset($myCart[$i])) {
                                            if ($myCart[$i] != NULL) {
                                                ?>
                                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                                    <div class="row col-12" >
                                                        <div class="col-6 p-0" style="text-align: left; color: #000000;"><h6 class="my-0">Cantidad: <?php echo $myCart[$i]['cantidad'] ?> : <?php echo $myCart[$i]['nombre']; ?></h6>
                                                        </div>
                                                        <div class="col-6 p-0"  style="text-align: right; color: #000000;" >
                                                            <span class="text-muted" style="text-align: right; color: #000000;"><?php echo $myCart[$i]['precio'] * $myCart[$i]['cantidad']; ?> €</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php
                                                $total = $total + ($myCart[$i]['precio'] * $myCart[$i]['cantidad']);
                                            }
                                        }
                                    }
                                }
                                ?>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span  style="text-align: left; color: #000000;">Total (EUR)</span>
                                    <strong  id="total"  style="text-align: left; color: #000000;"><?php
                                        if (isset($_SESSION['carrito'])) {
                                            $total = 0;
                                            for ($i = 0; $i <= count($myCart) - 1; $i++) {
                                                if (isset($myCart[$i])) {
                                                    if ($myCart[$i] != NULL) {
                                                        $total = $total + ($myCart[$i]['precio'] * $myCart[$i]['cantidad']);
                                                    }
                                                }
                                            }
                                        }
                                        if (!isset($total)) {
                                            $total = '0';
                                        } else {
                                            $total = $total;
                                        }
                                        echo $total;
                                        ?> €</strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <a type="button" class="btn btn-primary" href="" onclick="event.preventDefault();deleteCart()">Vaciar carrito</a>
                <a type="button" class="btn btn-success" href="" onclick="event.preventDefault();purchase()">Finalizar pedido</a>
            </div>
        </div>
    </div>
    <script>

        var total = document.getElementById('total').innerText;


        function purchase() {


            if (total !== '0 €') {

                fetch('api/purchase.php', {
                    method: 'POST',                   


                }).then(response => response.json())
                        .then(data => {

                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Pedido confirmado',
                                    text: 'Su pedido se ha realizado con éxito!',
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

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Ups...',
                    text: 'El carrito está vacio!',
                })
            }
        }

        function deleteCart() {


            if (total !== '0 €') {

                Swal.fire({
                    title: 'Estás seguro/a?',
                    text: "Se borrarán todos los productos del carrito!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, vaciar carrito!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {

                    if (result.isConfirmed) {

                        $.ajax({

                            url: 'api/deleteCart.php',
                            dataType: 'json',

                            success: function (data) {

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Carrito vacio',
                                    text: 'Se ha vaciado el carrito satisfactoriamente!',
                                    confirmButtonText:
                                            'Continuar',

                                }).then((result) => {

                                    if (result.isConfirmed) {
                                        document.location.reload();
                                    }
                                })

                                return;


                            },

                            error: function (error, msg) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Ups...',
                                    text: 'No se ha podido procesar el vaciado del carrito',
                                })

                            },

                        });

                    }
                })

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Ups...',
                    text: 'El carrito está vacio!',
                })
            }




        }
    </script>
</div>
