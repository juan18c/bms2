<?php
/* @var $this THistoriaMedicaCasoController */
/* @var $data THistoriaMedicaCaso */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_historia_medica_caso')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_historia_medica_caso), array('view', 'id'=>$data->id_historia_medica_caso)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_historia_medica')); ?>:</b>
	<?php echo CHtml::encode($data->id_historia_medica); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_carga')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_carga); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('duracion')); ?>:</b>
	<?php echo CHtml::encode($data->duracion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('frecuencia')); ?>:</b>
	<?php echo CHtml::encode($data->frecuencia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cotizacion')); ?>:</b>
	<?php echo CHtml::encode($data->id_cotizacion); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_realizacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_realizacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estatus')); ?>:</b>
	<?php echo CHtml::encode($data->id_estatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />

	*/ ?>

</div>