<?php
/* @var $this TProveedorController */
/* @var $data TProveedor */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_proveedor')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_proveedor), array('view', 'id'=>$data->id_proveedor)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_datos_basicos')); ?>:</b>
	<?php echo CHtml::encode($data->id_datos_basicos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_responsable')); ?>:</b>
	<?php echo CHtml::encode($data->id_responsable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estatus')); ?>:</b>
	<?php echo CHtml::encode($data->id_estatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />


</div>