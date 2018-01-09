<?php
	Yii::app()->getClientScript()->scriptMap=array('jquery.js'=>false,'jquery.min.js'=>false, 'jquery-ui.min.js'=>false,'i18nScriptFile'=>false); 
?>

<div class="form">

<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'tdonacion-adjudicado-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
	'enableClientValidation' => true,
        'clientOptions'=> array('validateOnSubmit'=>true,
                            'afterValidate'=>'js:function() 
                            {
                                return false
                            }'
    ),
	'htmlOptions'=>array('role'=>'form','enctype' => 'multipart/form-data')
)); ?>

	<?php echo $form->errorSummary($model); ?>
	<div id="divDonacionMensaje"></div>

	<input type="hidden" id="TDonacionAdjudicado_id_donacion" name="TDonacionAdjudicado[id_donacion]" value="<?php if (is_object($modelCaso)){echo $modelCaso->id_donacion; }else{ echo $modelCaso; }?>" />
	<input type="hidden" id="TDonacionAdjudicado_id_donador" name="TDonacionAdjudicado[id_donador]" value="<?php  echo Yii::app()->user->id_persona; ?>" />
	<!-- <input type="hidden" id="idInventario" name="idInventario" value="" /> -->

	<div class="form-group">

		<div class="" >
			<?php echo $form->labelEx($model,'monto',array('class'=>'control-label')); ?>
			<?php echo $form->textField($model,'monto',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'monto'); ?>
		</div>

		<div class="" >
			<?php echo $form->labelEx($model,'id_medio_pago',array('class'=>'control-label')); ?>
			<?php 
			if ((Yii::app()->user->getState('id_rol') == 'admin')){ 
				echo $form->dropDownList($model,'id_medio_pago',CHtml::listData(TMedioPago::model()->findAll('id_medio_pago in (6,7,8)'),'id_medio_pago','descripcion'),array('class'=>'form-control','prompt'=>'Seleccione',
                'onChange'=>'if (this.value == 1)
                    {
                        $("#email_paypal").show();
                        $("#nombre_banco").hide(); 
                        $("#nro_cuenta").hide(); 
                        $("#ruta").hide(); 
                    }
                    else if (this.value == 4)
                    {
					   $("#nombre_banco").show(); 
                       $("#nro_cuenta").show(); 
                       $("#ruta").show();
                       $("#email_paypal").hide();
                    }else{
                       $("#nombre_banco").hide(); 
                       $("#nro_cuenta").hide(); 
                       $("#ruta").hide();
                       $("#email_paypal").hide();
                    }
                    ')); 
			}else{
				echo $form->dropDownList($model,'id_medio_pago',CHtml::listData(TMedioPago::model()->findAll('id_medio_pago in (1,6,4)'),'id_medio_pago','descripcion'),array('class'=>'form-control','prompt'=>'Seleccione',
                'onChange'=>'if (this.value == 1)
                    {
                        $("#email_paypal").show();
                        $("#nombre_banco").hide(); 
                        $("#nro_cuenta").hide(); 
                        $("#ruta").hide(); 
                    }
                    else if (this.value == 4)
                    {
                       $("#nombre_banco").show(); 
                       $("#nro_cuenta").show(); 
                       $("#ruta").show();
                       $("#email_paypal").hide(); 
                    }else{
                       $("#nombre_banco").hide(); 
                       $("#nro_cuenta").hide(); 
                       $("#ruta").hide();
                       $("#email_paypal").hide();
                    }
                    ')); 
		    }
			?>
			<?php echo $form->error($model,'id_medio_pago'); ?>
		</div>
		<div class="" id="email_paypal" style="display:none">
			<?php echo $form->labelEx($model,'email',array('class'=>'control-label')); ?>
			<?php echo $form->textField($model,'email',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'email'); ?>
		</div>
		<div class="" id="nombre_banco" style="display:none">
			<?php echo $form->labelEx($model,'nombre_banco',array('class'=>'control-label')); ?>
			<?php echo $form->textField($model,'nombre_banco',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'nombre_banco'); ?>
		</div>
		<div class="" id="nro_cuenta" style="display:none">
			<?php echo $form->labelEx($model,'numero_cuenta',array('class'=>'control-label')); ?>
			<?php echo $form->textField($model,'numero_cuenta',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'numero_cuenta'); ?>
		</div>
		<div class="" id="ruta" style="display:none">
			<?php echo $form->labelEx($model,'numero_ruta_bancaria',array('class'=>'control-label')); ?>
			<?php echo $form->textField($model,'numero_ruta_bancaria',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'numero_ruta_bancaria'); ?>
		</div>
	</div>
	<div class="form-group">
		<div class="" >
    		<?php echo $form->checkBox($model,'publico',array('class'=>'form-control','checked'=>'checked','data-toggle'=>"toggle",'data-on'=>"Público",'data-off'=>"Privado", 'data-onstyle'=>"custom",'data-offstyle'=>"custom1",'type'=>"checkbox",'data-width'=>"150",'data-height'=>"58",'data-size'=>"normal")); ?>
			
			<?php echo $form->error($model,'publico'); ?>
		</div>
		<div class="" >
			<?php echo $form->labelEx($model,'comentario'); ?>
			<?php echo $form->textArea($model,'comentario',array('class'=>'form-control','type'=>'textarea','row'=>5)); ?>
			<?php echo $form->error($model,'comentario'); ?>
		</div>
	
	</div>




<?php $this->endWidget(); ?>

</div><!-- form -->