<?php
/* @var $this THistoriaMedicaController */
/* @var $data THistoriaMedica */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_historia_medica')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_historia_medica), array('view', 'id'=>$data->id_historia_medica)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_responsable')); ?>:</b>
	<?php echo CHtml::encode($data->id_responsable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estatus')); ?>:</b>
	<?php echo CHtml::encode($data->id_estatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />


</div>