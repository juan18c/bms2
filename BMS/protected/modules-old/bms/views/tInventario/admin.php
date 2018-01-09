<?php
/* @var $this TInventarioController */
/* @var $model TInventario */

$this->breadcrumbs=array(
	'Tinventarios'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List TInventario', 'url'=>array('index')),
	array('label'=>'Create TInventario', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tinventario-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Tinventarios</h1>

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
	'id'=>'tinventario-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_inventario',
		'id_producto',
		'cantidad',
		'stock_minimo',
		'stock_maximo',
		'fecha_compra',
		/*
		'fecha_vencimiento',
		'precio',
		'id_almacen',
		'tipo_almacenamiento',
		'id_estatus',
		'fecha_creacion',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
