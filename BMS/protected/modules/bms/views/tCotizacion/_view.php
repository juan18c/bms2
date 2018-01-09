<?php
/* @var $this TCotizacionController */
/* @var $data TCotizacion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cotizacion')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_cotizacion), array('view', 'id'=>$data->id_cotizacion)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_carrito')); ?>:</b>
	<?php echo CHtml::encode($data->id_carrito); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_responsable')); ?>:</b>
	<?php echo CHtml::encode($data->id_responsable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_beneficiario')); ?>:</b>
	<?php echo CHtml::encode($data->id_beneficiario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datos_envio')); ?>:</b>
	<?php echo CHtml::encode($data->datos_envio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('duracion_tratamiento')); ?>:</b>
	<?php echo CHtml::encode($data->duracion_tratamiento); ?>
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