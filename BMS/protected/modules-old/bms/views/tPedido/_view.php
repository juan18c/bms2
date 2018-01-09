<?php
/* @var $this TPedidoController */
/* @var $data TPedido */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_pedido')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_pedido), array('view', 'id'=>$data->id_pedido)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_carrito')); ?>:</b>
	<?php echo CHtml::encode($data->id_carrito); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_medio_pago')); ?>:</b>
	<?php echo CHtml::encode($data->id_medio_pago); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('monto_total')); ?>:</b>
	<?php echo CHtml::encode($data->monto_total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estatus')); ?>:</b>
	<?php echo CHtml::encode($data->id_estatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />


</div>