<script type="text/javascript">
	$(document).ready(function(){
		if($("#TDatosBasicosPerfil_id_perfil").val()== "2" || ($("#TDatosBasicosPerfil_id_perfil").val()== "6")){
			$('#tdatosbasicos-form').hide();
			$('#tdatosbasicos-multiple').hide();	
			$('#tdatosbasicos-foto').hide();	
			$('#tdatosbasicos-datos').hide();
		 	$('#tdatosbasicosseguro-form').hide();
		 	//$('#tusuario-form').hide();
		 	if($("#TDatosBasicosPerfil_id_perfil").val()== "6" ){
		 		$('#tdatosbasicosUbicacion-form').hide();
		 	}
		}else{
			$('#tdatosbasicos-form').show();	
			$('#tdatosbasicos-multiple').show();	
			$('#tdatosbasicos-foto').show();	
			$('#tdatosbasicos-datos').show();
			$('#tdatosbasicosseguro-form').show();
			//$('#tusuario-form').show();
			$('#tdatosbasicosUbicacion-form').show();
		}
		if($("#TDatosBasicosPerfil_id_perfil").val()== "7"){
			$('#tdatosbasicos-form').hide();
			$('#tdatosbasicos-multiple').show();	
			$('#tdatosbasicos-foto').show();	
			$('#tentidad-form-multiple').show();
			$('#tentidad-form').show();
			$('#tdatosbasicos-datos').hide();
		 	$('#tdatosbasicosseguro-form').hide();
		 	//$('#tusuario-form').show();
		}
       	if($("#TDatosBasicosPerfil_id_perfil").val()== "3" || ($("#TDatosBasicosPerfil_id_perfil").val()== "4") ){
    		$('#div_educacion').show();
			$('#acordionEducacion').css('height','auto');
	       	$('#div_experiencia').show();
			$('#acordionExperiencia').css('height','auto');
			$('#totrosDatos-title').show();
			$('#tproveedor-form').hide();
			$('#tproveedor-title').hide();
			$('#tdatosbasicosseguro-form').show();
			$('#tproveedor-form').hide();
			$('#tmedico-form').hide();
			$('#tmedico-title').hide();
			$('#tseguro-form').hide();
			$('#tseguro-entidad-form').hide();
			if($("#TDatosBasicosPerfil_id_perfil").val()== "3"){
				$('#templeado-form').show();
			 	$('#tpostulante-form').hide();
			} 	
			if($("#TDatosBasicosPerfil_id_perfil").val()== "4"){
			 	$('#tpostulante-form').show();
				$('#templeado-form').hide();
			}
        }else{
        	if($("#TDatosBasicosPerfil_id_perfil").val()== "1" ){
			 	$('#div_mencion').show();
			}else{
				$('#div_mencion').hide();
			}
        	if($("#TDatosBasicosPerfil_id_perfil").val()== "2" ){
			 	$('#tproveedor-form').show();
			 	$('#tdatosbasicosUbicacion-form').show();
			}else{
				$('#tproveedor-form').hide();
			}
			if($("#TDatosBasicosPerfil_id_perfil").val()== "5" ){
			 	$('#tmedico-form').show();
			 	$('#tmedico-title').show();
			}else{
				$('#tmedico-form').hide();
				$('#tmedico-title').hide();
			}
			if($("#TDatosBasicosPerfil_id_perfil").val()== "6" ){
			 	$('#tseguro-entidad-form').show();
			}else{
				$('#tseguro-entidad-form').hide();
			}
			if($("#TDatosBasicosPerfil_id_perfil").val()== "7" ){
			 	$('#tentidad-form').show();
			 	$('#tentidad-form-multiple').show();
			 	$('#tipo_entidad').show();
			}else{
				$('#tentidad-form').hide();
				$('#tentidad-form-multiple').hide();
				$('#tipo_entidad').hide();
			}

        	$('#div_educacion').hide();
        	$('#div_experiencia').hide();
        	$('#templeado-form').hide();
        	$('#tpostulante-form').hide();
        	$('#totrosDatos-title').hide();
        }
        return false;
    });


</script>
<?php
/* @var $this TDatosBasicosController */
/* @var $model TDatosBasicos */

// $this->breadcrumbs=array(
// 	'Datos Básicos'=>array('index'),
// 	$model->id_datos_basicos=>array('view','id'=>$model->id_datos_basicos),
// 	'Modificar',
// );


// $this->menu=array(
// 	//array('label'=>'List TDatosBasicos', 'url'=>array('index')),
// 	//array('label'=>'Crear Usuario', 'url'=>array('createIntegrado')),
// 	array('label'=>'Consultar Usuario', 'url'=>array('view', 'id'=>$model->id_datos_basicos)),
// 	array('label'=>'Administrar Usuario', 'url'=>array('admin')),
// );

$this->menu=TUsuario::model()->CargarMenuLateral();

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
    'htmlOptions'=>array('class'=>'form_validation_ttip','enctype' => 'multipart/form-data',
    ),
)); ?>


	<div class="row-fluid">

		<div class="span6">

			<?php echo $form->hiddenField($modelPerfil,'id_perfil',array('value'=>$modelPerfil->id_perfil));  ?>
			<!-- <h3 class="heading">Datos de Perfil</h3>		 -->
			<?php $this->renderPartial('application.modules.Esculapio.views.tDatosBasicosPerfil._form', array('model'=>$model, 
									   'modelSeguro'=>$modelSeguro,'modelDBSeguro'=>$modelDBSeguro, 'modelMedico'=>$modelMedico, 'modelMedicoEspecialidad'=>$modelMedicoEspecialidad,
			                           'modelPerfil'=>$modelPerfil,'modelUbicacion'=>$modelUbicacion,'model_1'=>$modelEducacion, 'model_2'=>$modelEducacion_2, 
			                           'model_3'=>$modelEducacion_3,'model_1Exp'=>$modelExperienciaLaboral, 'model_2Exp'=>$modelExperienciaLaboral_2, 'modelEntidad'=>$modelEntidad, 
			                           'model_3Exp'=>$modelExperienciaLaboral_3,'model_Empl'=>$modelEmpleado,'model_Post'=>$modelPostulante,'model_Prov'=>$modelProveedor, 
			                           'cadena_seguro'=>$cadena_seguro, 'arreglo_seguro_cargado'=>$arreglo_seguro_cargado, 
			                           'arreglo_especialidad'=>$arreglo_especialidad, 'form'=>$form)); ?>	
			
			<?php // $this->renderPartial('application.modules.seguridad.views.TUsuario._formIntegrado', array('model'=>$model, 
									   // 'modelSeguro'=>$modelSeguro,'modelDBSeguro'=>$modelDBSeguro, 'modelMedico'=>$modelMedico, 'modelMedicoEspecialidad'=>$modelMedicoEspecialidad, 
			         //                   'modelPerfil'=>$modelPerfil,'modelUbicacion'=>$modelUbicacion,'model_1'=>$modelEducacion, 'model_2'=>$modelEducacion_2, 
			         //                   'model_3'=>$modelEducacion_3,'model_1Exp'=>$modelExperienciaLaboral, 'model_2Exp'=>$modelExperienciaLaboral_2, 'modelEntidad'=>$modelEntidad, 
			         //                   'model_3Exp'=>$modelExperienciaLaboral_3,'model_Empl'=>$modelEmpleado, 'model_Post'=>$modelPostulante,'model_Prov'=>$modelProveedor, 
			         //                   'cadena_seguro'=>$cadena_seguro, 'arreglo_seguro_cargado'=>$arreglo_seguro_cargado, 
			         //                   'arreglo_especialidad'=>$arreglo_especialidad,'form'=>$form)); ?>	
			
			<?php $this->renderPartial('_formIntegrado', array('model'=>$model,  'modelSeguro'=>$modelSeguro,'modelDBSeguro'=>$modelDBSeguro, 'modelMedico'=>$modelMedico,
			                           'modelPerfil'=>$modelPerfil,'modelUbicacion'=>$modelUbicacion,'model_1'=>$modelEducacion, 'model_2'=>$modelEducacion_2, 
			                           'model_3'=>$modelEducacion_3,'model_1Exp'=>$modelExperienciaLaboral, 'model_2Exp'=>$modelExperienciaLaboral_2, 'modelEntidad'=>$modelEntidad, 
			                           'model_3Exp'=>$modelExperienciaLaboral_3,'model_Empl'=>$modelEmpleado,'model_Post'=>$modelPostulante,'model_Prov'=>$modelProveedor, 
			                           'cadena_seguro'=>$cadena_seguro, 'arreglo_seguro_cargado'=>$arreglo_seguro_cargado, 
			                           'arreglo_especialidad'=>$arreglo_especialidad,'form'=>$form)); ?>	
			
			<?php //$this->renderPartial('application.modules.Administrativo.views.tSeguroEntidad._form', array('model'=>$model, 
		 							   // 'modelSeguro'=>$modelSeguro,'modelDBSeguro'=>$modelDBSeguro, 'modelMedico'=>$modelMedico, 'modelMedicoEspecialidad'=>$modelMedicoEspecialidad,
			          //                  'modelPerfil'=>$modelPerfil,'modelUbicacion'=>$modelUbicacion,'model_1'=>$modelEducacion, 'model_2'=>$modelEducacion_2, 
			          //                  'model_3'=>$modelEducacion_3,'model_1Exp'=>$modelExperienciaLaboral, 'model_2Exp'=>$modelExperienciaLaboral_2, 'modelEntidad'=>$modelEntidad, 
			          //                  'model_3Exp'=>$modelExperienciaLaboral_3,'model_Empl'=>$modelEmpleado,'model_Post'=>$modelPostulante,'model_Prov'=>$modelProveedor, 
					  //				  'cadena_seguro'=>$cadena_seguro, 'arreglo_seguro_cargado'=>$arreglo_seguro_cargado, 
			 		  //				  'arreglo_especialidad'=>$arreglo_especialidad, 'form'=>$form)); ?>	
			
			<?php $this->renderPartial('application.modules.Administrativo.views.tProveedor._form', array('model'=>$model, 
		 							   'modelSeguro'=>$modelSeguro,'modelDBSeguro'=>$modelDBSeguro, 'modelMedico'=>$modelMedico, 'modelMedicoEspecialidad'=>$modelMedicoEspecialidad,
			                           'modelPerfil'=>$modelPerfil,'modelUbicacion'=>$modelUbicacion,'model_1'=>$modelEducacion, 'model_2'=>$modelEducacion_2, 
			                           'model_3'=>$modelEducacion_3,'model_1Exp'=>$modelExperienciaLaboral, 'model_2Exp'=>$modelExperienciaLaboral_2, 'modelEntidad'=>$modelEntidad, 
			                           'model_3Exp'=>$modelExperienciaLaboral_3,'model_Empl'=>$modelEmpleado,'model_Post'=>$modelPostulante,'model_Prov'=>$modelProveedor, 
			                           'cadena_seguro'=>$cadena_seguro, 'arreglo_seguro_cargado'=>$arreglo_seguro_cargado, 
			                           'arreglo_especialidad'=>$arreglo_especialidad,'form'=>$form)); ?>	

			<?php $this->renderPartial('application.modules.Esculapio.views.tEntidad._form', array('model'=>$model, 
		 							   'modelSeguro'=>$modelSeguro,'modelDBSeguro'=>$modelDBSeguro, 'modelMedico'=>$modelMedico, 'modelMedicoEspecialidad'=>$modelMedicoEspecialidad,
			                           'modelPerfil'=>$modelPerfil,'modelUbicacion'=>$modelUbicacion,'model_1'=>$modelEducacion, 'model_2'=>$modelEducacion_2, 
			                           'model_3'=>$modelEducacion_3,'model_1Exp'=>$modelExperienciaLaboral, 'model_2Exp'=>$modelExperienciaLaboral_2, 'modelEntidad'=>$modelEntidad, 
			                           'model_3Exp'=>$modelExperienciaLaboral_3,'model_Empl'=>$modelEmpleado,'model_Post'=>$modelPostulante,'model_Prov'=>$modelProveedor, 
			                           'cadena_seguro'=>$cadena_seguro, 'arreglo_seguro_cargado'=>$arreglo_seguro_cargado, 
			                           'arreglo_especialidad'=>$arreglo_especialidad,'form'=>$form)); ?>	



		</div>

		<div class="span6">
			<?php $this->renderPartial('application.modules.Esculapio.views.tDatosBasicosUbicacion._formIntegrado', array('model'=>$model, 
									   'modelSeguro'=>$modelSeguro,'modelDBSeguro'=>$modelDBSeguro, 'modelMedico'=>$modelMedico,  'modelMedicoEspecialidad'=>$modelMedicoEspecialidad,
			                           'modelPerfil'=>$modelPerfil,'modelUbicacion'=>$modelUbicacion,'model_1'=>$modelEducacion, 'model_2'=>$modelEducacion_2, 
			                           'model_3'=>$modelEducacion_3,'model_1Exp'=>$modelExperienciaLaboral, 'model_2Exp'=>$modelExperienciaLaboral_2, 'modelEntidad'=>$modelEntidad, 
			                           'model_3Exp'=>$modelExperienciaLaboral_3,'model_Empl'=>$modelEmpleado,'model_Post'=>$modelPostulante,'model_Prov'=>$modelProveedor, 
			                           'cadena_seguro'=>$cadena_seguro, 'arreglo_seguro_cargado'=>$arreglo_seguro_cargado, 
			                           'arreglo_especialidad'=>$arreglo_especialidad,'form'=>$form)); ?>	
			<!-- <h3 class="heading">Datos del Asegurado</h3>	 -->
			
		  	<div  id="div_medico">  
				<h3 class="heading"  id='tmedico-title' style='display:none'>Otros Datos del Medico</h3>	
			 	<?php $this->renderPartial('application.modules.Esculapio.views.tMedico._form', array('model'=>$model, 
			 							   'modelSeguro'=>$modelSeguro,'modelDBSeguro'=>$modelDBSeguro, 'modelMedico'=>$modelMedico,  'modelMedicoEspecialidad'=>$modelMedicoEspecialidad,
				                           'modelPerfil'=>$modelPerfil,'modelUbicacion'=>$modelUbicacion,'model_1'=>$modelEducacion, 'model_2'=>$modelEducacion_2, 
				                           'model_3'=>$modelEducacion_3,'model_1Exp'=>$modelExperienciaLaboral, 'model_2Exp'=>$modelExperienciaLaboral_2, 'modelEntidad'=>$modelEntidad, 
				                           'model_3Exp'=>$modelExperienciaLaboral_3,'model_Empl'=>$modelEmpleado,'model_Post'=>$modelPostulante,'model_Prov'=>$modelProveedor, 
				                           'cadena_seguro'=>$cadena_seguro, 'arreglo_seguro_cargado'=>$arreglo_seguro_cargado, 
				                           'arreglo_especialidad'=>$arreglo_especialidad,'form'=>$form)); ?>	

			</div>
	    
		</div>
	</div>
	<div class="row-fluid">
		<?php $this->renderPartial('application.modules.Esculapio.views.tDatosBasicosSeguro._form', array('model'=>$model,  
		 						   'modelSeguro'=>$modelSeguro,'modelDBSeguro'=>$modelDBSeguro, 'modelMedico'=>$modelMedico,  'modelMedicoEspecialidad'=>$modelMedicoEspecialidad,	
		                           'modelPerfil'=>$modelPerfil,'modelUbicacion'=>$modelUbicacion,'model_1'=>$modelEducacion, 'model_2'=>$modelEducacion_2, 
		                           'model_3'=>$modelEducacion_3,'model_1Exp'=>$modelExperienciaLaboral, 'model_2Exp'=>$modelExperienciaLaboral_2, 'modelEntidad'=>$modelEntidad, 
		                           'model_3Exp'=>$modelExperienciaLaboral_3,'model_Empl'=>$modelEmpleado,'model_Post'=>$modelPostulante,'model_Prov'=>$modelProveedor, 
		                           'cadena_seguro'=>$cadena_seguro, 'arreglo_seguro_cargado'=>$arreglo_seguro_cargado, 
		                           'arreglo_especialidad'=>$arreglo_especialidad, 'form'=>$form)); ?>		
	</div>
	<h3 class="heading"  id='totrosDatos-title' style='display:none' class="span6">Otros Datos</h3>	
	<div class="row-fluid">
		 	<?php $this->renderPartial('application.modules.Administrativo.views.tEmpleado._form', array('model'=>$model, 
		 							'modelSeguro'=>$modelSeguro,'modelDBSeguro'=>$modelDBSeguro, 'modelMedico'=>$modelMedico,  'modelMedicoEspecialidad'=>$modelMedicoEspecialidad,
		                            'modelPerfil'=>$modelPerfil,'modelUbicacion'=>$modelUbicacion,'model_1'=>$modelEducacion, 'model_2'=>$modelEducacion_2, 
		                            'model_3'=>$modelEducacion_3,'model_1Exp'=>$modelExperienciaLaboral, 'model_2Exp'=>$modelExperienciaLaboral_2, 'modelEntidad'=>$modelEntidad, 
		                            'model_3Exp'=>$modelExperienciaLaboral_3,'model_Empl'=>$modelEmpleado,'model_Post'=>$modelPostulante,'model_Prov'=>$modelProveedor, 
		                            'cadena_seguro'=>$cadena_seguro, 'arreglo_seguro_cargado'=>$arreglo_seguro_cargado, 
		                            'arreglo_especialidad'=>$arreglo_especialidad,'form'=>$form)); ?>	
 
		 	<?php $this->renderPartial('application.modules.Administrativo.views.tPostulante._form', array('model'=>$model, 
		 						   'modelSeguro'=>$modelSeguro,'modelDBSeguro'=>$modelDBSeguro, 'modelMedico'=>$modelMedico,  'modelMedicoEspecialidad'=>$modelMedicoEspecialidad,
		                           'modelPerfil'=>$modelPerfil,'modelUbicacion'=>$modelUbicacion,'model_1'=>$modelEducacion, 'model_2'=>$modelEducacion_2, 
		                           'model_3'=>$modelEducacion_3,'model_1Exp'=>$modelExperienciaLaboral, 'model_2Exp'=>$modelExperienciaLaboral_2, 'modelEntidad'=>$modelEntidad, 
		                           'model_3Exp'=>$modelExperienciaLaboral_3,'model_Empl'=>$modelEmpleado,'model_Post'=>$modelPostulante,'model_Prov'=>$modelProveedor, 
		                           'cadena_seguro'=>$cadena_seguro, 'arreglo_seguro_cargado'=>$arreglo_seguro_cargado, 
		                           'arreglo_especialidad'=>$arreglo_especialidad, 'form'=>$form)); ?>	
	</div>
	<div class="row-fluid">
		<div  id="div_educacion" class="span6"  style='display:none'>  
		 	<?php $this->renderPartial('application.modules.Administrativo.views.tEducacion._form', array('model'=>$model, 
		 							   'modelSeguro'=>$modelSeguro,'modelDBSeguro'=>$modelDBSeguro, 'modelMedico'=>$modelMedico,  'modelMedicoEspecialidad'=>$modelMedicoEspecialidad,
			                           'modelPerfil'=>$modelPerfil,'modelUbicacion'=>$modelUbicacion,'model_1'=>$modelEducacion, 'model_2'=>$modelEducacion_2, 
			                           'model_3'=>$modelEducacion_3,'model_1Exp'=>$modelExperienciaLaboral, 'model_2Exp'=>$modelExperienciaLaboral_2, 'modelEntidad'=>$modelEntidad, 
			                           'model_3Exp'=>$modelExperienciaLaboral_3,'model_Empl'=>$modelEmpleado,'model_Post'=>$modelPostulante,'model_Prov'=>$modelProveedor, 
			                           'cadena_seguro'=>$cadena_seguro, 'arreglo_seguro_cargado'=>$arreglo_seguro_cargado, 
			                           'arreglo_especialidad'=>$arreglo_especialidad,'form'=>$form)); ?>	
		</div>
		<div  id="div_experiencia" class="span6" style="display:none;">  
		 	<?php $this->renderPartial('application.modules.Administrativo.views.tExperienciaLaboral._form', array('model'=>$model, 
		 		  					   'modelSeguro'=>$modelSeguro,'modelDBSeguro'=>$modelDBSeguro, 'modelMedico'=>$modelMedico,  'modelMedicoEspecialidad'=>$modelMedicoEspecialidad,
			                           'modelPerfil'=>$modelPerfil,'modelUbicacion'=>$modelUbicacion,'model_1'=>$modelEducacion, 'model_2'=>$modelEducacion_2, 
			                           'model_3'=>$modelEducacion_3,'model_1Exp'=>$modelExperienciaLaboral, 'model_2Exp'=>$modelExperienciaLaboral_2, 'modelEntidad'=>$modelEntidad, 
			                           'model_3Exp'=>$modelExperienciaLaboral_3,'model_Empl'=>$modelEmpleado,'model_Post'=>$modelPostulante,'model_Prov'=>$modelProveedor, 
			                           'cadena_seguro'=>$cadena_seguro, 'arreglo_seguro_cargado'=>$arreglo_seguro_cargado, 
			                           'arreglo_especialidad'=>$arreglo_especialidad,'form'=>$form)); ?>	
		</div>
	</div>




    <div class="form-actions" >
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array('class'=>'btn btn-inverse', 'name'=>'boton')); ?>
    </div>

<?php $this->endWidget(); ?>
</div><!-- form -->