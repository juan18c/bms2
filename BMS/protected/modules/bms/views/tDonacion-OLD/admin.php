<?php
/* @var $this TDonacionController */
/* @var $model TDonacion */

$this->breadcrumbs=array(
	'Tdonacions'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List TDonacion', 'url'=>array('index')),
	array('label'=>'Create TDonacion', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tdonacion-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Lista de Donadores</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tdonacion-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id_donacion',
		'codigo_donacion',
		//'id_cotizacion',
		'monto_acumulado',
		'diagnostico',
		'sintomas',
		/*
		'resumen',
		'objetivo',
		'foto',
		'video',
		'id_estatus',
		'fecha_creacion',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
