<?php
/* @var $this TImagenLoginUsuarioController */
/* @var $model TImagenLoginUsuario */

$this->breadcrumbs=array(
	'Timagen Login Usuarios'=>array('index'),
	$model->id_usuario=>array('view','id'=>$model->id_usuario),
	'Update',
);

$this->menu=array(
	array('label'=>'List TImagenLoginUsuario', 'url'=>array('index')),
	array('label'=>'Create TImagenLoginUsuario', 'url'=>array('create')),
	array('label'=>'View TImagenLoginUsuario', 'url'=>array('view', 'id'=>$model->id_usuario)),
	array('label'=>'Manage TImagenLoginUsuario', 'url'=>array('admin')),
);
?>

<h1>Update TImagenLoginUsuario <?php echo $model->id_usuario; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>