<?php
/* @var $this TOrdenController */
/* @var $model TOrden */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_orden'); ?>
		<?php echo $form->textField($model,'id_orden'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'codigo_orden'); ?>
		<?php echo $form->textField($model,'codigo_orden',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_cotizacion'); ?>
		<?php echo $form->textField($model,'id_cotizacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_beneficiario'); ?>
		<?php echo $form->textField($model,'id_beneficiario'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'items'); ?>
		<?php echo $form->textField($model,'items'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'monto_total'); ?>
		<?php echo $form->textField($model,'monto_total'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'saldo'); ?>
		<?php echo $form->textField($model,'saldo'); ?>
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