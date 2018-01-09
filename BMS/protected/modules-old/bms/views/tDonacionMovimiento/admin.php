<?php
/* @var $this TDonacionMovimientoController */
/* @var $model TDonacionMovimiento */

$this->breadcrumbs=array(
	'Tdonacion Movimientos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List TDonacionMovimiento', 'url'=>array('index')),
	array('label'=>'Create TDonacionMovimiento', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tdonacion-movimiento-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Tdonacion Movimientos</h1>

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
	'id'=>'tdonacion-movimiento-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_donacion_movimiento',
		'id_donacion_adjudicado',
		'id_credito_donacion',
		'monto_credito',
		'monto_debito',
		'id_estatus',
		/*
		'id_donacion',
		'id_orden',
		'fecha_creacion',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
