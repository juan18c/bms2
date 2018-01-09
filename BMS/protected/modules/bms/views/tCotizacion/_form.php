<?php
/* @var $this TCotizacionController */
/* @var $model TCotizacion */
/* @var $form CActiveForm */

$modelDB=new TDatosBasicos;
$modelDBD=new TDatosBasicosDireccion;
$modelDBEmpresa=new TDatosBasicos;
$modelDBDEmpresa=new TDatosBasicosDireccion;
$modelHM=new THistoriaMedica;
$modelHMC=new THistoriaMedicaCaso;
$modelHMD=new THistoriaMedicaDocumento;
$modelHMM=new THistoriaMedicaCasoMedico;
$modelB=new TBeneficiario;
$modelParentesco=new TParentesco;
$modelCar=new TCarritoDetalle('search');

$modelMedico=new TMedico;
$modelDBMedico=new TDatosBasicos;
$modelDirMedico=new TDatosBasicosDireccion;
$modelEspecialidad=new TEspecialidad;

?>



	
<div class="row">
	<div class="col-md-12">
        <section class="panel">
            <header class="panel-heading custom-tab ">
            	<ul class="nav nav-tabs">
                    <!-- <li class="active">
                        <a href="#responsable" data-toggle="tab">Responsable</a>
                    </li> -->
                    <li class="active">
                        <a href="#beneficiario" data-toggle="tab">Beneficiario</a>
                    </li>
                    <li class="">
                        <a href="#carrito" data-toggle="tab">Carrito</a>
                    </li>                    
                </ul>
                <ul class="nav nav-tabs pull-right">
                	<li>
                		<button class="btn btn-primary" type="submit" id="TCotizacion_crear_cotizacion" name="TCotizacion_crear_cotizacion" style="background-color:#820906;margin-top:-20px;margin-right:10px;"><i class="fa fa-save"></i> Guardar Cotización</button>
                	</li>
                </ul>
                
            </header>
            <div class="panel-body">
            	<div class="tab-content">
                <?php /* ?>
                   	<div class="tab-pane active" id="responsable">
		                <?php $form=$this->beginWidget('CActiveForm', array(
							'id'=>'tcotizacion-form',
							// Please note: When you enable ajax validation, make sure the corresponding
							// controller action is handling ajax validation correctly.
							// There is a call to performAjaxValidation() commented in generated controller code.
							// See class documentation of CActiveForm for details on this.
							'enableAjaxValidation'=>true,
							'htmlOptions'=>array('role'=>'form','enctype' => 'multipart/form-data')
						)); ?>  
		                                   

							<!-- <p class="note">Campos con <span class="required">*</span> con obligatorios.</p> -->

							<?php //echo $form->errorSummary($model); ?>
							<input type="hidden" name="TCotizacion[id_cotizacion]" id="TCotizacion_id_cotizacion" value="<?php echo $model->id_cotizacion; ?>">
							<input type="hidden" name="TCotizacion[id_carrito]" id="TCotizacion_id_carrito" value="<?php echo $model->id_carrito; ?>">
							<input type="hidden" name="idResponsable" id="idResponsable" value="<?php echo $model->id_responsable; ?>">

							<div class="row">
								<div class="col-md-8"  style="border-right: 1px solid #eff2f7;">
									<div class="form-group">					

										<div class="col-lg-3" style="padding-left: 0; margin-bottom:15px;">
											<?php echo $form->labelEx($modelDB,'id_tipo_identificacion'); ?>						
											<?php echo $form->dropDownList($modelDB,'id_tipo_identificacion',CHtml::listData(TTipoIdentificacion::model()->findAll(),'id_tipo_identificacion','descripcion'),array('class'=>'form-control')); ?>
											<?php echo $form->error($modelDB,'id_tipo_identificacion'); ?>
										</div>

										<div class="col-lg-3" style="margin-bottom:15px;">
											<?php echo $form->labelEx($modelDB,'nro_identificacion'); ?>
											<?php echo $form->textField($modelDB,'nro_identificacion',array('maxlength'=>60,'class'=>'form-control')); ?>
											<?php echo $form->error($modelDB,'nro_identificacion'); ?>
										</div>

										<div class="col-lg-6" style="padding-right: 0; margin-bottom:15px;" >				
											<?php echo $form->labelEx($modelDB,'email',array("class"=>"control-label")); ?>	
											<?php echo $form->textField($modelDB,'email',array('class'=>'form-control')); ?>
											<?php echo $form->error($modelDB,'email'); ?>					
										</div>	

									</div>

									<div class="form-group">
										<div class="col-lg-6" style="padding-left: 0; margin-bottom:15px;">
											<?php echo $form->labelEx($modelDB,'nombres'); ?>
											<?php echo $form->textField($modelDB,'nombres',array('maxlength'=>60,'class'=>'form-control')); ?>
											<?php echo $form->error($modelDB,'nombres'); ?>
										</div>

										<div class="col-lg-6" style="padding-right: 0; margin-bottom:15px;">
											<?php echo $form->labelEx($modelDB,'apellidos'); ?>
											<?php echo $form->textField($modelDB,'apellidos',array('maxlength'=>60,'class'=>'form-control')); ?>
											<?php echo $form->error($modelDB,'apellidos'); ?>
										</div>
									</div>

									<div class="form-group">
										<div class="col-lg-6" style="padding-left: 0; margin-bottom:15px;">
											<?php echo $form->labelEx($modelDB,'sexo'); ?><br>
											<?php echo $form->checkBox($modelDB,'sexo',array('checked'=>'checked','class'=>'form-control')); ?>
											<?php echo $form->error($modelDB,'sexo'); ?>
										</div>
										<div class="col-lg-6" style="padding-right: 0; margin-bottom:15px;">
											<?php echo $form->labelEx($modelDB,'estado_civil'); ?>
											<?php echo $form->dropDownList($modelDB,'estado_civil',array('SOLTERO'=>'Soltero(a)','CASADO'=>'Casado(a)','VIUDO'=>'Viudo(a)'),array('class'=>'form-control','empty'=>'Seleccione')); ?>
											<?php echo $form->error($modelDB,'estado_civil'); ?>
										</div>	
									</div>

									<div class="form-group">
										<div class="col-lg-6" style="padding-left: 0; margin-bottom:15px;" >
											<label class="control-label">Fecha de Nacimiento</label>	
											<!--  data-provide="datepicker" -->
											<div id="fechaNacResponsable" class="input-group date">    
											    <?php echo $form->textField($modelDB,'fecha_nacimiento',array('class'=>'form-control','value'=>'','placeholder'=>date('d/m/Y'))); ?>
											    <div class="input-group-addon">
											        <span class="fa fa-calendar"></span>
											    </div>
											</div>
										</div>
										<div class="col-lg-6" style="padding-right: 0; margin-bottom:15px;">
											<?php echo $form->labelEx($modelDB,'telefono_cel'); ?>							
											<?php echo $form->textField($modelDB,'telefono_cel',array('class'=>'form-control')); ?>
											<?php echo $form->error($modelDB,'telefono_cel'); ?>
										</div>
									</div>

									<div class="form-group">
										<div class="col-lg-6" style="padding-left: 0; margin-bottom:15px;">
											<label class="control-label">Empresa</label><br>
											<!--  data-provide="datepicker" -->
											<?php echo $form->checkBox($modelDB,'ind_empresa',array('class'=>'form-control')); ?>
										</div>

										<div class="col-lg-6" style="padding-right: 0; margin-bottom:15px;">
											<?php echo $form->labelEx($model,'id_estatus'); ?>							
											<h4 style="margin-top: 5px"><span class="label label-default">Activo</span></h4>
										</div>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">					
										<?php echo $form->labelEx($model,'duracion_tratamiento'); ?>						
										<?php echo $form->textArea($model,'duracion_tratamiento',array('class'=>'form-control','value'=>$model->duracion_tratamiento)); ?>
										<?php echo $form->error($model,'duracion_tratamiento'); ?>
									</div>

									<div class="form-group">					
										<?php echo $form->labelEx($model,'datos_envio'); ?>						
										<?php echo $form->textArea($model,'datos_envio',array('class'=>'form-control')); ?>
										<?php echo $form->error($model,'datos_envio'); ?>
									</div>

								</div>

							</div>

							<div class="row">
								<div class="col-md-8" >
									<div id="divEncargadoEmpresaCotizacion" class="row well" style="display:none;margin:0px;">
										<h4>Datos del Encargado</h4>
										<div class="form-group">
											<div class="col-lg-3" style="padding-left: 0; margin-bottom:15px;">
												<?php echo $form->labelEx($modelDBEmpresa,'[empresa]id_tipo_identificacion'); ?>						
												<?php echo $form->dropDownList($modelDBEmpresa,'[empresa]id_tipo_identificacion',CHtml::listData(TTipoIdentificacion::model()->findAll(),'id_tipo_identificacion','descripcion'),array('class'=>'form-control')); ?>
												<?php echo $form->error($modelDBEmpresa,'[empresa]id_tipo_identificacion'); ?>
											</div>
											<div class="col-lg-3" style="margin-bottom:15px;">
												<?php echo $form->labelEx($modelDBEmpresa,'[empresa]nro_identificacion'); ?>
												<?php echo $form->textField($modelDBEmpresa,'[empresa]nro_identificacion',array('maxlength'=>60,'class'=>'form-control')); ?>
												<?php echo $form->error($modelDBEmpresa,'[empresa]nro_identificacion'); ?>
											</div>

											<div class="col-lg-6" style="padding-right: 0; margin-bottom:15px;">
												<?php echo $form->labelEx($modelDBEmpresa,'[empresa]email'); ?>
												
												<?php echo $form->textField($modelDBEmpresa,'[empresa]email',array('class'=>'form-control','value'=>'','placeholder'=>'ejemplo@servidor.com')); ?>
												
												<?php echo $form->error($modelDBEmpresa,'[empresa]email'); ?>
											</div>
										</div>

										<div class="form-group">
											<div class="col-lg-6" style="padding-left: 0; margin-bottom:15px;">
												<?php echo $form->labelEx($modelDBEmpresa,'[empresa]nombres'); ?>
												<?php echo $form->textField($modelDBEmpresa,'[empresa]nombres',array('maxlength'=>60,'class'=>'form-control')); ?>
												<?php echo $form->error($modelDBEmpresa,'[empresa]nombres'); ?>
											</div>
											<div class="col-lg-6" style="padding-right: 0; margin-bottom:15px;">
												<?php echo $form->labelEx($modelDBEmpresa,'[empresa]apellidos'); ?>
												<?php echo $form->textField($modelDBEmpresa,'[empresa]apellidos',array('maxlength'=>60,'class'=>'form-control')); ?>
												<?php echo $form->error($modelDBEmpresa,'[empresa]apellidos'); ?>
											</div>
										</div>
										
										<div class="form-group">
											<div class="col-lg-6" style="padding-left: 0; margin-bottom:15px;">
												<label class="control-label">Teléfono Celular</label>	
												<!--  data-provide="datepicker" -->							
												<?php echo $form->textField($modelDBEmpresa,'[empresa]telefono_cel',array('class'=>'form-control','value'=>'','placeholder'=>'+58 412 582 1571')); ?>	   
												<?php echo $form->error($modelDBEmpresa,'[empresa]telefono_cel'); ?>
											</div>											
											
										</div>					

									</div>

								</div>
							</div>
							

							
			            
		                
		                
            		</div>
               		<?php */ ?>
                	
            		<div class="tab-pane active" id="beneficiario">
		                <?php $form=$this->beginWidget('CActiveForm', array(
							'id'=>'tcotizacion-form',
							// Please note: When you enable ajax validation, make sure the corresponding
							// controller action is handling ajax validation correctly.
							// There is a call to performAjaxValidation() commented in generated controller code.
							// See class documentation of CActiveForm for details on this.
							'enableAjaxValidation'=>true,
							'htmlOptions'=>array('role'=>'form','enctype' => 'multipart/form-data')
						)); ?>  
		                   
							<input type="hidden" name="TCotizacion[id_cotizacion]" id="TCotizacion_id_cotizacion" value="<?php echo $model->id_cotizacion; ?>">
							<input type="hidden" name="TCotizacion[id_carrito]" id="TCotizacion_id_carrito" value="<?php echo $model->id_carrito; ?>">
							<input type="hidden" name="idResponsable" id="idResponsable" value="<?php echo $model->id_responsable; ?>">

							<div class="form-group">
								<div class="col-md-6">					
								<?php echo $form->labelEx($model,'duracion_tratamiento'); ?>						
								<?php echo $form->textArea($model,'duracion_tratamiento',array('class'=>'form-control','value'=>$model->duracion_tratamiento)); ?>
								<?php echo $form->error($model,'duracion_tratamiento'); ?>
								</div>

								<div class="col-md-6">					
								<?php echo $form->labelEx($model,'datos_envio'); ?>						
								<?php echo $form->textArea($model,'datos_envio',array('class'=>'form-control')); ?>
								<?php echo $form->error($model,'datos_envio'); ?>
								</div>
							</div>
							<?php $this->endWidget(); ?>

		                    <div id="beneficiario-div">
			            	<?php	$this->widget('zii.widgets.grid.CGridView', array(
								    'id'=>'tbeneficiario-cot-grid',
								    'dataProvider'=>$modelB->searchCot($model->id_responsable),
									'filter'=>$modelB,
								    'itemsCssClass'=>'table table-bordered table-striped table-condensed',
								    'ajaxUpdate'=>true
								));
							?>
			            	</div>
		                
		            </div>

		            <div class="tab-pane" id="carrito">
		                
	                    <h3>Datos del Carrito #<?php echo $model->id_carrito; ?></h3>
	                    <div id="resumen-carrito-div">
						<?php 

							$this->widget('zii.widgets.grid.CGridView', array(
							    'id'=>'tcarrito-cotizacion-grid',
							    'dataProvider'=>$modelCar->searchCot($modelCar->id_carrito),
							    'filter'=>$modelCar,
							    'itemsCssClass'=>'table table-bordered table-striped table-condensed',
							    'ajaxUpdate'=>true
							));
						?>
						</div>
		                
            
            		</div>

            		<!-- <div class="col-lg-3" style="padding-right: 0; margin-bottom:15px;"> -->

							<br>
							<hr>
							<button class="btn btn-primary pull-right" type="submit" id="TCotizacion_crear_cotizacion" name="TCotizacion_crear_cotizacion" style="background-color:#820906"><i class="fa fa-save"></i> Guardar Cotización</button>
						<!-- </div>
            		<button class="btn btn-info finish">Guardar</button> -->

                </div>
            </div>   
    	</section>
	</div>
</div>