<?php
/* @var $this TDatosBasicosDireccionController */
/* @var $data TDatosBasicosDireccion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_datos_basicos_direccion')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_datos_basicos_direccion), array('view', 'id'=>$data->id_datos_basicos_direccion)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_datos_basicos')); ?>:</b>
	<?php echo CHtml::encode($data->id_datos_basicos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('direccion1')); ?>:</b>
	<?php echo CHtml::encode($data->direccion1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('direccion2')); ?>:</b>
	<?php echo CHtml::encode($data->direccion2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo_zip')); ?>:</b>
	<?php echo CHtml::encode($data->codigo_zip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tipo_direccion')); ?>:</b>
	<?php echo CHtml::encode($data->id_tipo_direccion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_pais')); ?>:</b>
	<?php echo CHtml::encode($data->id_pais); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('ciudad')); ?>:</b>
	<?php echo CHtml::encode($data->ciudad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefono_fijo')); ?>:</b>
	<?php echo CHtml::encode($data->telefono_fijo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('indicador_factura')); ?>:</b>
	<?php echo CHtml::encode($data->indicador_factura); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('indicador_envio')); ?>:</b>
	<?php echo CHtml::encode($data->indicador_envio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estatus')); ?>:</b>
	<?php echo CHtml::encode($data->id_estatus); ?>
	<br />

	*/ ?>

</div>