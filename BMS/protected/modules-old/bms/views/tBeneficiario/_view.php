<?php
/* @var $this TBeneficiarioController */
/* @var $data TBeneficiario */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_beneficiario')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_beneficiario), array('view', 'id'=>$data->id_beneficiario)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_responsable')); ?>:</b>
	<?php echo CHtml::encode($data->id_responsable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_parentesco')); ?>:</b>
	<?php echo CHtml::encode($data->id_parentesco); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estatus')); ?>:</b>
	<?php echo CHtml::encode($data->id_estatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />


</div>