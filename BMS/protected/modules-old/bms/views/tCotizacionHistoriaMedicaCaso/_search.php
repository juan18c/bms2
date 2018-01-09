<?php
/* @var $this TCotizacionHistoriaMedicaCasoController */
/* @var $model TCotizacionHistoriaMedicaCaso */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_cotizacion_historia_caso'); ?>
		<?php echo $form->textField($model,'id_cotizacion_historia_caso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_cotizacion'); ?>
		<?php echo $form->textField($model,'id_cotizacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_historia_medica_caso'); ?>
		<?php echo $form->textField($model,'id_historia_medica_caso'); ?>
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