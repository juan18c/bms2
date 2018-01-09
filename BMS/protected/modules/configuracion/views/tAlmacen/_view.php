<?php
/* @var $this TAlmacenController */
/* @var $data TAlmacen */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_almacen')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_almacen), array('view', 'id'=>$data->id_almacen)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_pais')); ?>:</b>
	<?php echo CHtml::encode($data->id_pais); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_moneda_base')); ?>:</b>
	<?php echo CHtml::encode($data->id_moneda_base); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_moneda_venta')); ?>:</b>
	<?php echo CHtml::encode($data->id_moneda_venta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_estatus')); ?>:</b>
	<?php echo CHtml::encode($data->id_estatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_creacion); ?>
	<br />


</div>