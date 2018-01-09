<?php
/* @var $this TDespachoEnvioController */
/* @var $data TDespachoEnvio */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_despacho_envio')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_despacho_envio), array('view', 'id'=>$data->id_despacho_envio)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_despacho')); ?>:</b>
	<?php echo CHtml::encode($data->id_despacho); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_orden')); ?>:</b>
	<?php echo CHtml::encode($data->id_orden); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('numero_tracking')); ?>:</b>
	<?php echo CHtml::encode($data->numero_tracking); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('courier')); ?>:</b>
	<?php echo CHtml::encode($data->courier); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('items')); ?>:</b>
	<?php echo CHtml::encode($data->items); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('monto_total')); ?>:</b>
	<?php echo CHtml::encode($data->monto_total); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_despacho')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_despacho); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estatus')); ?>:</b>
	<?php echo CHtml::encode($data->id_estatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />

	*/ ?>

</div>