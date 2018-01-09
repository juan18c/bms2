
<div class="adv-table table-responsive">
	<?php 

	//$this->widget('zii.widgets.grid.CGridView', array(
	$this->widget('booster.widgets.TbGroupGridView', array(	
		'id'=>'tdonacion-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'itemsCssClass'=>'table table-bordered table-striped table-condensed',
		'columns'=>array(
			
			array(
				'name'=>'codigo_donacion',
				'header' =>'Codigo Donacion',
			    //'value' =>'<a href="bms/TCotizacion/update/.$data->id_cotizacion.">..</a>',
			    'value'=>'CHtml::link(substr($data->codigo_donacion, 2, 5), array("../bms/TDonacion/update/id/".$data->id_donacion),array("target"=>"_blank"))',
			    'type'=>'raw',
				'headerHtmlOptions' => array('style' => 'width: 5%'),		
				//'filter'=> true
			), 
			array(	
				'name'=>'monto_acumulado',
				'header' =>'Monto Acumulado', 
				'headerHtmlOptions' => array('style' => 'width: 10%'),                            
				'value'=>'"$".number_format($data->monto_acumulado,2,",",".")'
			),

			array(	
				'name'=>'monto_solicitado',
				'header' =>'Monto Solicitado', 
				'headerHtmlOptions' => array('style' => 'width: 10%'),                            
				'value'=>'"$".number_format($data->monto_solicitado,2,",",".")'
			),  
			 'id_estatus'=>array(
					'name'=>'id_estatus',
					'header' =>'Estatus', 	
					'headerHtmlOptions' => array('style' => 'width: 20%'),   				
					'value'=>'TEstatus::model()->findByPk($data->id_estatus)->descripcion',
					'filter'=>CHtml::activeDropDownList($model,'id_estatus',
				   			  CHtml::listData(TEstatus::model()->findAll('t.id_estatus in (1,2,4) '), 'id_estatus', 'descripcion'),array('prompt'=>'Selecc','class'=>'Drop')
				),
		   		                     
			),               	

			array(	
				'name'=>'fecha_creacion',
				'header' =>'Creación', 
				'headerHtmlOptions' => array('style' => 'width: 30%'),
				'value'=>'date(\'d/m/Y H:i A\',strtotime($data->fecha_creacion))',
				'filter'=> true
			),
			array(
				'class'=>'CButtonColumn',								
				'template'=>'{borrar}',
	            'htmlOptions' => array('style'=>'white-space: nowrap'),
				'buttons'=>array(
                    'borrar' => array(
	                    'label'=>'',	
	                    'url'=>'Yii::app()->createUrl("bms/TDonacion/delete",array("id"=>$data->id_donacion))',
			            'options'=>array(
			            	'class'=>'fa fa-trash fa-lg tooltips','data-toggle'=>'tooltip','data-original-title'=>'Eliminar',	            	
			            	'title' => 'Eliminar Donación Postulada',
			            	'onclick'=>'					            		
								var r = confirm("¿Está seguro que desea borrar esta Donación Postulada?");
								
								if (r == true) {											   
				            		$.ajax({
									    url:$(this).attr("href"),
									    type:"POST",   
									    dataType:"json",   						    
									    success: function(data){ 
									    	if(data.mensaje == "COMPLETO"){														

									    		$("#tdonacion-grid").yiiGridView("update", {
													data: $(this).serialize()
												});
												return false;

				            				}else{
				            					alert(data);
				            				}

				            				return false;           				
										}
									});	
								} 
								return false;								            		
			            	',
	                   		'class'=>'fa fa-trash fa-lg'
			            ),															             
			            'click'=>'js: function(){ return false; } ',   
			            //'visible'=>'$data["id_medico"] == '.$idMedico,
	                ),		        

				),

			),

				    
		),
	)); ?>
</div>