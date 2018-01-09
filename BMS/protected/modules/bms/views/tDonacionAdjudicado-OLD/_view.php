<?php
/* @var $this TDonacionAdjudicadoController */
/* @var $data TDonacionAdjudicado */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_donacion_adjudicado')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_donacion_adjudicado), array('view', 'id'=>$data->id_donacion_adjudicado)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_donacion')); ?>:</b>
	<?php echo CHtml::encode($data->id_donacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('monto')); ?>:</b>
	<?php echo CHtml::encode($data->monto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_donador')); ?>:</b>
	<?php echo CHtml::encode($data->id_donador); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estatus')); ?>:</b>
	<?php echo CHtml::encode($data->id_estatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comentario')); ?>:</b>
	<?php echo CHtml::encode($data->comentario); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('publico')); ?>:</b>
	<?php echo CHtml::encode($data->publico); ?>
	<br />

	*/ ?>

</div>