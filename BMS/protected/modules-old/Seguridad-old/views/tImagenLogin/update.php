<?php
/* @var $this TImagenLoginController */
/* @var $model TImagenLogin */

$this->breadcrumbs=array(
	'Timagen Logins'=>array('index'),
	$model->id_imagen=>array('view','id'=>$model->id_imagen),
	'Update',
);

$this->menu=array(
	array('label'=>'List TImagenLogin', 'url'=>array('index')),
	array('label'=>'Create TImagenLogin', 'url'=>array('create')),
	array('label'=>'View TImagenLogin', 'url'=>array('view', 'id'=>$model->id_imagen)),
	array('label'=>'Manage TImagenLogin', 'url'=>array('admin')),
);
?>

<h1>Update TImagenLogin <?php echo $model->id_imagen; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>