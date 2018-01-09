<?php
/* @var $this TDatosBasicosController */
/* @var $model TDatosBasicos */
/* @var $form CActiveForm */
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tdatos-basicos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this. 
	'enableAjaxValidation'=>false,      
	/*'enableAjaxValidation'=>true,
	'enableClientValidation' => true,
	'clientOptions'=> array('validateOnSubmit'=>true,
                            'afterValidate'=>'js:function() 
                            {     
                               	return false
                            }'
    ),*/
	'htmlOptions'=>array('class'=>'form_validation_ttip'),
)); ?>

	

	<?php //echo $form->errorSummary($model); ?>

<div class="formSep">
	<div class="row-fluid">
		<div class="span5">
			<?php //echo $form->labelEx($model,'id_tipo_identificacion'); ?>
			<?php echo $form->labelEx($model,'nro_identificacion'); ?>
			<?php echo $form->dropDownList($model,'id_tipo_identificacion',CHtml::listData(TTipoIdentificacion::model()->findAll(),'id_tipo_identificacion','abreviatura'),array('class'=>'span12','style'=>'width:27.8%')); ?>				
			<?php //echo $form->error($model,'id_tipo_identificacion'); ?>			
			<?php echo $form->textField($model,'nro_identificacion',array('class'=>'span12','style'=>'width:70%')); ?>
			<?php echo $form->error($model,'nro_identificacion'); ?>
			
		</div>		
	</div>

	<div class="row-fluid">
		<div class="span5">
			<?php echo $form->labelEx($model,'nombres'); ?>
			<?php echo $form->textField($model,'nombres',array('maxlength'=>60,'class'=>'span12')); ?>
			<?php echo $form->error($model,'nombres'); ?>
		</div>

		<div class="span5">
			<?php echo $form->labelEx($model,'apellidos'); ?>
			<?php echo $form->textField($model,'apellidos',array('maxlength'=>60,'class'=>'span12')); ?>
			<?php echo $form->error($model,'apellidos'); ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span5">
			<?php echo $form->labelEx($model,'sexo'); $model->sexo = 'F'; ?>
			<?php

						                echo $form->radioButtonList($model, 'sexo',
						                    array(  'F' => 'Femenino',
						                            'M' => 'Masculino',
						                    ),
						                    array( 	'separator' => " ",
						                    		'labelOptions'=>array('class'=>'radio','style'=>'display:inline;padding-right:20px'),
						                    		'template'=>'{input}{label}',
						                    		'class'=>'radio inline'
						                    )
						                 );
						            ?>

			<?php //echo $form->dropDownList($model,'sexo',array('F'=>'Femenino','M'=>'Masculino'),array('class'=>'span12')); ?>
			<?php //echo $form->textField($model,'sexo',array('size'=>2,'maxlength'=>2)); ?>
			<?php echo $form->error($model,'sexo'); ?>
		</div>
		<div class="span5">
			<?php echo $form->labelEx($model,'id_estado_civil'); ?>
			<?php echo $form->dropDownList($model,'id_estado_civil',CHtml::listData(TEstadoCivil::model()->findAll(),'id_estado_civil','descripcion'),array('class'=>'span12')); ?>	
			<?php //echo $form->textField($model,'id_estado_civil'); ?>
			<?php echo $form->error($model,'id_estado_civil'); ?>
		</div>	
	</div>

	<div class="row-fluid">
		<div class="span5">


			<?php echo $form->labelEx($model,'fecha_nacimiento'); ?>
			<div id="TDatosBasicos_fecha_nacimiento_date" class="input-append date">
				
			<?php 
				
 					$model->fecha_nacimiento=date('d/m/Y');
 					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'model'=>$model,
				 	'attribute'=>'fecha_nacimiento',
				 	'value'=>$model->fecha_nacimiento,
				 	'language' => 'es',
				 	//'flat'=>true,
				 	'htmlOptions' => array('readonly'=>"readonly",'style'=>'width:75%'),				 
				 	'options'=>array(
				 		'autoSize'=>true,
				 		'defaultDate'=>$model->fecha_nacimiento,
				 		'dateFormat'=>'dd/mm/yy',
				 		//'buttonImage'=>'',
				 		//'buttonImageOnly'=>true,
						//'buttonText'=>'fecha_nacimiento',						
						'selectOtherMonths'=>true,
						'showAnim'=>'slide',
						'showButtonPanel'=>true,
						//'showOn'=>'both',
						'showOtherMonths'=>true,
						'changeMonth' => 'true',
						'changeYear' => 'true',
				 	),
				)); 
			?>
				<span class="add-on"><i class="icon-calendar"></i></span>
			</div>
    		

			<?php //echo $form->textField($model,'fecha_nacimiento',array('class'=>'span12')); ?>
			<?php echo $form->error($model,'fecha_nacimiento'); ?>
		</div>


		<!--<div class="span4">
			<?php //echo $form->labelEx($model,'nacionalidad'); ?>
			<?php //echo $form->textField($model,'nacionalidad',array('size'=>20,'maxlength'=>20,'class'=>'span12')); ?>
			<?php //echo $form->error($model,'nacionalidad'); ?>
		</div>-->
	</div>

	
</div>
	
	<div class="form-actions">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array('class'=>'btn btn-inverse')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->