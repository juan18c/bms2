<?php
/* @var $this THistoriaMedicaDocumentoController */
/* @var $model THistoriaMedicaDocumento */

$this->breadcrumbs=array(
	'Thistoria Medica Documentos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List THistoriaMedicaDocumento', 'url'=>array('index')),
	array('label'=>'Manage THistoriaMedicaDocumento', 'url'=>array('admin')),
);
?>

<h1>Create THistoriaMedicaDocumento</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>