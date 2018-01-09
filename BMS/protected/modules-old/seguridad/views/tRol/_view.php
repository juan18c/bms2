<?php
/* @var $this TRolController */
/* @var $data TRol */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_rol')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_rol), array('view', 'id'=>$data->id_rol)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_rol')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_rol); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('multi_ip')); ?>:</b>
	<?php echo CHtml::encode($data->multi_ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('multi_sesion')); ?>:</b>
	<?php echo CHtml::encode($data->multi_sesion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estatus')); ?>:</b>
	<?php echo CHtml::encode($data->id_estatus); ?>
	<br />


</div>