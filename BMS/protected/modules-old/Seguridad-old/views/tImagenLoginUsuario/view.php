<?php
/* @var $this TImagenLoginUsuarioController */
/* @var $model TImagenLoginUsuario */

$this->breadcrumbs=array(
	'Timagen Login Usuarios'=>array('index'),
	$model->id_imagen_login_usuario,
);


?>

<h1>Ver Imagen de seguridad para clinica #<?php echo $model->id_imagen_login_usuario; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_usuario',
		'id_imagen',
		'id_clinica',
		'fecha_creacion',
		'id_estatus',
		'id_imagen_login_usuario',
	),
)); ?>
