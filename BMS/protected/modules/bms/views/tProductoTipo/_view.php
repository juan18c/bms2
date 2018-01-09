<?php
/* @var $this TProductoTipoController */
/* @var $data TProductoTipo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_producto_tipo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_producto_tipo), array('view', 'id'=>$data->id_producto_tipo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estatus')); ?>:</b>
	<?php echo CHtml::encode($data->id_estatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />


</div>