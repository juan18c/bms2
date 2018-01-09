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

            foreach ($resumenCart as $key2 => $value2) {
                $precioTotal+=$value2->total;
            
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

        <tr class="cart-subtotal">
            <td>Subtotal:</td>
            <td>
                <span class="amount grey"><strong>$<?php echo $precioTotal; ?></strong></span>
            </td>
        </tr>
        
    </tfoot>
</table>