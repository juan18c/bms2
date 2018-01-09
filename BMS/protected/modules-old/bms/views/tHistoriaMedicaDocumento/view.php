<?php
/* @var $this THistoriaMedicaDocumentoController */
/* @var $model THistoriaMedicaDocumento */

$this->breadcrumbs=array(
	'Thistoria Medica Documentos'=>array('index'),
	$model->id_historia_medica_documento,
);

$this->menu=array(
	array('label'=>'List THistoriaMedicaDocumento', 'url'=>array('index')),
	array('label'=>'Create THistoriaMedicaDocumento', 'url'=>array('create')),
	array('label'=>'Update THistoriaMedicaDocumento', 'url'=>array('update', 'id'=>$model->id_historia_medica_documento)),
	array('label'=>'Delete THistoriaMedicaDocumento', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_historia_medica_documento),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage THistoriaMedicaDocumento', 'url'=>array('admin')),
);
?>

<h1>View THistoriaMedicaDocumento #<?php echo $model->id_historia_medica_documento; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_historia_medica_documento',
		'id_historia_medica_caso',
		'ruta',
		'tamanio',
		'tipo',
		'id_estatus',
		'fecha_creacion',
	),
)); ?>
