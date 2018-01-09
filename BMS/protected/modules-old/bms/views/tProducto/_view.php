<?php
/* @var $this TProductoController */
/* @var $data TProducto */
?>
<?php
$totalPage= $widget->dataProvider->getItemCount();

$totalItems= $widget->dataProvider->getTotalItemCount();
//echo $this->grid->dataProvider->getTotalItemCount(); //(idepended of pagination)
?>
<?php if($index == 0){ ?>
<ul id="products" class="products list-unstyled list-view"> 
<?php } ?>
    <li class="product type-product">
    <div class="side-item">
    
        <div class="row">
            <div class="col-md-4">
                

                <div id="myCarousel<?php echo $data->id_producto; ?>" class="carousel slide" data-ride="carousel" data-interval="false">
                    <!-- Carousel indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel<?php echo $data->id_producto; ?>" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel<?php echo $data->id_producto; ?>" data-slide-to="1"></li>
                        <li data-target="#myCarousel<?php echo $data->id_producto; ?>" data-slide-to="2"></li>
                    </ol>   
                    <!-- Wrapper for carousel items -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img onclick="verImg(1,<?php echo $data->id_producto; ?>,'<?php echo $data->codigo; ?>','<?php echo Yii::app()->request->baseUrl.'/images/Productos/'.$data->foto_principal; ?>','<?php echo Yii::app()->request->baseUrl.'/images/Productos/'.$data->foto_detalle; ?>','<?php echo Yii::app()->request->baseUrl.'/images/Productos/'.$data->foto_descripcion; ?>'); return false;" src="<?php echo Yii::app()->request->baseUrl.'/images/Productos/'.$data->foto_principal; ?>" alt="<?php echo $data->codigo; ?>">
                        </div>
                        <div class="item">
                            <img onclick="verImg(2,<?php echo $data->id_producto; ?>,'<?php echo $data->codigo; ?>','<?php echo Yii::app()->request->baseUrl.'/images/Productos/'.$data->foto_principal; ?>','<?php echo Yii::app()->request->baseUrl.'/images/Productos/'.$data->foto_detalle; ?>','<?php echo Yii::app()->request->baseUrl.'/images/Productos/'.$data->foto_descripcion; ?>'); return false;" src="<?php echo Yii::app()->request->baseUrl.'/images/Productos/'.$data->foto_detalle; ?>" alt="<?php echo $data->codigo; ?>">
                        </div>
                        <div class="item">
                            <img onclick="verImg(3,<?php echo $data->id_producto; ?>,'<?php echo $data->codigo; ?>','<?php echo Yii::app()->request->baseUrl.'/images/Productos/'.$data->foto_principal; ?>','<?php echo Yii::app()->request->baseUrl.'/images/Productos/'.$data->foto_detalle; ?>','<?php echo Yii::app()->request->baseUrl.'/images/Productos/'.$data->foto_descripcion; ?>'); return false;" src="<?php echo Yii::app()->request->baseUrl.'/images/Productos/'.$data->foto_descripcion; ?>" alt="<?php echo $data->codigo; ?>">
                        </div>
                    </div>
                    
                </div>

       
            </div>
            <div class="col-md-8" style="padding: 8px 20px 8px 20px;"> <!-- style="padding: 5px;" -->
                <h3>
                    <?php 
                        //echo substr($data->descripcion,0,60);  
                        echo $data->descripcion;
                    ?>
                </h3>                              
                	
                <span class="price">
                    <span class="amount">$<?php echo $data->precioWeb; ?></span>
                </span>
               
                <p class="product-description">
                    <?php echo $data->idMarca->nombres; ?>
                </p>

                <span class="product-quantity" style="float: left; margin-right: 10px; margin-top:4px;">
                    <div class="quantity">
                        <input type="button" value="-" class="minus">
                        <input type="number" id="TCarrito_cantidad_<?php echo $data->id_producto; ?>" name="TCarrito_cantidad_<?php echo $data->id_producto; ?>" step="1" min="0" value="1" title="Qty" class="form-control">
                        <input type="button" value="+" class="plus">
                    </div>
        		</span>

                <!-- <a href="#" rel="nofollow" class="theme_button inverse add_to_cart_button_<?php echo $data->id_producto; ?>">
                    <i class="rt-icon2-cart"></i>
                    A&ntilde;adir
                </a> -->
                <button type="button" class="theme_button inverse add_to_cart_button_<?php echo $data->id_producto; ?>" onclick="js: addCartProducto(<?php echo $data->id_producto; ?>,<?php echo $data->precioWeb; ?>)">
                    <i class="rt-icon2-cart"></i>
                    A&ntilde;adir
                </button>
                
                <!-- <div class="star-rating star-right" title="Rated 4.50 out of 5">
                    <span style="width:40%">
                        <strong class="rating">4.50</strong> out of 5
                    </span>
                </div> EVALUAR MAS ADELANTE CON LOS INDICADORES DE INTERES PARA REINALDO -->
            </div>
        </div>
    </div>
</li>




<?php if(($index+1) == $totalItems){ ?>
</ul>
<?php } ?>

