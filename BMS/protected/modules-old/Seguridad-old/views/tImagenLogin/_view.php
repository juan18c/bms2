<?php
/* @var $this TImagenLoginController */
/* @var $data TImagenLogin */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_imagen')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_imagen), array('view', 'id'=>$data->id_imagen)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('grupo')); ?>:</b>
	<?php echo CHtml::encode($data->grupo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dias_vigentes')); ?>:</b>
	<?php echo CHtml::encode($data->dias_vigentes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estatus')); ?>:</b>
	<?php echo CHtml::encode($data->id_estatus); ?>
	<br />


</div>