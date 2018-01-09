<?php
/* @var $this TDespachoCabeceraController */
/* @var $data TDespachoCabecera */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_despacho')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_despacho), array('view', 'id'=>$data->id_despacho)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo_despacho')); ?>:</b>
	<?php echo CHtml::encode($data->codigo_despacho); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_orden')); ?>:</b>
	<?php echo CHtml::encode($data->id_orden); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('items')); ?>:</b>
	<?php echo CHtml::encode($data->items); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('monto_total')); ?>:</b>
	<?php echo CHtml::encode($data->monto_total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tipo_accion')); ?>:</b>
	<?php echo CHtml::encode($data->id_tipo_accion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estatus')); ?>:</b>
	<?php echo CHtml::encode($data->id_estatus); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />

	*/ ?>

</div>