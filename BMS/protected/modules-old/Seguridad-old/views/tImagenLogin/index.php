<?php
/* @var $this TImagenLoginController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Timagen Logins',
);

$this->menu=array(
	array('label'=>'Create TImagenLogin', 'url'=>array('create')),
	array('label'=>'Manage TImagenLogin', 'url'=>array('admin')),
);
?>

<h1>Timagen Logins</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
