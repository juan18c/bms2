<?php
/* @var $this TDatosBasicosController */
/* @var $model TDatosBasicos */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_datos_basicos'); ?>
		<?php echo $form->textField($model,'id_datos_basicos'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_tipo_identificacion'); ?>
		<?php echo $form->textField($model,'id_tipo_identificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nro_identificacion'); ?>
		<?php echo $form->textField($model,'nro_identificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'titular'); ?>
		<?php echo $form->textField($model,'titular'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombres'); ?>
		<?php echo $form->textField($model,'nombres',array('size'=>60,'maxlength'=>60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'apellidos'); ?>
		<?php echo $form->textField($model,'apellidos',array('size'=>60,'maxlength'=>60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sexo'); ?>
		<?php echo $form->textField($model,'sexo',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_nacimiento'); ?>
		<?php echo $form->textField($model,'fecha_nacimiento'); ?>
	</div>

	<!--<div class="row">
		<?php //echo $form->label($model,'nacionalidad'); ?>
		<?php //echo $form->textField($model,'nacionalidad',array('size'=>20,'maxlength'=>20)); ?>
	</div>-->

	<div class="row">
		<?php echo $form->label($model,'id_estado_civil'); ?>
		<?php echo $form->textField($model,'id_estado_civil'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_creacion'); ?>
		<?php echo $form->textField($model,'fecha_creacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_estatus'); ?>
		<?php echo $form->textField($model,'id_estatus'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->