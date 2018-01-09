<?php
/* @var $this TProductoCategoriaController */
/* @var $data TProductoCategoria */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_producto_categoria')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_producto_categoria), array('view', 'id'=>$data->id_producto_categoria)); ?>
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