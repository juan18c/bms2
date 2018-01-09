<?php
/* @var $this THistoriaMedicaCasoMedicoController */
/* @var $model THistoriaMedicaCasoMedico */

$this->breadcrumbs=array(
	'Thistoria Medica Caso Medicos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List THistoriaMedicaCasoMedico', 'url'=>array('index')),
	array('label'=>'Create THistoriaMedicaCasoMedico', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#thistoria-medica-caso-medico-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Thistoria Medica Caso Medicos</h1>

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
	'id'=>'thistoria-medica-caso-medico-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_historia_medica_medico',
		'id_historia_medica_caso',
		'id_medico',
		'id_estatus',
		'fecha_creacion',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>