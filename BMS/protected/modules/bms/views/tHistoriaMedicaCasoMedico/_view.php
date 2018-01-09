<?php
/* @var $this THistoriaMedicaCasoMedicoController */
/* @var $data THistoriaMedicaCasoMedico */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_historia_medica_medico')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_historia_medica_medico), array('view', 'id'=>$data->id_historia_medica_medico)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_historia_medica_caso')); ?>:</b>
	<?php echo CHtml::encode($data->id_historia_medica_caso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_medico')); ?>:</b>
	<?php echo CHtml::encode($data->id_medico); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estatus')); ?>:</b>
	<?php echo CHtml::encode($data->id_estatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />


</div>