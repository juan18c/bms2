<?php
/* @var $this THistoriaMedicaController */
/* @var $modelHM THistoriaMedica */
?>
<?php
//Yii::app()->getClientScript()->scriptMap=array('jquery.js'=>false,'jquery.min.js'=>false, 'jquery-ui.min.js'=>false); 
?>
<div class="col-lg-12">
<?php 

// CHtml::activeThis->beginWidget('CActiveForm', array(
// 	'id'=>'tcarrito-beneficiario-historia-form',
// 	// Please note: When you enable ajax validation, make sure the corresponding
// 	// controller action is handling ajax validation correctly.
// 	// There is a call to performAjaxValidation() commented in generated controller code.
// 	// See class documentation of CActiveForm for details on this.
// 	'enableAjaxValidation'=>false,
// 	'htmlOptions'=>array('role'=>'form','enctype' => 'multipart/form-data',)
// ));

 ?>



<h4><b>Si desea puede agregar un récipe médico o informe médico </b></h4>

<input type="hidden" id="idHistoriaMedica" name="idHistoriaMedica" value="">
<div class="form-group clearfix">	
	<label for="THistoriaMedica_id_historia_medica">Seleccione un documento</label>	
	<?php echo CHtml::activeDropDownList($modelHMC,'id_historia_medica_caso',$modelHMC->getLista($idBeneficiario),array('class'=>'selectpicker form-control','data-style'=>'btn-custom','empty'=>'Añadir Documento')); ?>
	<?php //echo CHtml::activeDropDownList($modelHMC,'id_historia_medica_caso',$modelHMC->getLista($idBeneficiario),array('class'=>'selectpicker form-control','data-style'=>'btn-custom','multiple'=>'multiple','empty'=>'Añadir Documento')); ?>
</div>

<div class="col-lg-12 clearfix" id="divHistoriaMedicaMensaje"></div>

<div style="display:none;margin:0px;" id="newDivHistoriaBene" class="row well">
	<div class="form-group">
		<div class="col-lg-6" style="padding-left: 0; margin-bottom:15px;">
			<?php echo CHtml::activeLabelEx($modelHMC,'nombre',array("class"=>"control-label")); ?>
			<?php echo CHtml::activeTextField($modelHMC,'nombre',array('class'=>'form-control' )); ?>
			<?php echo CHtml::error($modelHMC,'nombre'); ?>
		</div>
		<div class="col-lg-6" style="padding-right: 0; margin-bottom:15px;" >
			<?php echo CHtml::activeLabelEx($modelHMC,'tipo_carga',array("class"=>"control-label")); ?>
			<?php echo CHtml::activeDropDownList($modelHMC,'tipo_carga',array('RECIPES'=>'Récipe Médico','INFORMES'=>'Informe Médico','RESULTADOS'=>'Resultados'),array('class'=>'form-control ','empty'=>'Seleccione')); ?>
			<?php echo CHtml::error($modelHMC,'tipo_carga'); ?>			
		</div>
	</div>

	<div class="form-group">		

		<div class="col-lg-3" style="padding-left: 0; margin-bottom:15px;" >
			<label class="control-label">Fecha de realización</label>	
			<!--  data-provide="datepicker" -->
			<div id="fechaRealizacionHistoria" class="input-group date">    
			    <?php echo CHtml::activeTextField($modelHMC,'fecha_realizacion',array('class'=>'form-control','value'=>'','placeholder'=>date('d/m/Y'))); ?>
			    <div class="input-group-addon">
			        <span class="fa fa-calendar"></span>
			    </div>
			</div>							
		</div>
	
		<div class="col-lg-3">
    		<?php echo CHtml::activeLabelEx($modelMedico,'indMedico',array('class'=>'control-label')); ?>
			<?php echo CHtml::activeCheckBox($modelMedico,'indMedico',array('class'=>'form-control','data-toggle'=>"toggle",'data-on'=>"Si",'data-off'=>"No", 'data-onstyle'=>"custom",'data-offstyle'=>"custom1",'type'=>"checkbox",'data-width'=>"150",'data-height'=>"58",'data-size'=>"normal")); ?>			
			<?php echo CHtml::error($modelMedico,'indMedico'); ?>        
        </div>	

                	

		<div class="col-lg-6" id="divMedicoCot" style="display:none; padding-right: 0; margin-bottom:15px;">
			<?php echo CHtml::activeLabelEx($modelHMM,'id_medico',array("class"=>"control-label")); ?>                		
			<?php echo CHtml::activeDropDownList($modelHMM,'id_medico',CHtml::listData($modelMedico->getLista(),'id_medico','descripcionList'),array('class'=>'selectpicker form-control','empty'=>'Añadir Médico','data-style'=>'btn-custom')); ?>
			       
			<?php //echo CHtml::activeDropDownList($modelHMM,'duracion',array('class'=>'form-control' )); ?>
			<?php echo CHtml::error($modelHMM,'id_medico'); ?>
		</div>
	</div>

	<div style="display:none" id="newDivMedico" class="row">
       	<h4><b>Crear M&eacute;dico</b></h4>
       	<div class="form-group">
	      <div class="col-md-6 col-lg-6 col-xs-6" style="margin-bottom:15px;">
	          <?php echo CHtml::activeLabelEx($modelDBMedico,'[medico]id_tipo_identificacion'); ?>            
	          <?php echo CHtml::activeDropDownList($modelDBMedico,'[medico]id_tipo_identificacion',CHtml::listData(TTipoIdentificacion::model()->findAll(),'id_tipo_identificacion','descripcion'),array('class'=>'form-control')); ?>
	          <?php echo CHtml::error($modelDBMedico,'id_tipo_identificacion',array('class'=>'help-block')); ?>
	      </div>

	      <div class="col-md-6 col-lg-6 col-xs-6" style="margin-bottom:15px;">
	          <?php echo CHtml::activeLabelEx($modelDBMedico,'[medico]nro_identificacion'); ?>
	          <?php echo CHtml::activeTextField($modelDBMedico,'[medico]nro_identificacion',array('maxlength'=>60,'class'=>'form-control')); ?>
	          <?php echo CHtml::error($modelDBMedico,'[medico]nro_identificacion',array('class'=>'help-block')); ?>
	      </div>                 
	    </div>

    	<div class="form-group">
			<div class="col-md-6 col-lg-6 col-xs-6" style="margin-bottom:15px;">
				<?php echo CHtml::activeLabelEx($modelDBMedico,'[medico]nombres',array('class'=>'control-label')); ?>
				<?php echo CHtml::activeTextField($modelDBMedico,'[medico]nombres',array('maxlength'=>60,'class'=>'form-control')); ?>
				<?php echo CHtml::error($modelDBMedico,'[medico]nombres'); ?>
			</div>

			<div class="col-md-6 col-lg-6 col-xs-6" style="margin-bottom:15px;">
				<?php echo CHtml::activeLabelEx($modelDBMedico,'[medico]apellidos',array('class'=>'control-label')); ?>
				<?php echo CHtml::activeTextField($modelDBMedico,'[medico]apellidos',array('maxlength'=>60,'class'=>'form-control')); ?>
				<?php echo CHtml::error($modelDBMedico,'[medico]apellidos'); ?>
			</div>
			
		</div>

		<div class="form-group">
			<div class="col-xs-6" style="margin-bottom:15px;">
	        	<?php echo CHtml::activeLabelEx($modelDBMedico,'[medico]sexo',array('class'=>'control-label')); ?> <br>
				<?php //echo CHtml::activeCheckBox($modelDBMedico,'[medico]sexo',array('class'=>'form-control')); ?>

				<?php 

					echo CHtml::activeCheckBox($modelDBMedico,'[medico]sexo',array('class'=>'form-control','checked'=>'checked','data-toggle'=>"toggle",'data-on'=>"Femenino",'data-off'=>"Masculino", 'data-onstyle'=>"custom",'data-offstyle'=>"custom1",'type'=>"checkbox",'data-width'=>"150",'data-height'=>"58",'data-size'=>"normal"));
				?>		

				<?php echo CHtml::error($modelDBMedico,'[medico]sexo'); ?>
			</div>
			<div class="col-xs-6" style="margin-bottom:15px;">
				<?php //echo CHtml::activeLabelEx($modelEspecialidad,'id_especialidad',array('class'=>'control-label')); ?>
				<label class="control-label" for="TEspecialidad_id_especialidad">Especialidad</label>
				<?php echo CHtml::activeDropDownList($modelEspecialidad,'id_especialidad',CHtml::listData(TEspecialidad::model()->findAll(),'id_especialidad','descripcion'),array('class'=>'selectpicker form-control','multiple'=>'multiple')); ?>   
				<?php echo CHtml::error($modelEspecialidad,'id_especialidad'); ?>                    
            </div>
		</div>

		<div class="form-group">		
			<div class="col-xs-6" style="margin-bottom:15px;">
				<?php //echo CHtml::activeLabelEx($modelEspecialidad,'id_especialidad',array('class'=>'control-label')); ?>
				<label class="control-label" for="TDatosBasicosDireccion_medico_id_pais">Pais</label>
				<?php echo CHtml::activeDropDownList($modelDirMedico,'[medico]id_pais',CHtml::listData(TPais::model()->findAll(),'id_pais','descripcion'),array('class'=>'form-control','empty'=>'Seleccione',)); ?>    
				<?php echo CHtml::error($modelDirMedico,'[medico]id_pais'); ?>                    
            </div>


			<div class="col-xs-6" style="margin-bottom:15px;">
				<?php echo CHtml::activeLabelEx($modelDirMedico,'[medico]id_estado',array('class'=>'control-label')); ?>
				<?php echo CHtml::activeDropDownList($modelDirMedico,'[medico]id_estado',array(),array('class'=>'form-control')); ?>
				<?php echo CHtml::error($modelDirMedico,'[medico]id_estado'); ?>
			</div>
		</div>

		<div class="form-group">			
            
            
            <div class="col-xs-6" style="margin-bottom:15px;">
				<?php echo CHtml::activeLabelEx($modelDirMedico,'[medico]ciudad',array('class'=>'control-label')); ?>
				<?php echo CHtml::activeTextField($modelDirMedico,'[medico]ciudad',array('class'=>'form-control')); ?>
				<?php echo CHtml::error($modelDirMedico,'[medico]ciudad'); ?>
			</div>

            <div class="col-xs-6" style="margin-bottom:15px;">
	        	<?php echo CHtml::activeLabelEx($modelDirMedico,'[medico]direccion1',array('class'=>'control-label')); ?>
				<?php echo CHtml::activeTextarea($modelDirMedico,'[medico]direccion1',array('class'=>'form-control','rows'=>'2')); ?>							
				<?php echo CHtml::error($modelDirMedico,'[medico]direccion1'); ?>
			</div>
        </div>
        <div class="form-group">
        	<div class="col-xs-6" style="margin-bottom:15px;">
				<?php //echo CHtml::activeLabelEx($modelDBMedico,'email',array('class'=>'control-label')); ?>
				<label class="control-label" for="TDatosBasicos_medico_email">Email</label>
				<?php echo CHtml::activeTextField($modelDBMedico,'[medico]email',array('class'=>'form-control')); ?>
				<?php echo CHtml::error($modelDBMedico,'[medico]email'); ?>                    
            </div>
        	<div class="col-xs-6" style="margin-bottom:15px;">
				<?php //echo CHtml::activeLabelEx($modelDirMedico,'telefono_fijo',array('class'=>'control-label')); ?>
				<label class="control-label" for="TDatosBasicosDireccion_medico_telefono_fijo">Tel&eacute;fono (opcional)</label>
				<?php echo CHtml::activeTextField($modelDirMedico,'[medico]telefono_fijo',array('class'=>'form-control')); ?>
				<?php echo CHtml::error($modelDirMedico,'[medico]telefono_fijo'); ?>                    
            </div>										
			
		</div>

		<div class="form-group">
			<div class="col-xs-12" style="margin-bottom:15px;">
				<br>
				<button type="button" class="btn btn-primary pull-right" id="buttonCrearMedico"><i class="fa fa-user-md"></i> Crear Medico</button>
			</div>

		</div>
		<hr>
	</div>

	<div class="form-group">	
		
        <?php echo CHtml::activeLabelEx($modelHMD, 'ruta'); ?>
        <div class="controls col-md-12" style="padding-left: 0; margin-bottom:15px;">
            <div class="fileupload fileupload-new" data-provides="fileupload">
                <span class="btn btn-default btn-file">
                    <span class="fileupload-new"><i class="fa fa-paperclip"></i> Seleccione ...</span>
                    <span class="fileupload-exists"><i class="fa fa-undo"></i> Cambiar</span>
                    <?php echo CHtml::activeFileField($modelHMD, 'ruta'); ?>
					<?php echo CHtml::error($modelHMD, 'ruta'); ?>
                </span>
                <span class="fileupload-preview" style="margin-left:5px;"></span>
                <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
            </div>
        </div>
    	
        	
		
    </div>

    <div class="form-group">
    	<button class="btn btn-primary pull-right" type="button" id="THistoriaMedica_crear_historia" name="THistoriaMedica_crear_historia"><i class="fa fa-plus-circle "></i> A&ntilde;adir Documento</button>
    </div>
    

</div>
<?php //$this->endWidget(); ?>

</div>

<div id="historia-documentos-div" class="adv-table"></div>