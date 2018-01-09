<?php
/* @var $this TDatosBasicosDireccionController */
/* @var $model TDatosBasicosDireccion */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_datos_basicos_direccion'); ?>
		<?php echo $form->textField($model,'id_datos_basicos_direccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_datos_basicos'); ?>
		<?php echo $form->textField($model,'id_datos_basicos'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'direccion1'); ?>
		<?php echo $form->textField($model,'direccion1',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'direccion2'); ?>
		<?php echo $form->textField($model,'direccion2',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'codigo_zip'); ?>
		<?php echo $form->textField($model,'codigo_zip'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_tipo_direccion'); ?>
		<?php echo $form->textField($model,'id_tipo_direccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_pais'); ?>
		<?php echo $form->textField($model,'id_pais'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ciudad'); ?>
		<?php echo $form->textField($model,'ciudad',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'estado'); ?>
		<?php echo $form->textField($model,'estado',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'telefono_fijo'); ?>
		<?php echo $form->textField($model,'telefono_fijo',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'indicador_factura'); ?>
		<?php echo $form->textField($model,'indicador_factura'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'indicador_envio'); ?>
		<?php echo $form->textField($model,'indicador_envio'); ?>
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