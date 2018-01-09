<?php
/* @var $this TMedicoController */
/* @var $model TMedico */

$this->breadcrumbs=array(
	'Tmedicos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List TMedico', 'url'=>array('index')),
	array('label'=>'Create TMedico', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tmedico-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Tmedicos</h1>

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
	'id'=>'tmedico-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_medico',
		'id_datos_basicos',
		'cod_matricula',
		'id_estatus',
		'fecha_creacion',
		'rif',
		/*
		'logo_recipe',
		'ind_modulo_cita',
		'dias_consulta',
		'tipo_atencion',
		'datos_contacto',
		'ind_aprobado',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
