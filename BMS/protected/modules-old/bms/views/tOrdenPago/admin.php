<?php
/* @var $this TOrdenPagoController */
/* @var $model TOrdenPago */

$this->breadcrumbs=array(
	'Torden Pagos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List TOrdenPago', 'url'=>array('index')),
	array('label'=>'Create TOrdenPago', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#torden-pago-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Torden Pagos</h1>

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
	'id'=>'torden-pago-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_orden_pago',
		'id_orden',
		'nombre_banco',
		'numero_cuenta',
		'numero_ruta_bancaria',
		'nombre_tarjeta',
		/*
		'numero_tarjeta',
		'tipo_tarjeta',
		'monto',
		'comision',
		'email',
		'id_medio_pago',
		'fecha_pago',
		'comisionPorcentaje',
		'comisionValorFijo',
		'id_estatus',
		'fecha_creacion',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
