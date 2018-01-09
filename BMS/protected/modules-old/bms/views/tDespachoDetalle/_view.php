<?php
/* @var $this TDespachoDetalleController */
/* @var $data TDespachoDetalle */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_despacho_detalle')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_despacho_detalle), array('view', 'id'=>$data->id_despacho_detalle)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_despacho')); ?>:</b>
	<?php echo CHtml::encode($data->id_despacho); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_producto')); ?>:</b>
	<?php echo CHtml::encode($data->id_producto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cantidad_solicitada')); ?>:</b>
	<?php echo CHtml::encode($data->cantidad_solicitada); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('precio')); ?>:</b>
	<?php echo CHtml::encode($data->precio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cantidad_despachada')); ?>:</b>
	<?php echo CHtml::encode($data->cantidad_despachada); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_despacho')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_despacho); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estatus')); ?>:</b>
	<?php echo CHtml::encode($data->id_estatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />

	*/ ?>

</div>