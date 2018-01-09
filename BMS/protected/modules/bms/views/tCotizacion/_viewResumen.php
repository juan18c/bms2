<?php
/* @var $this TCarritoDetalleController */
/* @var $data TCarritoDetalle */
?>

<?php
    //echo $modelCar->id_carrito; exit();
    $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'tcarrito-cotizacion-grid',
    'dataProvider'=>$modelCartDet->searchCot($modelCar->id_carrito),
    'filter'=>$modelCartDet,
    'itemsCssClass'=>'table table-bordered table-striped table-condensed',
    //'ajaxUpdate'=>'tcarrito-cotizacion-grid', // not necessary if same as id
    'ajaxUpdate'=>true,
    //'ajaxUrl'=>Yii::app()->createUrl( 'Something/search' ),
    'columns'=>array(        
        array(
            'header'=>'Producto',
            'name'=>'descripcionProducto',
            'value'=>function($data){
                return '
                <div class="media">
                    <div class="media-left">                
                        <img class="media-object cart-product-image" src="" alt="">                
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">
                        <a href="#">'.$data->idProducto->descripcion.'</a>
                        </h4>
                        <span class="grey">Marca/Laboratorio: '.$data->idProducto->idMarca->nombres.'</span>                                            
                    </div>
                </div>';
            },
            'type'=>'raw',
            'filter'=>CHtml::activeTextField($modelCartDet, 'descripcionProducto'), 
        ),
        array(
            'header'=>'Precio',
            'name'=>'idProducto.tInventarios.precio',
            'value'=>function($data){
                return '$'.TProducto::model()->getPrecio($data->id_producto);
            },          
        ),
        array(
            'header'=>'Cantidad',
            'name'=>'cantidad',
            'value'=>function($data){
              return '<div class="quantity"><input type="button" value="-" class="minus" id="minus'. $data->id_carrito_detalle.'" name="minus'.$data->id_carrito_detalle.'" onclick="js:recalcularCarrito('.$data->id_carrito_detalle.',$(\'#cantidadDet'.$data->id_carrito_detalle.'\').val(),$(this).val()); return false;       "><input type="numbers" step="1" min="1" id="cantidadDet'.$data->id_carrito_detalle.'" name="cantidadDet'.$data->id_carrito_detalle.'" value="'.$data->cantidad.'" title="Cantidad" class="form-control" style="padding-left: 10px !important;padding-right: 20px !important;text-align: center;"><input type="button" value="+" class="plus" id="plus'.$data->id_carrito_detalle.'" name="plus'.$data->id_carrito_detalle.'" onclick="js:recalcularCarrito('.$data->id_carrito_detalle.',$(\'#cantidadDet'.$data->id_carrito_detalle.'\').val(),$(this).val()); return false;       "></div>';
            }, 
            'type'=>'raw',
            'filter'=>false
        ),
        array(
            'header'=>'Total',
            'name'=>'totalItem',
            'value'=>function($data){
                return '$'.(TProducto::model()->getPrecio($data->id_producto)) * $data->cantidad;
            },                
            'filter'=>false
        ),
        
        //'id_estatus',
        //'fecha_creacion',
        array(
            'class'=>'CButtonColumn',                               
            'template'=>'{borrar}',
            'buttons'=>array(
                'borrar' => array(
                    'label'=>'', 
                    //'url'=>'Yii::app()->createUrl("bms/tCotizacion/deleteCart", array("id"=>$data["id_carrito_detalle"]))',      
                    
                    'url' => '$data["id_carrito_detalle"]', 
                    /* retrieve id from this DOM element (jQuery) */                    
                    'options'=>array('class'=>'fa fa-trash-o fa-lg',
                        'onclick'=>'js: borrarItem( $(this).attr("href")); return false;  '
                    ),
                    'click' => 'js: function(){ return false; }',
                    'live'=>false,                        
                ),                
            ),  
        ),
    ),
)); 

?>