<?php
/* @var $this TDatosBasicosDireccionController */
/* @var $modelDBD TDatosBasicosDireccion */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tdatos-basicos-direccion-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="adv-table table-responsive">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tdatos-basicos-direccion-grid',
	'dataProvider'=>$modelDBD->searchFront($idResponsable),
	'filter'=>$modelDBD,
	'itemsCssClass'=>'table table-bordered table-striped table-condensed',
	'columns'=>array(
		// 'id_datos_basicos_direccion',
		// 'id_datos_basicos',
		'direccion1',
		'direccion2',
		'codigo_zip',
		array(	
			'name'=>'id_tipo_direccion',
			'header' =>'Tipo de Dirección', 
			//'headerHtmlOptions' => array('style' => 'width: 10%'),
			'value'=>'$data->idTipoDireccion->descripcion',
			'filter'=> CHtml::listData(TTipoDireccion::model()->findAll(),'id_tipo_direccion','descripcion')			
		),


		/*
		'id_pais',
		'ciudad',
		'estado',
		'telefono_fijo',
		'indicador_factura',
		'indicador_envio',
		'fecha_creacion',		
		*/
		array(	
			'name'=>'id_pais',
			'header' =>'País', 
			//'headerHtmlOptions' => array('style' => 'width: 10%'),
			'value'=>'$data->idPais->descripcion',
			'filter'=> CHtml::listData(TPais::model()->findAll(),'id_pais','descripcion')			
		),
		array(	
			'name'=>'id_estatus',
			'header' =>'Estatus', 
			//'headerHtmlOptions' => array('style' => 'width: 10%'),
			'value'=>'TEstatus::model()->findByPk($data->id_estatus)->descripcion',
			'filter'=> CHtml::listData(TEstatus::model()->findAll(),'id_estatus','descripcion')			
		),

		array(
			'class'=>'CButtonColumn',								
			'template'=>'{ver}&nbsp;{editar}&nbsp;{borrar}',
			'htmlOptions' => array('style'=>'white-space: nowrap'),
			'buttons'=>array(
			    
                'ver' => array(
                    'label'=>'', 
                    'url'=>'$data->id_datos_basicos',     
                    'options'=>array('class'=>'fa fa-eye fa-lg tooltips','data-toggle'=>'tooltip','data-original-title'=>'Ver Datos'),
                    'click'=>'function(){ return false; }',
                    'live'=>false                         
                ),

                'editar' => array(
			        'label'=>'', 
			        'url'=>'"/idP/".$data->id_datos_basicos',		
			        'options'=>array('class'=>'fa fa-pencil fa-lg tooltips','data-toggle'=>'tooltip','data-original-title'=>'Editar Datos'),
			        'click'=>'function(){ getCotizacionResponsable($(this).attr("href")); return false; }',
			    	'live'=>false,				          
			    ),

                'borrar' => array(
                    'label'=>'', 
                    'url'=>'$data->id_datos_basicos',     
                    'options'=>array('class'=>'fa fa-trash fa-lg tooltips','data-toggle'=>'tooltip','data-original-title'=>'Eliminar Beneficiario'),
                    'click'=>'function(){ return false; }',
                    'live'=>false         
                ),

			),	
		),
	),
)); ?>
</div>