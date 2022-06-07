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
                                    for ($i = 0; $i <= count($myCart) - 1; $i++) {
                                        if (isset($myCart[$i])) {
                                            if ($myCart[$i] != NULL) {
                                                ?>
                                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                                    <div class="row col-12" >
                                                        <div class="col-6 p-0" style="text-align: left; color: #000000;"><h6 class="my-0">Cantidad: <?php echo $myCart[$i]['cantidad'] ?> : <?php echo $myCart[$i]['nombre'];?></h6>
                                                        </div>
                                                        <div class="col-6 p-0"  style="text-align: right; color: #000000;" >
                                                            <span class="text-muted"  style="text-align: right; color: #000000;"><?php echo $myCart[$i]['precio'] * $myCart[$i]['cantidad']; ?> €</span>
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
                                    <strong  style="text-align: left; color: #000000;"><?php
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <a type="button" class="btn btn-primary" href="">Vaciar carrito</a>
                <a type="button" class="btn btn-success" href="">Continuar pedido</a>
            </div>
        </div>
    </div>
</div>
