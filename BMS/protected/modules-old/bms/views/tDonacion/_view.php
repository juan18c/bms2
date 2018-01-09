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

                <div id="myCarousel<?php echo $data->id_donacion; ?>" class="carousel slide" data-ride="carousel" data-interval="false">

                <img  src="<?php echo Yii::app()->request->baseUrl.'/'.$data->foto; ?>" alt="<?php echo $data->codigo_donacion; ?>" onclick="js:window.location='<?php echo Yii::app()->createUrl("bms/TDonacion/detalleDonacion",array('id'=>$data->id_donacion))?>'">                    
                </div>       
            </div>
            <div class="col-md-8" style="padding: 8px 20px 8px 20px;"> <!-- style="padding: 5px;" -->
                <h3><?php $esp=utf8_encode(" "); echo str_pad($data->nombre_caso, 50,$esp); ?></h3>
                <label class="cause-days-togo label label-default"><?php echo date( 'd-m-y',strtotime($data->fecha_creacion)) ?></label>  
                <div class="progress-label" style="font-size: 12px">
                   <?php
                   $porc=intval(floatval($data->monto_acumulado)*100/floatval($data->monto_solicitado));
                    echo $porc; ?>% donado de <span>$<?php echo $data->monto_solicitado ?></span> 
                                
                </div>
                <div class="progress">
                  <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $porc;?>" aria-valuemin="0" aria-valuemax="100" ></div>
                </div>
                 <p class="product-description">
                    <?php 
                        echo $data->resumen;
                    ?>
                </p>
                 
                <?php if ($data->id_estatus==1){ ?>                         
                <button type="button" class="theme_button inverse add_to_cart_button_<?php echo $data->id_donacion; ?>" onclick=" verImg(<?php echo $data->id_donacion; ?>); return false;" >
                    <i class="fa fa-thumbs-up"></i>
                    Donar
                </button>

                 <?php } ?> 
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
