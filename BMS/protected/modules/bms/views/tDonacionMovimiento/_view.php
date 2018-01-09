<?php
/* @var $this TDonacionMovimientoController */
/* @var $data TDonacionMovimiento */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_donacion_movimiento')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_donacion_movimiento), array('view', 'id'=>$data->id_donacion_movimiento)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_donacion_adjudicado')); ?>:</b>
	<?php echo CHtml::encode($data->id_donacion_adjudicado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_credito_donacion')); ?>:</b>
	<?php echo CHtml::encode($data->id_credito_donacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('monto_credito')); ?>:</b>
	<?php echo CHtml::encode($data->monto_credito); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('monto_debito')); ?>:</b>
	<?php echo CHtml::encode($data->monto_debito); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estatus')); ?>:</b>
	<?php echo CHtml::encode($data->id_estatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_donacion')); ?>:</b>
	<?php echo CHtml::encode($data->id_donacion); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('id_orden')); ?>:</b>
	<?php echo CHtml::encode($data->id_orden); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />

	*/ ?>

</div>