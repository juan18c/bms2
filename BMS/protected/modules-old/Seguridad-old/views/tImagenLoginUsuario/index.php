<?php
/* @var $this TImagenLoginUsuarioController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Timagen Login Usuarios',
);

$this->menu=array(
	array('label'=>'Create TImagenLoginUsuario', 'url'=>array('create')),
	array('label'=>'Manage TImagenLoginUsuario', 'url'=>array('admin')),
);
?>

<h1>Timagen Login Usuarios</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
