<?php
/* @var $this TOrdenController */
/* @var $data TOrden */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_orden')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_orden), array('view', 'id'=>$data->id_orden)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo_orden')); ?>:</b>
	<?php echo CHtml::encode($data->codigo_orden); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cotizacion')); ?>:</b>
	<?php echo CHtml::encode($data->id_cotizacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_beneficiario')); ?>:</b>
	<?php echo CHtml::encode($data->id_beneficiario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('items')); ?>:</b>
	<?php echo CHtml::encode($data->items); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('monto_total')); ?>:</b>
	<?php echo CHtml::encode($data->monto_total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('saldo')); ?>:</b>
	<?php echo CHtml::encode($data->saldo); ?>
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