<?php
/* @var $this TDatosBasicosController */
/* @var $model TDatosBasicos */
/* @var $form CActiveForm */
?>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.plugins.min.js"></script>
<script type="text/javascript">
	
	function modificar_por_fechaNacimiento(valor)
    {
    	var fechaActual = new Date();
    	var diaActual = fechaActual.getDate();
		var mmActual = fechaActual.getMonth() + 1;
		var yyyyActual = fechaActual.getFullYear();
		var fechaActual_1 = diaActual + '/' + mmActual + '/' + yyyyActual;
		FechaNac = valor.split("/");
		var diaCumple = FechaNac[0];
		var mmCumple = FechaNac[1];
		var yyyyCumple = FechaNac[2];

		if (mmCumple.substr(0,1) == 0) {
		mmCumple= mmCumple.substring(1, 2);
		}
		//retiramos el primer cero de la izquierda
		if (diaCumple.substr(0, 1) == 0) {
		diaCumple = diaCumple.substring(1, 2);
		}
		var edad = yyyyActual - yyyyCumple;
		if ((mmActual < mmCumple) || (mmActual == mmCumple && diaActual < diaCumple)) {
			edad--;
		}
		if($("#TDatosBasicosPerfil_id_perfil").val()==5 || ($("#TDatosBasicosPerfil_id_perfil").val()==4) || ($("#TDatosBasicosPerfil_id_perfil").val()==3)){
        	edad=18;
        }
        if(edad<18){
            $("#tdatosrepresentante-div").show();
	 
        }else{
        	$("#tdatosrepresentante-div").hide();
        	$("#div-representante").hide();
        	$("#div-representante-otrosdatos").hide();
        }

        if(yyyyActual<=yyyyCumple)
        {
        	if(yyyyActual==yyyyCumple){
        		if(mmActual<=mmCumple){
	        		if((mmActual==mmCumple) && (diaActual<diaCumple)){
			        	alert("La Fecha de Nacimiento " + valor+ " no puede ser mayor a la actual ");
			        	$("#TDatosBasicos_fecha_nacimiento").val(fechaActual_1);
			        	$("#TDatosBasicos_id_datos_basicos_representante").val("");
			        	$("#nombre_representante").val("");
			        }else if(mmActual<mmCumple){
				       	alert("La Fecha de Nacimiento " + valor+ " no puede ser mayor a la actual ");
			        	$("#TDatosBasicos_fecha_nacimiento").val(fechaActual_1);
			        	$("#TDatosBasicos_id_datos_basicos_representante").val("");
			        	$("#nombre_representante").val("");
			        }
		        }
	        }else if(yyyyActual < yyyyCumple){
		       	alert("La Fecha de Nacimiento " + valor+ " no puede ser mayor a la actual ");
	        	$("#TDatosBasicos_fecha_nacimiento").val(fechaActual_1);
	        	$("#TDatosBasicos_id_datos_basicos_representante").val("");
	        	$("#nombre_representante").val("");
	        }
        }

        return false;
    }

    function activar_div()
    {
        // alert($("#TDatosBasicos_id_datos_basicos_representante").val());
        if($("#TDatosBasicos_id_datos_basicos_representante").val()!=""){
               $("#div-representante-otrosdatos").hide();
        }else{
        	   $("#div-representante-otrosdatos").show();
        }
        return false;
    }

    function definir_por_ti(valor)
    {
    	if(valor==5){
    		$("#tdatospacientesinid-div").show();
    		$("#tdatosbasicosUbicacion-form").hide();
    		$("#tdatosbasicosseguro-form").hide();
    		$("#div_fecha").hide();
        	$("#TDatosBasicos_nro_identificacion").attr("readonly", "readonly");
        	$("#TDatosBasicos_nombres").attr("readonly", "readonly");
        	$("#TDatosBasicos_apellidos").attr("readonly", "readonly");
        	$("#TDatosBasicos_observacion").val("");
    	}else{
    		$("#tdatospacientesinid-div").hide();
    		$("#tdatosbasicosUbicacion-form").show();
    		$("#tdatosbasicosseguro-form").show();
    		$("#div_fecha").show();
        	$("#TDatosBasicos_nro_identificacion").removeAttr("readonly");
        	$("#TDatosBasicos_nombres").removeAttr("readonly");
        	$("#TDatosBasicos_apellidos").removeAttr("readonly");
    	}
        
        return false;
    }


	$(document).ready(function(){

		$("#TDatosBasicos_edad_posible").spinner({ min: 0 });
	
		if($("#TDatosBasicos_id_datos_basicos_representante").val()== "" ){
		   	$("#tdatosrepresentante-div").hide();
        	$("#div-representante").hide();
        	$("#div-representante-otrosdatos").hide();
        }else{
        	$("#tdatosrepresentante-div").show();
        	$("#div-representante").show();
        	$("#div-representante-otrosdatos").show();
        	$("#TDatosBasicos_nombres_representante").attr("readonly", "readonly");
			$("#TDatosBasicos_apellidos_representante").attr("readonly", "readonly");
			$.each($("input:radio[name=\'TDatosBasicos[sexo_representante]\']"), function() {																		
									//if ($(this).val() == "F")
								 		$(this).attr("disabled","disabled");								 	
								});	

			$("#TDatosBasicos_id_estado_civil_representante").attr("disabled", "disabled");
			$("#fecha_nacimiento_div").hide();
        }

        if($("#TDatosBasicos_id_tipo_identificacion").val()== "5" && ($("#opcion").val()=="INSERT" )){
        	$("#tdatospacientesinid-div").show();
    		$("#tdatosbasicosUbicacion-form").hide();
    		$("#tdatosbasicosseguro-form").hide();
    		$("#div_fecha").hide();
        	$("#TDatosBasicos_nro_identificacion").attr("readonly", "readonly");
        	$("#TDatosBasicos_nombres").attr("readonly", "readonly");
        	$("#TDatosBasicos_apellidos").attr("readonly", "readonly");
    	}
    	if($("#TDatosBasicos_id_tipo_identificacion").val()== "5" && ($("#TDatosBasicos_id_datos_basicos").val()!="" )){
    		$("#tdatospacientesinid-div").show();
    	}
        return false;
    });
	
</script>

<div  id='tdatosbasicos-multiple' style='display:none'>

	<h3 class="heading" id="#title-datos2">Datos Básicos</h3>
	<div class="row-fluid"> 
		<?php echo chtml::hiddenField('opcion',strtoupper($model->getScenario())); ?>
		
	</div>		

</div>		
		<div  id='tdatosbasicos-foto' class="span6" style='display:none'>
            <!-- Foto de Usuario -->     
            <div data-provides="fileupload" class="fileupload fileupload-new"><input type="hidden" value="" />
                                   
				<?php if (strtoupper($model->getScenario())=='INSERT'){ ?>
	                <div style="width: 170px; height: 170px; line-height: 150px;" class="fileupload-new thumbnail"><img src="http://www.placehold.it/150x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /></div>
	                <div style="width: 170px; height: 170px; line-height: 0px;" class="fileupload-preview fileupload-exists thumbnail"></div>
				<?php }else{ ?>
		        		
					<?php if((isset($model->img_perfil))&&($model->img_perfil!="")){ ?>
						<div style="width: 150px; height: 150px; line-height: 150px;" class="fileupload-new thumbnail"><img src='<?php echo $model->img_perfil; ?>' alt="" /></div> 
					<?php }else{ ?>
						<div style="width: 150px; height: 150px; line-height: 150px;" class="fileupload-new thumbnail"><img src="http://www.placehold.it/150x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /></div> 
					<?php } ?>
					<div style="width: 150px; height: 150px; line-height: 0px;" class="fileupload-preview fileupload-exists thumbnail"></div>
				<?php } ?>

                <div>
                    <span class="btn btn-file">
                        <span class="fileupload-new">Seleccionar Foto</span>
                        <span class="fileupload-exists"><a href="javascript:void(0)" title="Remove"><i class="icon-pencil"></i></a></span>
                        <?php echo $form->fileField($model, 'img_perfil'); ?>
                         <!-- <input type="file" id="TDatosBasicos_img_perfil" name="TDatosBasicos_img_perfil"/>  -->
                    </span>
                    <a data-dismiss="fileupload" class="btn fileupload-exists" href="#"><i class="icon-trash"></i></a>
                </div>
            </div>  
        </div>		

		<div  id='tdatosbasicos-datos' class="span5" style='display:none'>
			<div class="span">

				<?php echo $form->labelEx($model,'nro_identificacion'); ?>
				<div class="control-group">
					<?php echo $form->dropDownList($model,'id_tipo_identificacion',CHtml::listData(TTipoIdentificacion::model()->findAll(),'id_tipo_identificacion','abreviatura'),array('class'=>'span','style'=>'width:27.8%', 'onChange' => 'javascript:definir_por_ti($(this).val())',)); ?>				
					<?php //echo $form->error($model,'id_tipo_identificacion'); ?>			
					<?php if (strtoupper($model->getScenario())=='INSERT'){ ?>
						<?php echo $form->textField($model,'nro_identificacion',array('class'=>'span12','style'=>'width:70%')); ?>
					<?php }else{ ?>
				    	<?php if (Yii::app()->user->getState('id_rol')=='medico'){?>
				    		<?php echo $form->textField($model,'nro_identificacion',array('class'=>'span12','style'=>'width:70%')); ?>
						<?php }else{ ?>
							<?php echo $form->textField($model,'nro_identificacion',array('class'=>'span12','style'=>'width:70%', 'readonly'=>'readonly')); ?>
						<?php } ?>
					<?php } ?>
					<?php echo $form->error($model,'nro_identificacion',array('class'=>'help-block')); ?>
	            </div>
	        </div>
	        <div class="row-fluid">
				<div class="span">
					<?php echo $form->labelEx($model,'nombres'); ?>
					<div class="control-group">
						<?php echo $form->textField($model,'nombres',array('maxlength'=>60,'class'=>'span12')); ?>
						<?php echo $form->error($model,'nombres',array('class'=>'help-block')); ?>
		            </div>
				</div>
			</div>
	        <div class="row-fluid">
				<div class="span">
					<?php echo $form->labelEx($model,'apellidos'); ?>
					<div class="control-group">
						<?php echo $form->textField($model,'apellidos',array('maxlength'=>60,'class'=>'span12')); ?>
						<?php echo $form->error($model,'apellidos',array('class'=>'help-block')); ?>
		            </div>
				</div>
			</div>
		</div>		
<!-- 	</div> -->
<!-- </div> -->
<div  class="formSep" id='tdatosbasicos-form' style='display:none'>

	<div class="row-fluid">
		<div class="span6">
			<?php echo $form->labelEx($model,'sexo'); $model->sexo = 'F'; ?>
			<?php

						                echo $form->radioButtonList($model, 'sexo',
						                    array(  'F' => 'Femenino',
						                            'M' => 'Masculino',
						                    ),
						                    array( 	'separator' => " ",
						                    		'labelOptions'=>array('class'=>'radio','style'=>'display:inline;padding-right:5px'),
						                    		'template'=>'{input}{label}',
						                    		'class'=>'radio inline'
						                    )
						                 );
						            ?>

			<?php //echo $form->dropDownList($model,'sexo',array('F'=>'Femenino','M'=>'Masculino'),array('class'=>'span12')); ?>
			<?php //echo $form->textField($model,'sexo',array('size'=>2,'maxlength'=>2)); ?>
			<?php echo $form->error($model,'sexo'); ?>
		</div>
		<div class="span6">
			<?php echo $form->labelEx($model,'id_estado_civil',array('style'=>'margin-left:14px')); ?>
			<div class="control-group">
				<?php echo $form->dropDownList($model,'id_estado_civil',CHtml::listData(TEstadoCivil::model()->findAll(),'id_estado_civil','descripcion'),array('class'=>'span10','style'=>'margin-left:14px')); ?>	
				<?php //echo $form->textField($model,'id_estado_civil'); ?>
				<?php echo $form->error($model,'id_estado_civil',array('class'=>'help-block')); ?>
            </div>
		</div>	
	</div>

	<div id="div_fecha" class="row-fluid">
		<div class="span6">


			<?php echo $form->labelEx($model,'fecha_nacimiento'); ?>
			<div class="input-append">
				
			<?php 
				
 				$model->fecha_nacimiento=date('d/m/Y');
 					$this->widget('zii.widgets.jui.CJuiDatePicker', array(

					'model'=>$model,
				 	'attribute'=>'fecha_nacimiento',
				 	'value'=>$model->fecha_nacimiento,
				 	'language' => 'es',
				 	//'flat'=>true,
				 	'htmlOptions' => array('readonly'=>"readonly",'style'=>'width:75%', 'onChange' => 'javascript:modificar_por_fechaNacimiento($(this).val())',  ),				 
				 	'options'=>array(
				 		'autoSize'=>true,
				 		'defaultDate'=>$model->fecha_nacimiento,
				 		'dateFormat'=>'dd/mm/yy',
				 		//'buttonImage'=>'',
				 		'buttonImageOnly'=>false,
						'buttonText'=>'<i class="icon-calendar"></i>',						
						'selectOtherMonths'=>true,
						'showAnim'=>'slide',
						'showButtonPanel'=>true,
						'showOn'=>'both',
						'showOtherMonths'=>true,
						'changeMonth' => 'true',
						'changeYear' => 'true',
						
				 	),
				)); 
			?>
				 
			</div>
    		

			<?php //echo $form->textField($model,'fecha_nacimiento',array('class'=>'span12')); ?>
			<?php echo $form->error($model,'fecha_nacimiento'); ?>
		</div>
		<div id="div_mencion" class="span6" style='display:none'>
			<?php echo $form->labelEx($model,'id_mencion',array('style'=>'margin-left:14px')); ?>
			<div class="control-group">
				<?php echo $form->dropDownList($model,'id_mencion',CHtml::listData(TMencion::model()->findAll(),'id_mencion','descripcion'),array('class'=>'span10','style'=>'margin-left:14px')); ?>	
				<?php echo $form->error($model,'id_mencion',array('class'=>'help-block')); ?>
            </div>
		</div>	
	</div>

	<div class="row-fluid">

		<!--<div class="span4">
			<?php //echo $form->labelEx($model,'nacionalidad'); ?>
			<?php //echo $form->textField($model,'nacionalidad',array('size'=>20,'maxlength'=>20,'class'=>'span12')); ?>
			<?php //echo $form->error($model,'nacionalidad'); ?>
		</div>-->
	
		<div id='tdatosrepresentante-div' class="span5"  style='display:none'>
	        <div class="row-fluid">
	            <div class="span12">
	            	<?php echo chtml::label('Buscar',''); ?>
	                <div class="input-prepend">
	                    <span class="add-on ad-on-icon">
	                        <i class="icon-user"></i>
	                    </span> 
	                     <?php                   
	                        $this->widget('bootstrap.widgets.TbTypeahead', array( 
	                            'id'=>'nombre_representante',                  
	                            'name'=>'nombre_representante',
	                            'options' => array(                                             
	                                'source'=> 'js:function(query, process) {
	                                    states = [];
	                                    map = {};
	                                    $("#TDatosBasicos_id_datos_basicos_representante").val("");
	                                    var data = '.TDatosBasicos::model()->getTitular().';
	                                    if (data == null){
	                                        $("#mostrarNuevoRepresentante").show();

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
	                                	$("#TDatosBasicos_id_datos_basicos_representante").val("");
	                                    $("#TDatosBasicos_nombres_representante").val("");   
	                                    $("#TDatosBasicos_apellidos_representante").val(""); 
	                                    $("#TDatosBasicos_nombres_representante").removeAttr("readonly");
										$("#TDatosBasicos_apellidos_representante").removeAttr("readonly");
										$.each($("input:radio[name=\'TDatosBasicos[sexo_representante]\']"), function() {																		
									 		$(this).removeAttr("disabled");								 	
										});	
	                                   	// $("#TDatosBasicos_nro_identificacion").val(( $("#nombre_representante").val()));
										$("#TDatosBasicos_id_estado_civil_representante").removeAttr("disabled");
										$("#fecha_nacimiento_div").show();

											                                    	                                                                                                               
	                                    if (item.toLowerCase().indexOf(this.query.trim().toLowerCase()) != -1) {                                
	                                        
	                                        $("#div-representante").show();
	                                        $("#div-representante-otrosdatos").hide();

	                                        return true;
	                                    }else{                              
	                                        $("#div-representante").show();
	                                        
	                                    }              
	                                }', 

	                                'highlighter'=>'js: function(item) {
	                                    var regex = new RegExp( \'(\' + this.query + \')\', \'gi\' );
	                                    return item.replace( regex, "<strong>$1</strong>" );
	                                    
	                                }',
	                                'updater'=>'js:function(item) { 
	                                	$("#TDatosBasicos_id_datos_basicos_representante").val(map[item].id); 
	                                	$("#TDatosBasicos_nro_identificacion").val(map[item].cedula); 
	                                	// $("#TDatosBasicos_nro_identificacion").attr("readonly", "readonly");
	                                    $("#TDatosBasicos_nombres_representante").val(map[item].nombres); 
										$("#TDatosBasicos_apellidos_representante").val(map[item].apellidos); 
										$("#TDatosBasicos_nombres_representante").attr("readonly", "readonly");
										$("#TDatosBasicos_apellidos_representante").attr("readonly", "readonly");
										return item;
	                                }', 
	                               
	                            ),
	                            'htmlOptions' => array(
	                                'placeholder' => 'Representante',   
	                                'class'=>'span12',
	                                'onChange' => 'javascript:activar_div($(this).val())',    
	                            ),
	                        )); 

	                    ?>
	                </div>
	            </div>
	        </div>
	    </div>
    </div>

    <div id="div-representante" class="row-fluid" style='display:none'>
    	<?php echo $form->hiddenField($model,'id_datos_basicos_representante');  ?>
         <div class="row-fluid">
            <div class="span6">
                <?php echo $form->labelEx($model,'nombres_representante'); ?>
                <?php echo $form->textField($model,'nombres_representante',array('maxlength'=>60,'class'=>'span12')); ?>
                <?php echo $form->error($model,'nombres_representante'); ?>
            </div>   
            <div class="span6">
                <?php echo $form->labelEx($model,'apellidos_representante',array('style'=>'margin-left:14px')); ?>
                <?php echo $form->textField($model,'apellidos_representante',array('maxlength'=>60,'class'=>'span10','style'=>'margin-left:14px')); ?>
                <?php echo $form->error($model,'apellidos_representante'); ?>
            </div>      
        </div>
    </div>

    <div id="div-representante-otrosdatos" class="row-fluid" style='display:none'>
        <div class="row-fluid">
            <div class="span6">
                <?php echo $form->labelEx($model,'Sexo'); ?>
                <?php $model->sexo_representante = 'F'; ?>
				<?php
			                echo $form->radioButtonList($model, 'sexo_representante',
			                    array(  'F' => 'Femenino',
			                            'M' => 'Masculino',
			                    ),
			                    array( 	'separator' => " ",
			                    		'labelOptions'=>array('class'=>'radio','style'=>'display:inline;padding-right:10px'),
			                    		'template'=>'{input}{label}',
			                    		'class'=>'radio inline'
			                    )
			                 );
			            ?>
            </div>     
            <div class="span6">
       			<?php echo $form->labelEx($model,'Estado Civil',array('style'=>'margin-left:14px')); ?>
				<?php echo $form->dropDownList($model,'id_estado_civil_representante',CHtml::listData(TEstadoCivil::model()->findAll(),'id_estado_civil','descripcion'),array('class'=>'span10','style'=>'margin-left:14px')); ?>	
	        </div> 
        </div>
        <div id="fecha_nacimiento_div" class="row-fluid">
      		<div class="span5">
				<?php echo $form->labelEx($model,'fecha_nacimiento_representante'); ?>
				<div class="input-append">
					
				<?php 
					
	 				$model->fecha_nacimiento=date('d/m/Y');
	 					$this->widget('zii.widgets.jui.CJuiDatePicker', array(

						'model'=>$model,
					 	'attribute'=>'fecha_nacimiento_representante',
					 	'value'=>$model->fecha_nacimiento_representante,
					 	'language' => 'es',
					 	//'flat'=>true,
					 	'htmlOptions' => array('readonly'=>"readonly",'style'=>'width:75%',),				 
					 	'options'=>array(
					 		'autoSize'=>true,
					 		'defaultDate'=>$model->fecha_nacimiento_representante,
					 		'dateFormat'=>'dd/mm/yy',
					 		//'buttonImage'=>'',
					 		'buttonImageOnly'=>false,
							'buttonText'=>'<i class="icon-calendar"></i>',						
							'selectOtherMonths'=>true,
							'showAnim'=>'slide',
							'showButtonPanel'=>true,
							'showOn'=>'both',
							'showOtherMonths'=>true,
							'changeMonth' => 'true',
							'changeYear' => 'true',
							
					 	),
					)); 
				?>
					 
				</div>
			</div>
		</div>
    		

    </div>

    <div id='tdatospacientesinid-div' class="row-fluid"  style='display:none'>
		<div class="span4">
			<?php echo $form->labelEx($model,'edad_posible'); ?>
			<div class="control-group">
				<?php echo $form->textField($model,'edad_posible',array('style'=>'border-width: 0','class'=>'span')); ?>
				<?php echo $form->error($model,'edad_posible',array('class'=>'help-block')); ?>
            </div>
		</div>	
		<div class="span8">
			<?php echo $form->labelEx($model,'observacion'); ?>
			<div class="control-group">
				<?php echo $form->textArea($model,'observacion',array('rows'=>2, 'cols'=>30,'class'=>'span11')); ?>
				<?php echo $form->error($model,'observacion',array('class'=>'help-block')); ?>
            </div>
		</div>	
	</div>    	
	
</div>


