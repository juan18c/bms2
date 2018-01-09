<script type="text/javascript">
	$(document).ready(function(){
			$('#tdatosbasicos-form').show();	
			$('#tdatosbasicos-multiple').show();	
			$('#tdatosbasicos-foto').hide();
			$("#tdatosbasicos-datos").attr("class","span11");	
			$('#tdatosbasicos-datos').show();	
			$('#tdatosbasicosseguro-form').show();
			$('#tusuario-form').show();
			$('#tdatosbasicosUbicacion-form').show();
       	return false;
    });

</script>
<?php
/* @var $this TDatosBasicosController */
/* @var $model TDatosBasicos */
?>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tdatos-basicos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this. 
	//'enableAjaxValidation'=>false,      
	'enableAjaxValidation'=>true,
	'enableClientValidation' => true,
	// 'clientOptions'=> array('validateOnSubmit'=>true,
 //                            'afterValidate'=>'js:function() 
 //                            {     
 //                               	return false
 //                            }'
 //    ),
	'htmlOptions'=>array('class'=>'form_validation_ttip','enctype' => 'multipart/form-data',),
)); ?>
    <div class="alert alert-error">Campos con <strong>*</strong> son obligatorios.</div>

	<div class="row-fluid">
		<?php $this->renderPartial('application.modules.Esculapio.views.tDatosBasicos._formIntegrado', array('model'=>$model, 
								   'modelDBSeguro'=>$modelDBSeguro, 'modelPerfil'=>$modelPerfil,'modelUbicacion'=>$modelUbicacion, 'cadena_seguro'=>$cadena_seguro, 'form'=>$form)); ?>	
	</div>

	<div class="row-fluid">
			<?php $this->renderPartial('application.modules.Esculapio.views.tDatosBasicosUbicacion._formIntegrado', array('model'=>$model, 
									   'modelDBSeguro'=>$modelDBSeguro, 'modelPerfil'=>$modelPerfil,'modelUbicacion'=>$modelUbicacion, 'cadena_seguro'=>$cadena_seguro, 'form'=>$form)); ?>	
			<!-- <h3 class="heading">Datos del Asegurado</h3>	 -->
	</div>	
	<div class="row-fluid">
		 	<?php $this->renderPartial('application.modules.Esculapio.views.tDatosBasicosSeguro._formAdmision', array('model'=>$model, 
									   'modelDBSeguro'=>$modelDBSeguro, 'modelPerfil'=>$modelPerfil,'modelUbicacion'=>$modelUbicacion, 'cadena_seguro'=>$cadena_seguro, 'form'=>$form)); ?>	
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->