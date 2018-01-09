<?php
/* @var $this TDespachoDetalleController */
/* @var $model TDespachoDetalle */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_despacho_detalle'); ?>
		<?php echo $form->textField($model,'id_despacho_detalle'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_despacho'); ?>
		<?php echo $form->textField($model,'id_despacho'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_producto'); ?>
		<?php echo $form->textField($model,'id_producto'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cantidad_solicitada'); ?>
		<?php echo $form->textField($model,'cantidad_solicitada'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'precio'); ?>
		<?php echo $form->textField($model,'precio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cantidad_despachada'); ?>
		<?php echo $form->textField($model,'cantidad_despachada'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_despacho'); ?>
		<?php echo $form->textField($model,'fecha_despacho'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_estatus'); ?>
		<?php echo $form->textField($model,'id_estatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_creacion'); ?>
		<?php echo $form->textField($model,'fecha_creacion'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->