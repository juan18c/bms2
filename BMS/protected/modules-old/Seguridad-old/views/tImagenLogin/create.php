<?php
/* @var $this TImagenLoginController */
/* @var $model TImagenLogin */

$this->breadcrumbs=array(
	'Timagen Logins'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TImagenLogin', 'url'=>array('index')),
	array('label'=>'Manage TImagenLogin', 'url'=>array('admin')),
);
?>

<h1>Create TImagenLogin</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>