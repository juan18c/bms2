<?php
/* @var $this TCreditoDonacionController */
/* @var $data TCreditoDonacion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_credito_donacion')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_credito_donacion), array('view', 'id'=>$data->id_credito_donacion)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_donacion')); ?>:</b>
	<?php echo CHtml::encode($data->id_donacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('monto_disponible')); ?>:</b>
	<?php echo CHtml::encode($data->monto_disponible); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_usuario')); ?>:</b>
	<?php echo CHtml::encode($data->id_usuario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estatus')); ?>:</b>
	<?php echo CHtml::encode($data->id_estatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />


</div>