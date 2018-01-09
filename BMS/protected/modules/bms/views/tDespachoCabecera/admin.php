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

<h1>Manage Tdespacho Cabeceras</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tdespacho-cabecera-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
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
