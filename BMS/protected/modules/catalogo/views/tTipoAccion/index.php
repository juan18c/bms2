<?php
/* @var $this TTipoAccionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ttipo Accions',
);

$this->menu=array(
	array('label'=>'Create TTipoAccion', 'url'=>array('create')),
	array('label'=>'Manage TTipoAccion', 'url'=>array('admin')),
);
?>

<h1>Ttipo Accions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
