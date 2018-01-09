<?php
/* @var $this TInventarioController */
/* @var $data TInventario */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_inventario')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_inventario), array('view', 'id'=>$data->id_inventario)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_producto')); ?>:</b>
	<?php echo CHtml::encode($data->id_producto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cantidad')); ?>:</b>
	<?php echo CHtml::encode($data->cantidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stock_minimo')); ?>:</b>
	<?php echo CHtml::encode($data->stock_minimo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stock_maximo')); ?>:</b>
	<?php echo CHtml::encode($data->stock_maximo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_compra')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_compra); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_vencimiento')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_vencimiento); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('precio')); ?>:</b>
	<?php echo CHtml::encode($data->precio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_almacen')); ?>:</b>
	<?php echo CHtml::encode($data->id_almacen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_almacenamiento')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_almacenamiento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estatus')); ?>:</b>
	<?php echo CHtml::encode($data->id_estatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />

	*/ ?>

</div>