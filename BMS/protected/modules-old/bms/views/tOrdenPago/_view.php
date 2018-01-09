<?php
/* @var $this TOrdenPagoController */
/* @var $data TOrdenPago */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_orden_pago')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_orden_pago), array('view', 'id'=>$data->id_orden_pago)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_orden')); ?>:</b>
	<?php echo CHtml::encode($data->id_orden); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_banco')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_banco); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('numero_cuenta')); ?>:</b>
	<?php echo CHtml::encode($data->numero_cuenta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('numero_ruta_bancaria')); ?>:</b>
	<?php echo CHtml::encode($data->numero_ruta_bancaria); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_tarjeta')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_tarjeta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('numero_tarjeta')); ?>:</b>
	<?php echo CHtml::encode($data->numero_tarjeta); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_tarjeta')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_tarjeta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('monto')); ?>:</b>
	<?php echo CHtml::encode($data->monto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comision')); ?>:</b>
	<?php echo CHtml::encode($data->comision); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_medio_pago')); ?>:</b>
	<?php echo CHtml::encode($data->id_medio_pago); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_pago')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_pago); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comisionPorcentaje')); ?>:</b>
	<?php echo CHtml::encode($data->comisionPorcentaje); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comisionValorFijo')); ?>:</b>
	<?php echo CHtml::encode($data->comisionValorFijo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estatus')); ?>:</b>
	<?php echo CHtml::encode($data->id_estatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />

	*/ ?>

</div>