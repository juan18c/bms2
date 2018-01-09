<?php
/* @var $this TCarritoDetalleController */
/* @var $data TCarritoDetalle */
?>
<?php

foreach ($data as $key => $value) {



Yii::app()->clientScript->registerScript('refreshOrden'.$value->id_carrito_detalle,"    

    jQuery('#minus".$value->id_carrito_detalle.", #plus".$value->id_carrito_detalle."').click(function(){
        cantidad = $('#cantidadDet".$value->id_carrito_detalle."').val();
        $.ajax({
            type : 'POST',
            url : '".Yii::app()->createUrl("bms/TCarritoDetalle/update/id/".$value->id_carrito_detalle)."',
            data : {c:cantidad}, 
            dataType:'json',            
            success : function (data) {
                ajaxRequest = $(this).serialize();                

                $('#cart').html('<i class=\"rt-icon2-cart highlight\"></i><span class=\"grey\">Carrito:</span><span class=\"count\">'+data.totalProducto+' items, $'+data.totalCarrito+'</span>');

                $('.widget_shopping_cart_content .total .amount').html('$'+data.totalCarrito);                

                $.fn.yiiListView.update('carrito-compra-list',{type : 'POST',url:'".Yii::app()->createUrl("bms/TCarritoDetalle/cartPrevio")."', data:ajaxRequest});

                $('#shop-order-div').html(data.totalOrden);
                //$.fn.yiiListView.update('resumen-cart-list',{type : 'POST',url:'".Yii::app()->createUrl("bms/TCarritoDetalle/cartPrevio")."', data:ajaxRequest});

                return false;               
            }

        });

        return false;
    });


    jQuery('#deleleCart".$value->id_carrito_detalle."').click(function(){

         $.ajax({
            type : 'POST',
            url : '".Yii::app()->createUrl("bms/TCarritoDetalle/delete/id/".$value->id_carrito_detalle)."',
            data : {}, 
            dataType:'json',            
            success : function (data) {
                ajaxRequest = $(this).serialize();
                
                $('#shop-order-div').html(data.totalOrden);
                //$.fn.yiiListView.update('resumen-cart-list',{type : 'POST',url:'".Yii::app()->createUrl("bms/TCarritoDetalle/cartPrevio")."', data:ajaxRequest});
                

                $('#cart').html('<i class=\"rt-icon2-cart highlight\"></i><span class=\"grey\">Carrito:</span><span class=\"count\">'+data.totalProducto+' items, $'+data.totalCarrito+'</span>');

                $('.widget_shopping_cart_content .total .amount').html('$'+data.totalCarrito);                

                $.fn.yiiListView.update('carrito-compra-list', {type : 'POST', url:'".Yii::app()->createUrl("bms/TCarritoDetalle/cartPrevio")."', data:ajaxRequest });

                return false;               
            }

        });

        return false;
        
    });


",CClientScript::POS_READY);

?>
<?php

    $total = 0;
    $precio = TProducto::model()->getPrecio($value->id_producto);
    $total = $precio * $value->cantidad;

?>
<?php

   // if ($index == 0) {
        
    
?>

    
<?php //} ?>
<tr class="cart_item">
    <td class="product-info">
        <div class="media">
            <div class="media-left">
                <a href="product-left.html">
                    <img class="media-object cart-product-image" src="images/shop/01.jpg" alt="">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">
                    <a href="#"><?php echo $value->idProducto->descripcion; ?></a>
                </h4>
                <span class="grey">Marca/Laboratorio:</span>                                            
            </div>
        </div>                
    </td>
    <td class="product-price">
        <span class="currencies">$</span><span class="amount"><?php echo $precio; ?></span>                  
    </td>
    <td class="product-quantity">
        <div class="quantity">
            <input type="button" value="-" class="minus" id="minus<?php echo $value->id_carrito_detalle; ?>" name="minus<?php echo $value->id_carrito_detalle; ?>">
            <input type="number" step="1" min="0" id="cantidadDet<?php echo $value->id_carrito_detalle; ?>" name="cantidadDet<?php echo $value->id_carrito_detalle; ?>" value="<?php echo $value->cantidad; ?>" title="Qty" class="form-control">
            <input type="button" value="+" class="plus" id="plus<?php echo $value->id_carrito_detalle; ?>" name="plus<?php echo $value->id_carrito_detalle; ?>">
        </div>
    </td>
    <td class="product-subtotal">
        <span class="currencies">$</span><span class="amount"><?php echo $total; ?></span>                 
    </td>
    <td class="product-remove">
        <a href="#" class="remove" title="Remove this item" id="deleleCart<?php echo $value->id_carrito_detalle; ?>">
            <i class="rt-icon2-trash2"></i>
        </a>
    </td>
</tr>     

<?php

    //if ($index == ($totalItems-1)) {
        
    
?>    
   


<?php

  }
        
    
?>