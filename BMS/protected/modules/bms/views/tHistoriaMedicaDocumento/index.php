<?php
/* @var $this THistoriaMedicaDocumentoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Thistoria Medica Documentos',
);

$this->menu=array(
	array('label'=>'Create THistoriaMedicaDocumento', 'url'=>array('create')),
	array('label'=>'Manage THistoriaMedicaDocumento', 'url'=>array('admin')),
);
?>

<h1>Thistoria Medica Documentos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
