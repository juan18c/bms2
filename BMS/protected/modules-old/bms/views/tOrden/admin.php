<?php
/* @var $this TOrdenController */
/* @var $model TOrden */
?>

<?php

Yii::app()->clientScript->registerScript('scriptAdminOrden', "

	getPagos = function(parametros){
	   
	    $.ajax({
	        type : 'POST',
	        url : '".Yii::app()->createUrl("bms/TOrden/conciliar")."'+parametros,            
	        dataType:'json',           
	        success : function (data) {   

	            $('#pagos-div').html(data.pagos).show();

	          
				recalcular = function()
				{
				    var monto=0, valor=0;

				    $('.monto-a-pagar').each(function(key, value){     

				        if ($(this).val() == '') {
				            valor = 0;
				        }else valor = $(this).val(); 
				        
				        monto = parseFloat(monto) + parseFloat(valor);        
				    });

				    return monto;
				}

				recalcularTotal = function()
				{
				    var monto=0, valor=0, total=$('#total').val();

				    $('.monto-a-pagar').each(function(key, value){     

				        if ($(this).val() == '') {
				            valor = 0;
				        }else valor = $(this).val(); 
				        
				        monto = parseFloat(valor) + parseFloat(monto);
				    });

				    monto = parseFloat(total) - monto;
				    return monto;
				}

				$('.monto-a-pagar').bind('keyup', function(e){
				    //alert($(this).val());
				    var valor = $(this).val();
				    var monto = $('#montoConciliado').val();
				    var montoP = 0;
				    var montoR = 0;
				    total=$('#total').val();

			        montoP = recalcular();
			        montoR = recalcularTotal();				   

				    $('#montoConciliado').val(montoP);
				    $('#montoRestante').val(montoR);

				    return false;
				});


				$('#TOrden_conciliar').click(function(){      
	                $.ajax({
	                    type : 'POST',
	                    url : '".Yii::app()->createUrl("bms/TOrden/conciliarPago")."/id/'+$('#idOrden').val(),
	                    data : $('#torden-conciliar-form').serialize(),
	                    dataType: 'json',
	                    success : function (data) {                 
	                        if (data.salida == 'ok') {	                            
	                           
	                            $('#pagos-div').html('<div class=\"alert alert-success alert-dismissable\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong> Conciliación Satisfactoria!!!</strong></div>').show();

	                            $('#torden-conciliar-grid').yiiGridView('update', {
					                data: $(this).serialize()
					            });

	                        }
	                    }
	                });                     
	            });



	            return false;
	        }
	    });
	}

	getDetallePagos = function(parametros){
	   
	    $.ajax({
	        type : 'POST',
	        url : '".Yii::app()->createUrl("bms/TOrden/detallePagoConciliado")."'+parametros,            
	        dataType:'json',           
	        success : function (data) {   

	            $('#pagos-div').html(data.pagos).show();


	            return false;
	        }
	    });
	}

	

",CClientScript::POS_READY);

?>
<!-- page heading start-->
<div class="page-heading">
    <h3>
        Administrar &Oacute;rdenes
    </h3>
    <ul class="breadcrumb">
        <li>
            <a href="#">Inicio</a>
        </li>        
        <li class="active"> &Oacute;rdenes </li>
    </ul>
</div>
<!-- page heading end-->


<!--body wrapper start-->
<div class="wrapper">

	<div id="pagos-div"></div>

	<div class="row">
        <div class="col-sm-12">
	        <section class="panel">
		        <header class="panel-heading">
		            &Oacute;rdenes
		            <span class="tools pull-right">
		                <a href="javascript:;" class="fa fa-chevron-down"></a>		                
		            </span>
		        </header>
		        <div class="panel-body">

			        <div class="adv-table">
			        <?php $this->widget('zii.widgets.grid.CGridView', array(
						'id'=>'torden-conciliar-grid',
						'dataProvider'=>$model->search(),
						'filter'=>$model,
						'itemsCssClass'=>'table table-bordered table-striped table-condensed',
						'columns'=>array(
							array(
								'name'=>'codigo_orden',
								'header' =>'Orden',
							    //'value' =>'<a href="bms/TCotizacion/update/.$data->id_cotizacion.">..</a>',
							    'value'=>'CHtml::link(substr($data->codigo_orden, 2, 5), array("../bms/TOrden/updateAdmin/idc/".$data->id_cotizacion."/id/".$data->id_orden),array("target"=>"_blank"))',
							    'type'=>'raw'
								//'headerHtmlOptions' => array('style' => 'width: 5%'),		
								//'filter'=> true
							),   
							// array(
							// 	'name'=>'id_cotizacion',
							// 	'header' =>'Cotización',
							    
							//     'value'=>'CHtml::link(substr($data->idCotizacion->codigo_cotizacion, 2, 5), array("../bms/TCotizacion/update/id/".$data->id_cotizacion),array("target"=>"_blank"))',
       //                  		'type'=>'raw'
								
							// ),        

							
							array(	
								'name'=>'id_beneficiario',
								'header' =>'Beneficiario', 
								//'headerHtmlOptions' => array('style' => 'width: 15%'),                            
								'value'=>'$data->idBeneficiario->idBeneficiarioDB->nombres." ".$data->idBeneficiario->idBeneficiarioDB->apellidos." (".$data->idBeneficiario->idParentesco->descripcion.")"',
								'type'=>'raw'
							),

							array(	
								'name'=>'fecha_creacion',
								'header' =>'Creación', 
								//'headerHtmlOptions' => array('style' => 'width: 18%'),
								'value'=>'date(\'d/m/Y H:i A\',strtotime($data->fecha_creacion))',
								'filter'=> true
							),
							
							array(	
								'name'=>'monto_total',
								'header' =>'Total', 
								//'headerHtmlOptions' => array('style' => 'width: 15%'),                            
								'value'=>'"$".number_format($data->monto_total,2,",",".")',
								'filter'=>false
							),

							array(	
								'name'=>'pago_acumulado',
								'header' =>'pago_acumulado', 
								//'headerHtmlOptions' => array('style' => 'width: 15%'),                            
								'value'=>'"$".number_format($data->pago_acumulado,2,",",".")',
								'filter'=>false
							),
							array(	
								'name'=>'pago_pendiente',
								'header' =>'pago_pendiente', 
								//'headerHtmlOptions' => array('style' => 'width: 15%'),                            
								'value'=>'"$".number_format($data->pago_pendiente,2,",",".")',
								'filter'=>false
							),
							array(	
								'name'=>'gasto_medio_pago',
								'header' =>'gasto_medio_pago', 
								//'headerHtmlOptions' => array('style' => 'width: 15%'),                            
								'value'=>'"$".number_format($data->gasto_medio_pago,2,",",".")',
								'filter'=>false
							),
							

							array(
								'class'=>'CButtonColumn',								
								'template'=>'{conciliar}{conciliado}&nbsp;{estatusP}{estatusA}',
					            'htmlOptions' => array('style'=>'white-space: nowrap;text-align:center;'),
								'buttons'=>array(

								    'conciliar' => array(
								        'label'=>'', 
								        'url'=>'"/id/".$data->id_orden',		
								        //'options'=>array('class'=>'fa fa-handshake-o fa-lg tooltips','data-toggle'=>'tooltip','data-original-title'=>'Conciliar Pagos'),
								        'options'=>array('class'=>'fa fa-plus fa-lg tooltips','data-toggle'=>'tooltip','data-original-title'=>'Conciliar Pagos'),
								        'click'=>'function(){ getPagos($(this).attr("href")); return false; }',
								    	'live'=>false,
								    	'visible'=>'$data->id_estatus==4',
								    ),

								    'conciliado' => array(
								        'label'=>'', 
								        'url'=>'"/id/".$data->id_orden',		
								        'options'=>array('class'=>'fa fa-check fa-lg tooltips','data-toggle'=>'tooltip','data-original-title'=>'Pagos Conciliados'),
								        'click'=>'function(){ getDetallePagos($(this).attr("href")); return false; }',
								    	'live'=>false,
								    	'visible'=>'$data->id_estatus==1',
								    ),

								    
					                'estatusP' => array(
							         	'label'=>'',
							            //'url'=>'',
										'options'=>array(
							            	'class'=>'fa fa-circle fa-lg tooltips','data-toggle'=>'tooltip','data-original-title'=>'Por Conciliar','style'=>'color:yellow;'
							            ),
							            'click'=>'js: function(){ return false; } ',
							            'visible'=>'$data->id_estatus==4'
					                ),		  
					                'estatusA' => array(
							         	'label'=>'',
							            //'url'=>'',
										'options'=>array(
							            	'class'=>'fa fa-circle fa-lg tooltips','data-toggle'=>'tooltip','data-original-title'=>'Orden Activa','style'=>'color:green;'
							            ),
							            'click'=>'js: function(){ return false; } ',
							            'visible'=>'$data->id_estatus==1'
					                ),		  



								),	


								
							),
						),
					)); ?>
			        </div>
		        </div>
	        </section>
    	</div>
	</div>
</div>


<div class="modal">
	<?php //echo TOrden::getPagosPendientes($data->id_orden); ?>
</div>