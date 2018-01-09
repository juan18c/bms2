<?php
/* @var $this TOrdenController */
/* @var $model TOrden */

Yii::app()->clientScript->registerScript('search', "
borrarItem = function(idCarritoDetalle){
    $.ajax({
        type : 'POST',
        url : '".Yii::app()->createUrl("bms/TCotizacion/deleteItemCart")."/id/'+idCarritoDetalle+'/idR/'+$('#idResponsable').val(),
        //data : {}, 
        dataType:'json',            
        success : function (data) {
                          
            $('#shop-order-div').html(data.totalOrden);
            $('#tcarrito-cotizacion-grid').yiiGridView('update',{data: {idcarr:$('#TCotizacion_id_carrito').val() }});

            return false;               
        }

    });

    return false;
}

");
?>


<div class="adv-table table-responsive">
	<?php 

	//$this->widget('zii.widgets.grid.CGridView', array(
	$this->widget('booster.widgets.TbGroupGridView', array(

	
		'id'=>'torden-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'itemsCssClass'=>'table table-bordered table-striped table-condensed',
		'columns'=>array(
			
			array(
				'name'=>'codigo_orden',
				'header' =>'Orden',
			    //'value' =>'<a href="bms/TCotizacion/update/.$data->id_cotizacion.">..</a>',
			    'value'=>'CHtml::link(substr($data->codigo_orden, 2, 5), array("../bms/TOrden/update/idc/".$data->id_cotizacion."/id/".$data->id_orden),array("target"=>"_blank"))',
			    'type'=>'raw',
				'headerHtmlOptions' => array('style' => 'width: 5%'),		
				//'filter'=> true
			),                 	
			
			array(	
				'name'=>'id_beneficiario',
				'header' =>'Beneficiario', 
				'headerHtmlOptions' => array('style' => 'width: 25%'),                            
				'value'=>'$data->idBeneficiario->idBeneficiarioDB->nombres." ".$data->idBeneficiario->idBeneficiarioDB->apellidos." (".$data->idBeneficiario->idParentesco->descripcion.")"',
				'type'=>'raw'
			),

			array(	
				'name'=>'fecha_creacion',
				'header' =>'Creación', 
				'headerHtmlOptions' => array('style' => 'width: 15%'),
				'value'=>'date(\'d/m/Y H:i A\',strtotime($data->fecha_creacion))',
				'filter'=> true
			),
			
			array(	
				'name'=>'monto_total',
				'header' =>'Total', 
				'headerHtmlOptions' => array('style' => 'width: 10%'),                            
				'value'=>'"$".number_format($data->monto_total,2,",",".")'
			),

			array(	
				'name'=>'pago_acumulado',
				'header' =>'Acumulado', 
				//'headerHtmlOptions' => array('style' => 'width: 15%'),                            
				'value'=>'"$".number_format($data->pago_acumulado,2,",",".")'
			),
			
			
	                    

			array(
				'class'=>'CButtonColumn',								
				'template'=>'{estatusPendiente}{estatusActivo}&nbsp;{despachar}{pagar}&nbsp;{factura}',
	            'htmlOptions' => array('style'=>'white-space: nowrap'),
				'buttons'=>array(
				    'estatusPendiente' => array(
				        'label'=>'', 				        
				        'options'=>array('class'=>'fa fa-circle fa-lg tooltips','data-toggle'=>'tooltip','data-original-title'=>'Pendiente por Conciliar Pagos','style'=>'color:yellow;'),	
				        'click'=>'function(){ return false; }',
				    	'live'=>false,			       
				    	'visible'=>'$data->id_estatus == 4',				          
				    ),
				    'estatusActivo' => array(
				        'label'=>'', 				        
				        'options'=>array('class'=>'fa fa-circle fa-lg tooltips','data-toggle'=>'tooltip','data-original-title'=>'Orden Completa','style'=>'color:green;'),	
				        'click'=>'function(){ return false; }',
				    	'live'=>false,			       
				    	'visible'=>'$data->id_estatus == 1',				          
				    ),

				    'pagar' => array(
				        'label'=>'', 
				        'url'=>'"/idP/".$data->id_orden."/idCot/".$data->id_orden."/idCar/".$data->id_orden',		
				        'options'=>array('class'=>'fa fa-money fa-lg tooltips','data-toggle'=>'tooltip','data-original-title'=>'Pagar'),
				        'click'=>'function(){ return false; }',
				    	'live'=>false,
				    	'visible'=>'$data->pago_acumulado!=$data->monto_total && $data->id_estatus==4'
				    ),

				    'despachar' => array(
				        	'label'=>'',
				            'url'=>'Yii::app()->createUrl("bms/TDespachoCabecera/create", array("id"=>$data["id_orden"],"idc"=>$data["id_cotizacion"]))',
							'options'=>array(
				            	'class'=>'fa fa-truck fa-lg tooltips','data-toggle'=>'tooltip','data-original-title'=>'Solicitar Despacho',
								//'id'=>'$data["id_orden"]',
								'target'=>'_blank'          						
									
				            ),
				         //    'click'=>'js: function(){	                           
	            //                 return false;
	            //             }',
				        	// 'live'=>false,
				        	'visible'=>'$data->id_estatus==1'
				        	
				        ),	

				        'factura' => array(
				        	'label'=>'',
				            'url'=>'Yii::app()->createUrl("bms/TCotizacion/cotizacion", array("idCotizacion"=>$data["id_cotizacion"]))',
							'options'=>array(
				            	'class'=>'fa fa-file-pdf-o fa-lg tooltips','data-toggle'=>'tooltip','data-original-title'=>'Ver Factura',									
								'target'=>'_blank'							
				            ),
				            'click'=>'js: function(e){                                                
		                       
		                        e.preventDefault();
		                        $("#urlImpresion").val($(this).attr("href"));
		                        imprimir();

		                        return false;

		                    }',
				        	'live'=>false						        	
		                ),


				),	
			),

				    
		),
	)); ?>
</div>