<?php
/* @var $this TImagenLoginUsuarioController */
/* @var $data TImagenLoginUsuario */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_imagen_login_usuario')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_imagen_login_usuario), array('view', 'id'=>$data->id_imagen_login_usuario)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_usuario')); ?>:</b>
	<?php echo CHtml::encode($data->id_usuario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_imagen')); ?>:</b>
	<?php echo CHtml::encode($data->id_imagen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_clinica')); ?>:</b>
	<?php echo CHtml::encode($data->id_clinica); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estatus')); ?>:</b>
	<?php echo CHtml::encode($data->id_estatus); ?>
	<br />
</div>