<?php
/* @var $this TDatosBasicosController */
/* @var $data TDatosBasicos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_datos_basicos')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_datos_basicos), array('view', 'id'=>$data->id_datos_basicos)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tipo_identificacion')); ?>:</b>
	<?php echo CHtml::encode($data->id_tipo_identificacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nro_identificacion')); ?>:</b>
	<?php echo CHtml::encode($data->nro_identificacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('titular')); ?>:</b>
	<?php echo CHtml::encode($data->titular); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombres')); ?>:</b>
	<?php echo CHtml::encode($data->nombres); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('apellidos')); ?>:</b>
	<?php echo CHtml::encode($data->apellidos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sexo')); ?>:</b>
	<?php echo CHtml::encode($data->sexo); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_nacimiento')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_nacimiento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nacionalidad')); ?>:</b>
	<?php echo CHtml::encode($data->nacionalidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estado_civil')); ?>:</b>
	<?php echo CHtml::encode($data->id_estado_civil); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estatus')); ?>:</b>
	<?php echo CHtml::encode($data->id_estatus); ?>
	<br />

	*/ ?>

</div>