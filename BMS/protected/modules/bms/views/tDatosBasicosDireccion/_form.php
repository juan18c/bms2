<?php
/* @var $this TDatosBasicosDireccionController */
/* @var $model TDatosBasicosDireccion */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tdatos-basicos-direccion-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_datos_basicos'); ?>
		<?php echo $form->textField($model,'id_datos_basicos'); ?>
		<?php echo $form->error($model,'id_datos_basicos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'direccion1'); ?>
		<?php echo $form->textField($model,'direccion1',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'direccion1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'direccion2'); ?>
		<?php echo $form->textField($model,'direccion2',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'direccion2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'codigo_zip'); ?>
		<?php echo $form->textField($model,'codigo_zip'); ?>
		<?php echo $form->error($model,'codigo_zip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_tipo_direccion'); ?>
		<?php echo $form->textField($model,'id_tipo_direccion'); ?>
		<?php echo $form->error($model,'id_tipo_direccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_pais'); ?>
		<?php echo $form->textField($model,'id_pais'); ?>
		<?php echo $form->error($model,'id_pais'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ciudad'); ?>
		<?php echo $form->textField($model,'ciudad',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'ciudad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'estado'); ?>
		<?php echo $form->textField($model,'estado',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telefono_fijo'); ?>
		<?php echo $form->textField($model,'telefono_fijo',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'telefono_fijo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'indicador_factura'); ?>
		<?php echo $form->textField($model,'indicador_factura'); ?>
		<?php echo $form->error($model,'indicador_factura'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'indicador_envio'); ?>
		<?php echo $form->textField($model,'indicador_envio'); ?>
		<?php echo $form->error($model,'indicador_envio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_creacion'); ?>
		<?php echo $form->textField($model,'fecha_creacion'); ?>
		<?php echo $form->error($model,'fecha_creacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_estatus'); ?>
		<?php echo $form->textField($model,'id_estatus'); ?>
		<?php echo $form->error($model,'id_estatus'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->