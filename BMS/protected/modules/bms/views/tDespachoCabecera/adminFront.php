<?php
/* @var $this TDespachoCabeceraController */
/* @var $model TDespachoCabecera */

$this->breadcrumbs=array(
	'Tdespacho Cabeceras'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List TDespachoCabecera', 'url'=>array('index')),
	array('label'=>'Create TDespachoCabecera', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tdespacho-cabecera-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<a href="<?php echo Yii::app()->createUrl('bms/TDespachoCabecera/admin'); ?>" target="_blank" class="btn btn-default">Ver Todos</a>
<div class="adv-table table-responsive">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tdespacho-cabecera-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'itemsCssClass'=>'table table-bordered table-striped table-condensed',
	'columns'=>array(
		'id_despacho',
		'codigo_despacho',
		'id_orden',
		'items',
		'monto_total',
		'id_tipo_accion',
		/*
		'id_estatus',
		'fecha_creacion',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>