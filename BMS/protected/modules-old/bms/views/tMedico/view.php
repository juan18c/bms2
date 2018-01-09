<?php
/* @var $this TMedicoController */
/* @var $model TMedico */

$this->breadcrumbs=array(
	'Tmedicos'=>array('index'),
	$model->id_medico,
);

$this->menu=array(
	array('label'=>'List TMedico', 'url'=>array('index')),
	array('label'=>'Create TMedico', 'url'=>array('create')),
	array('label'=>'Update TMedico', 'url'=>array('update', 'id'=>$model->id_medico)),
	array('label'=>'Delete TMedico', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_medico),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TMedico', 'url'=>array('admin')),
);
?>

<h1>View TMedico #<?php echo $model->id_medico; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_medico',
		'id_datos_basicos',
		'cod_matricula',
		'id_estatus',
		'fecha_creacion',
		'rif',
		'logo_recipe',
		'ind_modulo_cita',
		'dias_consulta',
		'tipo_atencion',
		'datos_contacto',
		'ind_aprobado',
	),
)); ?>
