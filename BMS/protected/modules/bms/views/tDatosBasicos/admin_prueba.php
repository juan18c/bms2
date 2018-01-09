 
<?php
/* @var $this TDatosBasicosController */
/* @var $model TDatosBasicos */

Yii::app()->clientScript->registerScript('search', "
$('.search-form2 form').submit(function(){
	$('#tdatos-basicos2-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>



<h1>Manage Tdatos Basicoses</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>


<div class="row-fluid">
<div class="span12">
<?php 
	$dataDatosBasicos = $model->search();
	$dataDatosBasicos->pagination->pageSize = 2;

	$this->widget('zii.widgets.grid.CGridView', 
		array(			
			'id'=>'tdatos-basicos2-grid',
			'dataProvider'=>$dataDatosBasicos,
			'ajaxUpdate'=>'true',
			'filter'=>$model,			
			'columns'=>array(
				'id_datos_basicos',
				'id_tipo_identificacion',
				'nro_identificacion',
				'titular',
				'nombres',
				'apellidos',
				/*
				'sexo',
				'fecha_nacimiento',
				'nacionalidad',
				'id_estado_civil',
				'fecha_creacion',
				'id_estatus',
				*/
				array(
					'class'=>'CButtonColumn',
				    'template'=>'{view}{update}{delete}{prueba2}',
				    'buttons'=>array(
				        'view' => array(
				            'label'=>'',
				            'imageUrl'=>'',
				            'options'=>array('class'=>'icon-eye-open'),
				            'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id_datos_basicos))',
				        ),
				        'update' => array(				            
				           	'label'=>'',
				            'imageUrl'=>'',
				            'options'=>array('class'=>'icon-pencil'),
				            //'visible'=>'$data->score > 0',
				            'click'=>'function(){alert("Going fdfbdbdown!");}',
				        ),
				        'delete' => array(				            
				           	'label'=>'',
				            'imageUrl'=>'',
				            'options'=>array('class'=>'icon-trash'),
				           
				        ),
				        'prueba2' => array(	
				        	'label'=>'prueba2',                                                
                            'imageUrl'=>'',
                            'url'=>'Yii::app()->createUrl("Esculapio/TDatosBasicosUbicacion/admin", array("id"=>$data->id_datos_basicos))',
                            'options'=>array(
                            		'ajax'=>array(
                                    'type'=>'POST',
                                    'url'=>"js:$(this).attr('href')",  
                                    'success'=>"function(data)
                        			{                               
                                        $('#ubicacion').html(data);

                        			}"

                                    ),
                            ),

/*
				        	'name'=>'prueba',			            
				           	'label'=>'prueba',
				            'imageUrl'=>'',
				            'url' => 'function(e){updatePaymentComment("index.php?r=Esculapio/TDatosBasicos/create&id=$data->id_datos_basicos"); $("#dialogPaymentComment").dialog();
				}', 
				            //'options'=>array('class'=>'icon-pencil'),
				            //'visible'=>'$data->score > 0',
				            'click'=>'function(e){updatePaymentComment("index.php?r=Esculapio/TDatosBasicos/create&id=\'.$data->id_datos_basicos.\'"); $("#dialogPaymentComment").dialog();
				}
       ',*/
				        ),
				        
		    		),
				),
			),
		)
	); ?>

	<div id="ubicacion" title="dialog title">ubicacion</div>
</div>
</div>
<?php /* */ ?>