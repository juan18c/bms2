<?php
/* @var $this THistoriaMedicaController */
/* @var $model THistoriaMedica */
/* @var $form CActiveForm */
?>

<div class="form">

 <?php //$form=$this->beginWidget('CActiveForm', array(
// 	'id'=>'buscar-paciente-form',
// 	// Please note: When you enable ajax validation, make sure the corresponding
// 	// controller action is handling ajax validation correctly.
// 	// There is a call to performAjaxValidation() commented in generated controller code.
// 	// See class documentation of CActiveForm for details on this.
// 	'enableAjaxValidation'=>false,
// )); ?>

	
	<div class="row-fluid">
		<div class="span12">
			<div class="input-prepend">
				<span class="add-on add-on-icon">
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

							    var data = '.$model->getPaciente().';
							   //alert(data);
							    if (data == null){
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
		                    	$("#TDatosBasicos_id_datos_basicos").val("");		                    	
							 	$("#TDatosBasicos_nro_identificacion").val("");	
							 	$("#TDatosBasicos_nombres").val("");	
							 	$("#TDatosBasicos_apellidos").val("");
					    		$("#TDatosBasicosUbicacion_telefono_movil").val("");
					    		$("#TDatosBasicosUbicacion_telefono_fijo").val("");
				    		
							 						 								 	
							 	$("input:radio[name=\'TDatosBasicos[sexo]\']").attr("checked", false);							 	
							 								 	 								
								$.each($("input:radio[name=\'TDatosBasicos[sexo]\']"), function() {																		
									if ($(this).val() == "F")
								 		$(this).attr(\'checked\',true);								 	
								});	

								$("input:hidden[name=\'TDatosBasicos[sexo]\']").val("F");
							 	$("#TDatosBasicos_id_estado_civil").val("");		 
							 	$("#TDatosBasicos_fecha_nacimiento").val("");	

		                    	if (item.toLowerCase().indexOf(this.query.trim().toLowerCase()) != -1) {	                    		
		                    		$("#mostrarNuevaClasif").hide();
		                    		$("#TDatosBasicos_nombres").attr("readonly", "readonly");
		                    		$("#TDatosBasicos_apellidos").attr("readonly", "readonly");
		                    		$("#TDatosBasicos_fecha_nacimiento").attr("readonly", "readonly");
		                    		$("#TDatosBasicos_sexo_0").attr("disabled", "disabled");
		                    		$("#TDatosBasicos_sexo_1").attr("disabled", "disabled");
		                    		$("#TDatosBasicos_id_estado_civil_0").attr("disabled", "disabled");
							    	$("#TDatosBasicos_id_estado_civil_1").attr("disabled", "disabled");
							    	$("#TDatosBasicos_id_estado_civil_2").attr("disabled", "disabled");
					    			$("#TDatosBasicosUbicacion_telefono_fijo").removeAttr("disabled");
					    			$("#TDatosBasicosUbicacion_telefono_movil").removeAttr("disabled");
	


		                    		$("#").show();
					    			// existe el paciente muestro los datos con opcion a editar
							        return true;
							    }else{						    	
							    	$("#mostrarNuevaClasif").show();
							    	$("#TDatosBasicos_nombres").removeAttr("readonly");
							    	$("#TDatosBasicos_apellidos").removeAttr("readonly");
							    	$("#TDatosBasicos_fecha_nacimiento").removeAttr("readonly");
					    			$("#TDatosBasicosUbicacion_telefono_fijo").removeAttr("readonly");
					    			$("#TDatosBasicosUbicacion_telefono_movil").removeAttr("readonly");
							    	$("#TDatosBasicos_sexo_0").removeAttr("disabled");
							    	$("#TDatosBasicos_sexo_1").removeAttr("disabled");
							    	$("#TDatosBasicos_id_estado_civil_0").removeAttr("disabled");
							    	$("#TDatosBasicos_id_estado_civil_1").removeAttr("disabled");
							    	$("#TDatosBasicos_id_estado_civil_2").removeAttr("disabled");					    		

							    	$("#datos").show();
							    	$("#TDatosBasicos_nro_identificacion").val($("#nombre_paciente").val());	
							    	$("#").hide(); // no existe el paciente muestros los campos para que los llene

							    }		                        
		                    }', 

				            'highlighter'=>'js: function(item) {
								var regex = new RegExp( \'(\' + this.query + \')\', \'gi\' );
								return item.replace( regex, "<strong>$1</strong>" );
								
							}',

							'updater'=>'js:function(item) { 
								$("#datos").show();	
							 	$("#TDatosBasicos_id_datos_basicos").val(map[item].id);	
							 	$("#TDatosBasicos_nro_identificacion").val(map[item].cedula);	
							 	$("#TDatosBasicos_nombres").val(map[item].nombre);	
							 	$("#TDatosBasicos_apellidos").val(map[item].apellido);
					    		$("#TDatosBasicosUbicacion_telefono_movil").val("");
					    		$("#TDatosBasicosUbicacion_telefono_fijo").val("");
							 								 	
							 	var sexo = map[item].sexo;							 	
							 	
							 	$("input:radio[name=\'TDatosBasicos[sexo]\']").attr("checked", false);							 	
							 								 	 								
								$.each($("input:radio[name=\'TDatosBasicos[sexo]\']"), function() {																		
									if ($(this).val() == sexo)
								 		$(this).attr(\'checked\',true);								 	
								});	

								$("input:hidden[name=\'TDatosBasicos[sexo]\']").val(map[item].sexo);					

							 	$("#TDatosBasicos_id_estado_civil").val(map[item].estado_civil);		 
							 	/*$("input:text[name=\'TDatosBasicos[fecha_nacimiento]\']").val(map[item].fecha_nac);	*/


							 	$("input:text[name=\'TDatosBasicos[fecha_nacimiento]\']").attr("value",map[item].fecha_nac);
							 	$("#TDatosBasicos_fecha_nacimiento").datepicker("update",map[item].fecha_nac);

					    		$("input:text[name=\'TDatosBasicosUbicacion[telefono_movil]\']").removeAttr("readonly");
					    		$("input:text[name=\'TDatosBasicosUbicacion[telefono_fijo]\']").removeAttr("readonly");
				
					    		
					    		if (map[item].telefono_movil != ""){
					    			
					    			num=map[item].telefono_fijo.split("-");
					    			
					    			$("input:text[name=\'TDatosBasicosUbicacion[telefono_fijo]\']").attr("value",num[1]);
					    			var selectRol = $("select#codAreaFijo");
									selectRol.val(num[0]).attr("selected", "selected");		
					    		
					    		}
					    		
					    	    if (map[item].telefono_movil != ""){
					    			movil=map[item].telefono_movil.split("-");
					    			var selectRol = $("select#codAreaMovil");
									selectRol.val(movil[0]).attr("selected", "selected");	
					    		    $("input:text[name=\'TDatosBasicosUbicacion[telefono_movil]\']").attr("value",movil[1]);
					    			
					    		}


							 	$("#TDatosBasicos_img_perfil").attr("src",map[item].img_perfil);		
							 	
							    return item;
							}',				                      		
					    ),
					    'htmlOptions' => array(
					    	//'class' => 'input-medium',
					        //'prepend' => '<i class="icon-search"></i>',
					        'placeholder' => 'Pacientes',	
					        'class'=>'input-xlarge'				        		        
					    ),
					)); 

				?>
			</div>

			<span id="mostrarNuevaClasif" style="display:none;">
				<?php $this->widget('bootstrap.widgets.TbLabel',
						array(
					    	'type' => 'warning',
					    	// 'success', 'warning', 'important', 'info' or 'inverse'
					    	//'label' => 'Nuevo!',
					    	)
					    );
    			?>
			</span>
			
			<span class="help-block" style="size-font:12px;color:#666666">Escriba el Nombre, Apellido, C&eacute;dula o N&uacute;mero de Historia del Paciente</span>
			<?php echo $form->error($model,'id_datos_basicos'); ?>

		</div>

	    	
		</div>
	
	

<?php //$this->endWidget(); ?>

</div><!-- form -->