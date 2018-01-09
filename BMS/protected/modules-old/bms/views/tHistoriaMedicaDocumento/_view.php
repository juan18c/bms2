<?php
/* @var $this THistoriaMedicaDocumentoController */
/* @var $data THistoriaMedicaDocumento */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_historia_medica_documento')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_historia_medica_documento), array('view', 'id'=>$data->id_historia_medica_documento)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_historia_medica_caso')); ?>:</b>
	<?php echo CHtml::encode($data->id_historia_medica_caso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ruta')); ?>:</b>
	<?php echo CHtml::encode($data->ruta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tamanio')); ?>:</b>
	<?php echo CHtml::encode($data->tamanio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo')); ?>:</b>
	<?php echo CHtml::encode($data->tipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estatus')); ?>:</b>
	<?php echo CHtml::encode($data->id_estatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />


</div>