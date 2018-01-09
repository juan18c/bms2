<?php
/* @var $this TUsuarioController */
/* @var $data TUsuario */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_usuario')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_usuario), array('view', 'id'=>$data->id_usuario)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usuario')); ?>:</b>
	<?php echo CHtml::encode($data->usuario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('palabra_clave')); ?>:</b>
	<?php echo CHtml::encode($data->palabra_clave); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nro_intentos')); ?>:</b>
	<?php echo CHtml::encode($data->nro_intentos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_persona')); ?>:</b>
	<?php echo CHtml::encode($data->id_persona); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_usuario')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_usuario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estatus')); ?>:</b>
	<?php echo CHtml::encode($data->id_estatus); ?>
	<br />


</div>