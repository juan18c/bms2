<?php
/* @var $this TMedicoController */
/* @var $data TMedico */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_medico')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_medico), array('view', 'id'=>$data->id_medico)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_datos_basicos')); ?>:</b>
	<?php echo CHtml::encode($data->id_datos_basicos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cod_matricula')); ?>:</b>
	<?php echo CHtml::encode($data->cod_matricula); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estatus')); ?>:</b>
	<?php echo CHtml::encode($data->id_estatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rif')); ?>:</b>
	<?php echo CHtml::encode($data->rif); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('logo_recipe')); ?>:</b>
	<?php echo CHtml::encode($data->logo_recipe); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('ind_modulo_cita')); ?>:</b>
	<?php echo CHtml::encode($data->ind_modulo_cita); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dias_consulta')); ?>:</b>
	<?php echo CHtml::encode($data->dias_consulta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_atencion')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_atencion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datos_contacto')); ?>:</b>
	<?php echo CHtml::encode($data->datos_contacto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ind_aprobado')); ?>:</b>
	<?php echo CHtml::encode($data->ind_aprobado); ?>
	<br />

	*/ ?>

</div>