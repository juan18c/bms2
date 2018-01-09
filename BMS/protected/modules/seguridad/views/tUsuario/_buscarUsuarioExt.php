<?php
/* @var $this THistoriaMedicaController */
/* @var $model THistoriaMedica */
/* @var $form CActiveForm */
?>

<!-- <div class="form">
 -->
 <?php //$form=$this->beginWidget('CActiveForm', array(
// 	'id'=>'buscar-paciente-form',
// 	// Please note: When you enable ajax validation, make sure the corresponding
// 	// controller action is handling ajax validation correctly.
// 	// There is a call to performAjaxValidation() commented in generated controller code.
// 	// See class documentation of CActiveForm for details on this.
// 	'enableAjaxValidation'=>false,
// )); ?>

	

			<div class="input-prepend">
				<span class="add-on ad-on-icon">
					<i class="icon-user"></i>
				</span>	

			<?php //echo $form->labelEx($model,'id_datos_basicos'); ?>
			<?php echo $form->hiddenField($model,'id_datos_basicos',array('value'=>'')); ?>
			

			<?php 					
					$this->widget('bootstrap.widgets.TbTypeahead', array(					
					    'name'=>'nombre_paciente',
					    'options' => array(				     		                    
				            'source'=> 'js:function(query, process) {
				            	states = [];
								map = {};

								$("#TDatosBasicos_id_datos_basicos").val("");

							    var data = '.TUsuario::model()->getUsuario().';
							    
							    if (data == " "){					    		
							    	$("#mostrarNuevaClasif").show();				    								    	
							    								    	
							    }else{							 		
								    $.each(data, function (i, state) {
								        map[state.label] = state;
								        states.push(state.label);								        
								    });								 
								    process(states);
							    }

							}', 

		                    'items'=>4,
		                    'matcher'=>'js:function(item) {	

		                    	if (item.toLowerCase().indexOf(this.query.trim().toLowerCase()) != -1) {	                    		
		                    		$("#mostrarNuevaClasif").hide();
					    		   
					    			//$("#mostrarDatos").hide(); 
		                    		$("#TDatosBasicos_nombres").attr("readonly", "readonly");
		                    		$("#TDatosBasicos_apellidos").attr("readonly", "readonly");
		                    		$("#TDatosBasicos_fecha_nacimiento").attr("readonly", "readonly");
		                    		$("#TDatosBasicos_sexo_0").attr("disabled", "disabled");
		                    		$("#TDatosBasicos_sexo_1").attr("disabled", "disabled");
		                    		$("#TDatosBasicos_id_estado_civil_0").attr("disabled", "disabled");
							    	$("#TDatosBasicos_id_estado_civil_1").attr("disabled", "disabled");
							    	$("#TDatosBasicos_id_estado_civil_2").attr("disabled", "disabled");
		                    		$("#").show(); // existe el paciente muestro los datos con opcion a editar
					    		
							        return true;
							    }else{
					    		
					    				
					    			//$("#mostrarDatos").hide(); 					    	
							    	$("#mostrarNuevaClasif").show();
							   		$("#TDatosBasicos_nombres").removeAttr("readonly");
		                    		$("#TDatosBasicos_apellidos").removeAttr("readonly");
		                    		$("#TDatosBasicos_fecha_nacimiento").removeAttr("readonly");
		                    		$("#TDatosBasicos_sexo_0").removeAttr("disabled");
		                    		$("#TDatosBasicos_sexo_1").removeAttr("disabled");
		                    		$("#TDatosBasicos_id_estado_civil_0").removeAttr("disabled");
							    	$("#TDatosBasicos_id_estado_civil_1").removeAttr("disabled");
							    	$("#TDatosBasicos_id_estado_civil_2").removeAttr("disabled");
							    	
							    	$("#TDatosBasicos_nro_identificacion").val($("#nombre_paciente").val());	
							    	$("#").hide(); // no existe el paciente muestros los campos para que los llene
									
							    }	
                        
		                    }', 

				            'highlighter'=>'js: function(item) {
								var regex = new RegExp( \'(\' + this.query + \')\', \'gi\' );
								return item.replace( regex, "<strong>$1</strong>" );
								
							}',

							'updater'=>'js:function(item) { 
					    		$("#mostrarNuevaClasif").hide();
					    		$("#mostrarDatos").show(); 
								$("#datos").show();	
							 	$("#TDatosBasicos_id_datos_basicos").val(map[item].id);	
							 	$("#TDatosBasicos_nro_identificacion").val(map[item].cedula);	
							 	$("#TDatosBasicos_nombres").val(map[item].nombre);	
							 	$("#TDatosBasicos_apellidos").val(map[item].apellido);
							 								 	
							 	var sexo = map[item].sexo;							 	
							 	
							 	/*$("input:radio[name=\'TDatosBasicos[sexo]\']").attr("checked", false);*/							 	
							 								 	 								
								$.each($("input:radio[name=\'TDatosBasicos[sexo]\']"), function() {	
															
									if ($(this).val() == sexo)
								 		$(this).attr(\'checked\',true);	
				 	
								});	
					    		

								$("input:hidden[name=\'TDatosBasicos[sexo]\']").val(map[item].sexo);					

							 	$("#TDatosBasicos_id_estado_civil").val(map[item].estado_civil);		 
							 	/*$("input:text[name=\'TDatosBasicos[fecha_nacimiento]\']").val(map[item].fecha_nac);	*/

								$("input:text[name=\'TUsuario[email]\']").attr("value",map[item].email);
							 	$("input:text[name=\'TDatosBasicos[fecha_nacimiento]\']").attr("value",map[item].fecha_nac);
							 	$("#TDatosBasicos_fecha_nacimiento").datepicker("update",map[item].fecha_nac);

							 	/*$("#TDatosBasicos_img_perfil").attr("src",map[item].img_perfil);	*/	
					    		
					    		
					    		    $("#TDatosBasicos_nombres").attr("readonly", "readonly");
		                    		$("#TDatosBasicos_apellidos").attr("readonly", "readonly");
		                    		$("#TDatosBasicos_fecha_nacimiento").attr("readonly", "readonly");
		                    		$("#TDatosBasicos_sexo_0").attr("disabled", "disabled");
		                    		$("#TDatosBasicos_sexo_1").attr("disabled", "disabled");
		                    		$("#TDatosBasicos_id_estado_civil_0").attr("disabled", "disabled");
							    	$("#TDatosBasicos_id_estado_civil_1").attr("disabled", "disabled");
							    	$("#TDatosBasicos_id_estado_civil_2").attr("disabled", "disabled");
							 	
							    return item;
							}',				                      		
					    ),
					    'htmlOptions' => array(
					    	//'class' => 'input-medium',
					        //'prepend' => '<i class="icon-search"></i>',
					        'placeholder' => 'Usuario',	
					        'style'=>'width:94%',				        		        
					    ),
					)); 

				?>
			</div>

			<span id="mostrarNuevaClasif" style="display:none;" onclick="location.href='<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Esculapio/TDatosBasicos/createIntegrado&id_perfil=0'">
				<?php $this->widget('bootstrap.widgets.TbLabel',
						array(
					    	'type' => 'warning',
					    	// 'success', 'warning', 'important', 'info' or 'inverse'
					    	'label' => 'Nuevo!',
					    	)
					    );
    			?>
			</span>
			
			<span class="help-block">Escriba el Nombre, Apellido o Cedula</span>
			<?php echo $form->error($model,'id_datos_basicos'); ?>

	
	

<?php //$this->endWidget(); ?>

<!-- </div> --><!-- form -->