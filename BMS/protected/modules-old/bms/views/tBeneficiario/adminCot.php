<?php
/* @var $this TBeneficiarioController */
/* @var $model TBeneficiario */
?>

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
	<label for="TBeneficiario_id_beneficiario">Seleccione uno o varios</label>
		      
	<?php echo $form->dropDownList($modelB,'id_beneficiario',$modelB->getLista($model->id_responsable),array('class'=>'selectpicker form-control','data-style'=>'btn-custom','empty'=>'Añadir Beneficiario')); ?>
</div>


<div style="display:none;margin:0px;" id="newDivFamiliar" class="row well">
   	<h4>Crear Beneficiario</h4>

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
		<button type="button" class="btn btn-primary pull-right" id="buttonCrearBeneficiario">Guardar</button>		
	</div>

	
</div>

<?php $this->endWidget(); ?>

<!-- <div class="adv-table"> -->
<?php 

// 	$this->widget('zii.widgets.grid.CGridView', array(
// 	'id'=>'tbeneficiario-cot-grid',
// 	'dataProvider'=>$modelB->searchCot($model->id_responsable),
// 	'filter'=>$modelB,
// 	'ajaxUpdate'=>true,
// 	'itemsCssClass'=>'table table-bordered table-striped table-condensed',
// 	'columns'=>array(
// 		array(
// 			'name'=>'idBeneficiarioDB.nombres',
// 			'header' =>'Nombres', 	
// 			'filter' => $form->textField($modelB, 'beneficiario'), 
//             'value' => '$data->idBeneficiarioDB->nombres." ".$data->idBeneficiarioDB->apellidos',
// 		),
		
// 		//'id_responsable',
// 		array(
// 			'name'=>'idParentesco.descripcion',
// 			'header' =>'Parentesco'			
// 		),
		
// 		//'id_estatus',
// 		//'fecha_creacion',
// 		array(
// 			'class'=>'CButtonColumn',								
// 			'template'=>'{borrar}&nbsp;{ver}',
// 			'buttons'=>array(
// 			    'borrar' => array(
// 			        'label'=>'', 
// 			        'url'=>'Yii::app()->createUrl("bms/TBeneficiario/delete", array("id"=>$data["id_beneficiario"]))',		
// 			        'options'=>array('id'=>'$data["id_beneficiario"]','class'=>'fa fa-trash-o fa-lg','target'=>'_blank',
// 			        'onclick'=>''),
// 			    	'live'=>false,				          
// 			    ),
// 			    'ver' => array(
// 			        'label'=>'', 
// 			        'url'=>'Yii::app()->createUrl("bms/TBeneficiario/view", array("id"=>$data["id_beneficiario"]))',		
// 			        'options'=>array('id'=>'$data["id_beneficiario"]','class'=>'fa fa-eye fa-lg','target'=>'_blank',
// 			        'onclick'=>''),
// 			    	'live'=>false,				          
// 			    )
// 			),	
// 		),
// 	),
// )); 

?>
<!-- </div> -->

<div id="historia-div"></div>	


<?php //$this->renderPartial('application.modules.bms.views.tHistoriaMedica.adminCot', array('modelHM'=>$modelHM,'modelHMC'=>$modelHMC,'modelHMM'=>$modelHMM,'model'=>$model,'modelMedico'=>$modelMedico,'modelDBMedico'=>$modelDBMedico,'modelDirMedico'=>$modelDirMedico,'modelEspecialidad'=>$modelEspecialidad)); ?>