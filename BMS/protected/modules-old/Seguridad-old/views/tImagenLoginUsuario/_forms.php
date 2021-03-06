<?php
/* @var $this TImagenLoginUsuarioController */
/* @var $model TImagenLoginUsuario */
/* @var $form CActiveForm */

?>
<style type="text/css">
	img {
	    box-shadow: 0 0 1px rgba(0, 0, 0, 0);
	    display: inline-block;
	    transform: translateZ(0px);
	    transition-duration: 0.3s;
	    transition-property: box-shadow;
	}

	img:hover {
	    box-shadow: 0 0 8px rgba(0, 0, 0, 0.6);
	}
	
</style>

<div class="formSep">


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'timagen-login-usuario-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
		'clientOptions'=> array('validateOnSubmit'=>true,
							//'validateOnChange'=>true,
                     
                           /* 'afterValidate'=>'js:function() 
                            {     
                               	return false
                            }'*/
    ),
)); 

$id_clinica=Yii::app()->user->getState('id_clinica');
if (Yii::app()->user->getState('id_clinica')==""){
	Yii::app()->clientScript->registerScript('testscript',"
    					$('#menuSistema').hide();
				",CClientScript::POS_READY);
}

if ((Yii::app()->user->getState('intentos_fallidos')==3)&&(Yii::app()->user->getState('id_clinica')=="")){

	Yii::app()->clientScript->registerScript('test',"
    			alert('Ha superado el numero de intentos fallidos, contacte al administrador del sistema.');
				",CClientScript::POS_END);

}




?>
	
	<div class="alert alert-error">Campos con <strong>*</strong> son obligatorios.</div>
	
	<div class="row-fluid">
		<?php 
			 // COLOCAR EL ID DEL USUARIO LOGUEADO
			//echo "<h3>Bienvenido, <Usuario></h3>";		
			echo $form->hiddenField($model,'id_usuario',array('value'=>$model->id_usuario));
			echo $form->hiddenField($model,'reValid',array('value'=>$model->reValid));
		 ?>		
	</div>

	<div class="row-fluid">
		<?php if ($model->reValid == 0) echo $form->labelEx($model,'id_entidad'); ?>
		
		<div class="control-group">	
			<?php //echo $form->textField($model,'id_clinica'); ?>
			<!-- // ARMAR LA LISTA DE LAS CLINICAS DEL Medico -->
			
			<?php
				echo $form->hiddenField($model,'existeImagenClinica',array('value'=>$model->existeImagenClinica));
				$empleado=Yii::app()->user->getState('id_empleado');
				if (isset($empleado)){
					$criteria = new CDbCriteria;
					$criteria->with = array(
						'empleadoEntidad'=>array("select"=>" empleadoEntidad.id_entidad"),
						'empleadoEntidad.entidad_datos_basicos'=>array("select"=>"initcap(\"entidad_datos_basicos\".\"nombres\") ||' '|| initcap(\"entidad_datos_basicos\".\"apellidos\") as nombres "),
						//'entidad_tipo_entidad'=>array("select"=>"initcap(entidad_tipo_entidad.nombre) as nombre ")
					);
					$criteria->condition = 't.id_datos_basicos= '.Yii::app()->user->getState('id_empleado');
					$pru=TDatosBasicos::model()->findAll($criteria);
					
					//print_r($pru);
					$entidad = array();
					foreach ($pru as $i => $value){
						$f=0;
						//print_r($value->empleadoEntidad);					
						foreach ($value->empleadoEntidad as $f => $val){
							//echo $val->id_entidad;
							//echo $val->entidad_datos_basicos->nombres;
							$entidad[$val->id_entidad]=$val->entidad_datos_basicos->nombres;
							//print_r($entidad);
						}
					}
				}else{
					$criteria = new CDbCriteria;
					$criteria->with = array(
						'medicoEntidad'=>array("select"=>" medicoEntidad.id_entidad"),
						'medicoEntidad.entidad_datos_basicos'=>array("select"=>"initcap(\"entidad_datos_basicos\".\"nombres\") ||' '|| initcap(\"entidad_datos_basicos\".\"apellidos\") as nombres "),
						//'entidad_tipo_entidad'=>array("select"=>"initcap(entidad_tipo_entidad.nombre) as nombre ")
					);
					$criteria->condition = 't.id_medico= '.Yii::app()->user->getState('id_medico');
					$pru=TMedico::model()->findAll($criteria);
					
					
					$entidad = array();
					foreach ($pru as $i => $value){
						$f=0;
						foreach ($value->medicoEntidad as $f => $val){
							$entidad[$val->id_entidad]=$val->entidad_datos_basicos->nombres;
						}
					}
				}

				/*$criteria = new CDbCriteria;

				$criteria->with = array(
								'medicoEntidad'=>array("select"=>" medicoEntidad.id_entidad"),
								'medicoEntidad.entidad_datos_basicos'=>array("select"=>"initcap(\"entidad_datos_basicos\".\"nombres\") ||' '|| initcap(\"entidad_datos_basicos\".\"apellidos\") as nombres ")								
								); 
				$criteria->condition = 't.id_medico= '.Yii::app()->user->getState('id_medico');
				$pru=TMedico::model()->findAll($criteria);

				$entidad = array();
				foreach ($pru as $i => $value){
					$f=0;
					foreach ($value->medicoEntidad as $f => $val){
						$entidad[$val->id_entidad]=$val->entidad_datos_basicos->nombres;
					}
				}*/
			
				$onchang= array('prompt'=>'Seleccione >>',
								'onchange'=>'js:$("#TImagenLoginUsuario_id_entidad").val(this.value); 
												if (this.value!=""){
												$.ajax({
												url:"index.php?r=Seguridad/tImagenLoginUsuario/BuscarImagenClinica&id_entidad="+ $("#TImagenLoginUsuario_id_entidad").val(),
                    							type: "POST",
												//update:"$(\"#TImagenLoginUsuario_id_entidad\")",
												success: function(data){
															if (data.trim() != 0){
																$("#imagenes").show(); 
																$("#TImagenLoginUsuario_existeImagenClinica").val(1);
																
															}else{
																$("#TImagenLoginUsuario_existeImagenClinica").val(0);
																$("#imagenes").show();
															}  
                            							} 

               
                    							 })
												} 
											',				
				);			

				
				if ($model->reValid == 0){ 				
					echo $form->dropDownList($model,'id_entidad',
	                    $entidad,$onchang
	                );
					
                }else{
                	$criteria2 = new CDbCriteria;
                	$criteria2->condition = 't.id_entidad = '.$model->id_entidad;
                	echo "
                		<ul>
							<li>
								<span class='item-key'>Usted selecciono la cl�nica: </span>
								<div class='vcard-item'>".ucfirst(strtolower(TEntidad::model()->findAll($criteria2)[0]->entidad_datos_basicos->nombres))." ".ucfirst(strtolower(TEntidad::model()->findAll($criteria2)[0]->entidad_datos_basicos->apellidos))."</div>
							</li>
							<li>
								<span class='item-key'>Debe volver a seleccionar la misma imagen para establecerla como imagen de seguridad.</span>
							</li>
						</ul>";

                	echo $form->hiddenField($model,'id_entidad',array('value'=>$model->id_entidad));
                	echo $form->hiddenField($model,'imagenSelec',array('value'=>$model->id_imagen));
                	
                }

            ?>   
			<?php echo $form->error($model,'id_entidad',array('class'=>'help-block')); ?>
		</div>
	</div>

    <?php
    if ($model->reValid == 0 && $model->id_entidad == ''){ ?>
    	<div class="row-fluid" id="imagenes" style="display:none">
    <?php } else { ?>
		<div class="row-fluid" id="imagenes" style="display:block" >
	<?php }?>
	    
		<?php echo $form->error($model,'id_imagen',array('class'=>'help-block')); ?>
		<?php echo $form->labelEx($model,'id_imagen'); ?>
		<div class="container"> 
			<div class="control-group">	
				<?php
					$criteria = new CDbCriteria;
					$criteria->select = array('id_imagen, nombre');
				
					$imagenes = TImagenLogin::model()->findAll($criteria);							
					$totalImagenes = count($imagenes);   
					
					foreach ($imagenes as $key => $value) {
						$encabezado = "";
						$linea = "";
						$final = "";
						if ($key == 0) $encabezado = '<div class="row-fluid">';
						if ($key==3) $linea = '</div><div style="clear"></div><div class="row-fluid">';
						if ($key+1 == $totalImagenes) $final = '</div>';							

						$valorRadio = $value['id_imagen'] -1;

						$imagenesArray[$value['id_imagen']] = $encabezado.'<div class="span3">'.
						CHtml::image(Yii::app()->request->baseUrl.'/images/sesion_images/'.$value['nombre'],$value['nombre'],
							array(	'width'=>'150','style'=>'cursor:pointer;padding:20px; hover:',
									'onclick'=>'js: 
										$("input:radio[name=\'TImagenLoginUsuario[id_imagen]\']").attr("checked", false);								 								 	 								
										$("#TImagenLoginUsuario_id_imagen_'.$valorRadio.'").attr("checked",true);
										$("input[name=\'TImagenLoginUsuario[id_imagen]\']:hidden").val('.$value['id_imagen'].');
										$("#timagen-login-usuario-form").submit();
						')).'</div>'.$linea.$final;								
					}						
										
				 ?>

				<?php echo $form->radioButtonList($model,'id_imagen',$imagenesArray,
						array('separator'=>'',
							//'uncheckValue'=>NULL,//$(\'#timagen-login-usuario-form\').submit();
							//'template'=>'<div class="span3">{labelTitle}{input}</div>', 
							'style'=>'visibility:hidden;',							
							'labelOptions'=>array('style'=>'display:inline'), // add this code							
						)
					);
				?>
				<br>												
				
			</div>			
		</div>
	</div>
	
<?php //echo Yii::app()->user->getState('id_rol');?>
<!-- 	<div class="form-actions">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-inverse')); ?>
	</div> -->

<?php $this->endWidget(); 
	if ((Yii::app()->user->getState('intentos_fallidos')==3)&&(Yii::app()->user->getState('id_clinica')=="")){
		Yii::app()->user->logout();				
		//$this->redirect(Yii::app()->homeUrl);
	}
?>

</div><!-- form -->