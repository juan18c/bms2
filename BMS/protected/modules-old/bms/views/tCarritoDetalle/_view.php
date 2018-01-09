<?php
/* @var $this TCarritoDetalleController */
/* @var $data TCarritoDetalle */
?>
<ul class="cart_list product_list_widget media-list">
            
            <li class="media">
                <div class="media-left media-middle">
                    <a href="product-right.html">
                        <img src="<?php echo Yii::app()->theme->baseUrl.'/'.($data->idProducto->foto_principal != '' ? $data->idProducto->foto_principal : $data->idProducto->idMarca->imagen_perfil); ?>" alt="">
                    </a>
                </div>

                <div class="media-body media-middle">
                    <h4>
                        <a href="product-right.html"><?php echo $data->idProducto->descripcion; ?></a>
                    </h4>
                    <span class="quantity"><?php echo $data->cantidad; ?> × <span class="amount">$<?php echo TProducto::model()->getPrecio($data->idProducto->id_producto); ?></span></span>
                </div>
                <div class="media-body media-middle">
                    <a href="#" class="remove" title="Remove this item">
                        <i class="rt-icon2-trash2 highlight"></i>
                    </a>
                </div>
            </li>

        </ul><!-- end product list -->