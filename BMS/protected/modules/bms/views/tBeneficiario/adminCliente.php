<?php
/* @var $this TBeneficiarioController */
/* @var $modelBeneficiario TBeneficiario */
$modelDB=new TDatosBasicos;
$modelParentesco=new TParentesco;

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tbeneficiario-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});

$('#tcotizacion-beneficiario-form').find('#fechaNacBeneficiario').datepicker({language:'es'});
$('#tcotizacion-beneficiario-form').find('#TDatosBasicos_beneficiario_sexo').bootstrapToggle({
  on: 'Femenino',
  off: 'Masculino',
  onstyle:'theme_button color1',
  width:150
});
            
");
?>
<section id="content" class="ls section_padding_top_100 section_padding_bottom_75">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
	            <h3 class="entry-title">Beneficiarios</h3>
	            <?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'tcotizacion-beneficiario-form',
					// Please note: When you enable ajax validation, make sure the corresponding
					// controller action is handling ajax validation correctly.
					// There is a call to performAjaxValidation() commented in generated controller code.
					// See class documentation of CActiveForm for details on this.
					'enableAjaxValidation'=>false,
					'htmlOptions'=>array('role'=>'form','enctype' => 'multipart/form-data')
				)); ?>


				<div class="form-group">	
					<button type="button" class="btn theme_button color1 pull-right" onclick="js: $('#newDivFamiliar').toggle(); "><i class="fa fa-user"></i> Crear Beneficiario</button>
					<?php //echo $form->dropDownList($modelB,'id_beneficiario',$modelB->getLista($model->id_responsable),array('class'=>'selectpicker form-control','data-style'=>'btn-custom','empty'=>'Añadir Beneficiario')); ?>
				</div>

				<div style="display:none;margin:0px;" id="newDivFamiliar" class="row well">
				   	<!-- <h4>Crear Beneficiario</h4> -->				
				   	<br>
				    <div class="form-group">
						<div class="col-lg-4" style="padding-left: 0; margin-bottom:15px;">
							<?php echo $form->labelEx($modelDB,'[beneficiario]id_tipo_identificacion'); ?>						
							<?php echo $form->dropDownList($modelDB,'[beneficiario]id_tipo_identificacion',CHtml::listData(TTipoIdentificacion::model()->findAll(),'id_tipo_identificacion','descripcion'),array('class'=>'form-control')); ?>
							<?php echo $form->error($modelDB,'[beneficiario]id_tipo_identificacion'); ?>
						</div>

						<div class="col-lg-8" style="padding-right: 0; margin-bottom:15px;">
							<?php echo $form->labelEx($modelDB,'[beneficiario]nro_identificacion'); ?>
							<?php echo $form->textField($modelDB,'[beneficiario]nro_identificacion',array('maxlength'=>60,'class'=>'form-control')); ?>
							<?php echo $form->error($modelDB,'[beneficiario]nro_identificacion'); ?>
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-6" style="padding-left: 0; margin-bottom:15px;">
							<?php echo $form->labelEx($modelDB,'[beneficiario]nombres'); ?>
							<?php echo $form->textField($modelDB,'[beneficiario]nombres',array('maxlength'=>60,'class'=>'form-control')); ?>
							<?php echo $form->error($modelDB,'[beneficiario]nombres'); ?>
						</div>
						<div class="col-lg-6" style="padding-right: 0; margin-bottom:15px;">
							<?php echo $form->labelEx($modelDB,'[beneficiario]apellidos'); ?>
							<?php echo $form->textField($modelDB,'[beneficiario]apellidos',array('maxlength'=>60,'class'=>'form-control')); ?>
							<?php echo $form->error($modelDB,'[beneficiario]apellidos'); ?>
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-6" style="padding-left: 0; margin-bottom:15px;">
							<?php echo $form->labelEx($modelDB,'[beneficiario]sexo'); ?><br>
							<?php echo $form->checkBox($modelDB,'[beneficiario]sexo',array('checked'=>'checked','class'=>'form-control' )); ?>				
							<!-- <input checked type="checkbox" id="TDatosBasicos_sexo" name="TDatosBasicos[sexo]" >	 -->
							<?php echo $form->error($modelDB,'[beneficiario]sexo'); ?>
						</div>
						<div class="col-lg-6" style="padding-right: 0; margin-bottom:15px;" >
							<label class="control-label">Fecha de Nacimiento</label>	
							<!--  data-provide="datepicker" -->
							<div id="fechaNacBeneficiario" class="input-group date">    
							    <?php echo $form->textField($modelDB,'[beneficiario]fecha_nacimiento',array('class'=>'form-control','value'=>'','placeholder'=>date('d/m/Y'))); ?>
							    <div class="input-group-addon">
							        <span class="fa fa-calendar"></span>
							    </div>
							</div>							
						</div>
					</div>


				    <div class="form-group" style="border-bottom: 1px solid #eff2f7;margin-bottom: 15px; padding-bottom: 15px;">
				    	<div class="col-lg-12" style="padding-left: 0; padding-right: 0; margin-bottom:15px;">
							<?php //echo $form->labelEx($modelParentesco,'id_parentesco',array('class'=>'control-label')); ?>
							<label for="TParentesco_id_parentesco">Parentesco</label>			
							<?php echo $form->dropDownList($modelParentesco,'id_parentesco',CHtml::listData(TParentesco::model()->findAll(),'id_parentesco','descripcion'),array('class'=>'form-control ','empty'=>'Seleccione')); ?>
				        </div>
					</div>	

					<div class="form-group">
						<button type="button" class="btn theme_button color1 pull-right" id="buttonCrearBeneficiario">Guardar</button>		
					</div>

					
				</div>

				<?php $this->endWidget(); ?>

			</div>
		</div>

		<div class="row">
            <div class="col-md-12">

				<div class="adv-table table-responsive">
					<?php $this->widget('zii.widgets.grid.CGridView', array(
						'id'=>'tbeneficiario-grid',
						'dataProvider'=>$modelBeneficiario->searchFront($idResponsable),
						'filter'=>$modelBeneficiario,
						'itemsCssClass'=>'table table-bordered table-striped table-condensed',
						'columns'=>array(
							array(	
								'name'=>'nombreBeneficiario',
								'header' =>'Nombres', 
								//'headerHtmlOptions' => array('style' => 'width: 15%'),
								'value'=>'$data->idBeneficiarioDB->nombres." ".$data->idBeneficiarioDB->apellidos'
								//'filter'=>CHtml::activeTextField($modelBeneficiario,'nombreBeneficiario')
							),	
							array(	
								'name'=>'id_parentesco',
								'header' =>'Parentesco', 
								//'headerHtmlOptions' => array('style' => 'width: 15%'),
								'value'=>'$data->idParentesco->descripcion',
								'filter'=> CHtml::listData(TParentesco::model()->findAll(),'id_parentesco','descripcion')
							),		
							array(	
								'name'=>'id_estatus',
								'header' =>'Estatus', 
								//'headerHtmlOptions' => array('style' => 'width: 10%'),
								'value'=>'TEstatus::model()->findByPk($data->id_estatus)->descripcion',
								'filter'=> CHtml::listData(TEstatus::model()->findAll(),'id_estatus','descripcion')
							),
							array(	
								'name'=>'fecha_creacion',
								'header' =>'Creación', 
								//'headerHtmlOptions' => array('style' => 'width: 18%'),
								'value'=>'date(\'d/m/Y H:i A\',strtotime($data->fecha_creacion))',
								'filter'=> true						
							),
							array(
								'class'=>'CButtonColumn',								
								'template'=>'{ver}&nbsp;{editar}&nbsp;{borrar}',
								'htmlOptions' => array('style'=>'white-space: nowrap'),
								'buttons'=>array(
								    
					                'ver' => array(
					                    'label'=>'', 
					                    'url'=>'$data->id_beneficiario',     
					                    'options'=>array('class'=>'fa fa-eye fa-lg tooltips','data-toggle'=>'tooltip','data-original-title'=>'Ver Datos'),
					                    'click'=>'function(){ return false; }',
					                    'live'=>false                         
					                ),

					                'editar' => array(
								        'label'=>'', 
								        'url'=>'"/idP/".$data->id_beneficiario',		
								        'options'=>array('class'=>'fa fa-pencil fa-lg tooltips','data-toggle'=>'tooltip','data-original-title'=>'Editar Datos'),
								        'click'=>'function(){ getCotizacionResponsable($(this).attr("href")); return false; }',
								    	'live'=>false,				          
								    ),

					                'borrar' => array(
					                    'label'=>'', 
					                    'url'=>'$data->id_beneficiario',     
					                    'options'=>array('class'=>'fa fa-trash fa-lg tooltips','data-toggle'=>'tooltip','data-original-title'=>'Eliminar Beneficiario'),
					                    'click'=>'function(){ return false; }',
					                    'live'=>false         
					                ),

								),	
							),
						),
					)); ?>
				</div>

			</div>
		</div>
	</div>
</section>