<?php
/* @var $this TCarritoController */
/* @var $data TCarrito */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_carrito')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_carrito), array('view', 'id'=>$data->id_carrito)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_datos_basicos')); ?>:</b>
	<?php echo CHtml::encode($data->id_datos_basicos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tipo_accion')); ?>:</b>
	<?php echo CHtml::encode($data->id_tipo_accion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estatus')); ?>:</b>
	<?php echo CHtml::encode($data->id_estatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />


</div>