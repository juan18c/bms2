<table class="table shop_table shop-checkout-review-order-table">
    <thead>
        <tr>
            <td class="product-name">Producto</td>
            <td class="product-total">Total</td>
        </tr>
    </thead>
    <tbody>
        <?php 
            $precioTotal = 0;
            $items=0;

            foreach ($resumenCart as $key2 => $value2) {
                $precioTotal+=$value2->total;
                $items++;
            
        ?>
        <tr class="cart_item">
            <td class="product-name">
                <?php echo $value2->descripcion; ?>
                <span class="product-quantity">× <?php echo $value2->items; ?></span>
            </td>
            <td class="product-total">
                <span class="amount grey">$<?php echo $value2->total; ?></span>
            </td>
        </tr>                            
        <?php } ?>
    </tbody>
    <tfoot>

        <tr>
           <td>Envío: <?php echo $paisDestino; ?></td>
            <td>
                <span class="amount grey">$<?php echo $envio; ?></span>
            </td> 
        </tr>

        <tr>
            <td>Gastos x Transferencia:</td>
            <td>
                <span class="amount grey">$<?php echo $gastos; ?></span>
            </td>
        </tr>
        

        <tr class="cart-subtotal" id="totalRestante">
            <td>Total:</td>
            <td>
                <span class="amount grey"><strong>$<span id="totalR"><?php echo ($precioTotal+$envio+$gastos); ?></span></strong></span>
            </td>
        </tr>

        <tr><td colspan="2">&nbsp;</td></tr>

        <tr id="pagoAcumulado">
            <td>Pago Acumulado:</td>
            <td>
                <span class="amount grey"><b>$<span id="pagoAcumulado"><?php echo $modelOrden->pago_acumulado; ?></span></b></span>
            </td>
        </tr>
        <tr id="pagoPediente">
            <td>Pago Pendiente:</td>
            <td>
                <span class="amount red"><b>$<span id="saldoPendiente"><?php echo (($precioTotal+$envio+$gastos)-$modelOrden->pago_acumulado) > 0 ? ($precioTotal+$envio+$gastos)-$modelOrden->pago_acumulado : 0; ?></span></b></span>
            </td>
        </tr>
        <tr id="credito">
            <td>Crédito BMS:</td>
            <td>
                <span class="amount red"><b>$<span id="creditobms"><?php echo (($precioTotal+$envio+$gastos)-$modelOrden->pago_acumulado) < 0 ? (($precioTotal+$envio+$gastos)-$modelOrden->pago_acumulado)*(-1) : 0 ; ?></span></b></span>
            </td>
        </tr>
        
    </tfoot>
</table>
<input type="hidden" name="total" id="total" value="<?php echo ($precioTotal+$envio+$gastos); ?>">
<input type="hidden" name="items" id="items" value="<?php echo $items; ?>">
<input type="hidden" name="paisDestino" id="paisDestino" value="<?php echo $paisDestino; ?>">
<input type="hidden" name="paisAbreviatura" id="paisAbreviatura" value="<?php echo $paisAbreviatura; ?>">