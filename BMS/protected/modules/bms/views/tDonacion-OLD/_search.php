<?php
/* @var $this TDonacionController */
/* @var $model TDonacion */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_donacion'); ?>
		<?php echo $form->textField($model,'id_donacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'codigo_donacion'); ?>
		<?php echo $form->textField($model,'codigo_donacion',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_cotizacion'); ?>
		<?php echo $form->textField($model,'id_cotizacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'monto_acumulado'); ?>
		<?php echo $form->textField($model,'monto_acumulado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'diagnostico'); ?>
		<?php echo $form->textField($model,'diagnostico',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sintomas'); ?>
		<?php echo $form->textField($model,'sintomas',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'resumen'); ?>
		<?php echo $form->textField($model,'resumen',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'objetivo'); ?>
		<?php echo $form->textField($model,'objetivo',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'foto'); ?>
		<?php echo $form->textField($model,'foto',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'video'); ?>
		<?php echo $form->textField($model,'video',array('size'=>60,'maxlength'=>250)); ?>
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