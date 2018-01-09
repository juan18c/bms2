<?php
/* @var $this THistoriaMedicaCasoController */
/* @var $model THistoriaMedicaCaso */

$this->breadcrumbs=array(
	'Thistoria Medica Casos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List THistoriaMedicaCaso', 'url'=>array('index')),
	array('label'=>'Create THistoriaMedicaCaso', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#thistoria-medica-caso-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Thistoria Medica Casos</h1>

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
	'id'=>'thistoria-medica-caso-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_historia_medica_caso',
		'id_historia_medica',
		'nombre',
		'tipo_carga',
		'duracion',
		'frecuencia',
		/*
		'id_cotizacion',
		'fecha_realizacion',
		'id_estatus',
		'fecha_creacion',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
