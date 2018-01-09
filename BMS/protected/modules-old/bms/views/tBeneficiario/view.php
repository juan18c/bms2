<?php
/* @var $this TBeneficiarioController */
/* @var $model TBeneficiario */

$this->breadcrumbs=array(
	'Tbeneficiarios'=>array('index'),
	$model->id_beneficiario,
);

$this->menu=array(
	array('label'=>'List TBeneficiario', 'url'=>array('index')),
	array('label'=>'Create TBeneficiario', 'url'=>array('create')),
	array('label'=>'Update TBeneficiario', 'url'=>array('update', 'id'=>$model->id_beneficiario)),
	array('label'=>'Delete TBeneficiario', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_beneficiario),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TBeneficiario', 'url'=>array('admin')),
);
?>

<h1>View TBeneficiario #<?php echo $model->id_beneficiario; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_beneficiario',
		'id_responsable',
		'id_parentesco',
		'id_estatus',
		'fecha_creacion',
	),
)); ?>
