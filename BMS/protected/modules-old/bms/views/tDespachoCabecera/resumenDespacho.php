<?php
/* @var $this tCotizacionController */
/* @var $model tCotizacion */
?>
<div class="row">

    <div class="col-sm-9 col-md-9 col-lg-9">

        <div class="widget widget_search">
                               
            <label class="control-label" for="TProducto_id_producto">Seleccione los productos a cotizar</label>
      
            <select class="selectpicker form-control" data-live-search="true" id="TProducto_id_producto" name="TProducto[id_producto]" data-style="btn-custom">
            <?php echo $modelProducto->getLista(); ?>
            </select>
            
        </div><br>

        <div class="table-responsive">
            
            <?php $this->renderPartial('application.modules.bms.views.tCotizacion._viewResumen',array('model'=>$model,'modelCar'=>$modelCar,'modelCartDet'=>$modelCartDet),false,false); ?>
        </div>



        <div id="divSolicitar"></div>

    </div> <!--eof .col-sm-8 (main content)-->


    <!-- sidebar -->
    <div class="col-sm-3 col-md-3 col-lg-3">                
        
        <h3 class="widget-title" id="order_review_heading">Orden</h3>
        <div id="order_review" class="shop-checkout-review-order">
            <div id="shop-order-div">
            <?php $this->renderPartial('application.modules.bms.views.tOrden._viewTotalOrden',array('resumenCart'=>$resumenCart,'modelOrden'=>$modelOrden,'envio'=>$envio,'gastos'=>$gastos,'paisDestino'=>$paisDestino,'paisAbreviatura'=>$paisAbreviatura),false,false); ?>
            </div>

            <div id="payment" class="shop-checkout-payment">
                <h3 class="widget-title">Direcci&oacute;n de Env&iacute;o</h3>
                <?php $this->renderPartial('application.modules.bms.views.tCotizacion._formDireccion',array('model'=>$model,'modelDireccion'=>$modelDireccion,'direccionEnvio'=>$direccionEnvio),false,false); ?>                           
            </div>
        </div>               

    </div> <!-- eof aside sidebar -->
</div>