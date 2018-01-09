<?php
/* @var $this THistoriaMedicaDocumentoController */
/* @var $model THistoriaMedicaDocumento */

$this->breadcrumbs=array(
	'Thistoria Medica Documentos'=>array('index'),
	$model->id_historia_medica_documento=>array('view','id'=>$model->id_historia_medica_documento),
	'Update',
);

$this->menu=array(
	array('label'=>'List THistoriaMedicaDocumento', 'url'=>array('index')),
	array('label'=>'Create THistoriaMedicaDocumento', 'url'=>array('create')),
	array('label'=>'View THistoriaMedicaDocumento', 'url'=>array('view', 'id'=>$model->id_historia_medica_documento)),
	array('label'=>'Manage THistoriaMedicaDocumento', 'url'=>array('admin')),
);
?>

<h1>Update THistoriaMedicaDocumento <?php echo $model->id_historia_medica_documento; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>