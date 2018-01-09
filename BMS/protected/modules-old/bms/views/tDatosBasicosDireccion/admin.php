<?php
/* @var $this TDatosBasicosDireccionController */
/* @var $model TDatosBasicosDireccion */
?>

<h1>Mis Direcciones</h1>

<div class="adv-table">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tdatos-basicos-direccion-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'itemsCssClass'=>'table table-bordered table-striped table-condensed',
	'columns'=>array(
		'id_datos_basicos_direccion',
		'id_datos_basicos',
		'direccion1',
		'direccion2',
		'codigo_zip',
		'id_tipo_direccion',
		/*
		'id_pais',
		'ciudad',
		'estado',
		'telefono_fijo',
		'indicador_factura',
		'indicador_envio',
		'fecha_creacion',
		'id_estatus',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>