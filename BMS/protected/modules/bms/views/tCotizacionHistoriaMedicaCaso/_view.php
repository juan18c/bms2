<?php
/* @var $this TCotizacionHistoriaMedicaCasoController */
/* @var $data TCotizacionHistoriaMedicaCaso */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cotizacion_historia_caso')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_cotizacion_historia_caso), array('view', 'id'=>$data->id_cotizacion_historia_caso)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cotizacion')); ?>:</b>
	<?php echo CHtml::encode($data->id_cotizacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_historia_medica_caso')); ?>:</b>
	<?php echo CHtml::encode($data->id_historia_medica_caso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estatus')); ?>:</b>
	<?php echo CHtml::encode($data->id_estatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />


</div>