<!-- Modal -->
     
<div class="row">
 <div class="form">

			<?php
      $fotoPrincipal= "http://www.placehold.it/300x300/EFEFEF/AAAAAA&amp;text=no+image";
      
      $form=$this->beginWidget('CActiveForm', array(
				'id'=>'tdonacion-form',
        'enableAjaxValidation'=>false,
        'enableClientValidation' => true,
        'htmlOptions'=>array('enctype' => 'multipart/form-data')
			)); ?>

       
                    
                <div id="direccionEnvioModal"></div>
                <div id="divDonacionMensaje"></div>
                <div class="form-group">
                				    
                    <div class="col-xs-3">                     
                      <div class="form-group">
                            <div class="col-xs-12">
                               <?php echo $form->labelEx($modelDonacion,'foto'); ?>
                                <input id="TDonacion_foto" name="TDonacion[foto]" type="file" >
                                <?php 
                                  if((isset($modelDonacion->foto))&&($modelDonacion->foto!=""))
                                  $fotoPrincipal=Yii::app()->request->baseUrl.'/'.$modelDonacion->foto;          
                                ?>
                                <input type="hidden" id="foto" name="foto" value="<?php echo $fotoPrincipal; ?>">
     
                            </div> 
                      </div>
                      <div class="form-group">
                            <div class="col-xs-12">
                                <label class="control-label" for="TBeneficiario_donacion_id_beneficiario">Responsable</label>                     
                               <?php echo $form->textField($modelDB,'[donacion]nombres',array('maxlength'=>60,'class'=>'form-control','placeholder'=>'Nombre','value'=>$modelRes->nombres.' '.$modelRes->apellidos,'readOnly'=>true)); ?>

                                <?php echo $form->error($modelDB,'[donacion]nombres'); ?>
                            </div>
                      </div>
                      <div class="form-group">
                            <div class="col-xs-12">
                                <label class="control-label" for="TBeneficiario_donacion_id_beneficiario">Beneficiarioooo</label>                          
                               <?php echo $form->textField($modelDBBeneficiario,'nombres',array('maxlength'=>60,'class'=>'form-control','placeholder'=>'Nombre','value'=>$modelDBBeneficiario->nombres.' '.$modelDBBeneficiario->apellidos,'readOnly'=>true)); ?>

                                <?php echo $form->error($modelDBBeneficiario,'nombres'); ?>
                            </div>
                      </div>
                      
                      <div class="form-group">
                            <div class="col-xs-12">
                                <label class="control-label" for="TDonacion_monto_solicitado">Monto Solicitado</label>                          
                               <?php echo $form->textField($modelDonacion,'monto_solicitado',array('maxlength'=>60,'class'=>'form-control','placeholder'=>'$0.00','readOnly'=>true,'value'=>'100')); ?>

                                <?php echo $form->error($modelDonacion,'monto_solicitado'); ?>
                            </div>
                      </div>
                    </div>

			    	        <div class="col-xs-9"> 

                        <div class="form-group">
                            <div class="col-xs-12">
                                 <?php echo $form->labelEx($modelDonacion,'nombre_caso'); ?>                                
                  
                                <?php echo $form->textField($modelDonacion,'nombre_caso',array('maxlength'=>60,'class'=>'form-control','placeholder'=>'Ayudanos, mi hijo te necesita')); ?>

                                <?php echo $form->error($modelDonacion,'nombre_caso',array('class'=>'help-inline')); ?>
                            </div>                            
                        </div>                                             

                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="control-label" for="TDonacion_resumen">Descripcion</label>                          
                               <?php echo $form->textField($modelDonacion,'diagnostico',array('maxlength'=>60,'class'=>'form-control','placeholder'=>'Diagnósticos','style'=>'margin-bottom:8px;')); ?>
                               <?php echo $form->textField($modelDonacion,'sintomas',array('maxlength'=>60,'class'=>'form-control','placeholder'=>'Síntomas','style'=>'margin-bottom:8px;')); ?>
                               <?php echo $form->textArea($modelDonacion,'resumen',array('maxlength'=>60,'class'=>'form-control','placeholder'=>'Resumen del Caso','style'=>'margin-bottom:8px;')); ?>
                               <?php echo $form->textArea($modelDonacion,'objetivo',array('maxlength'=>60,'class'=>'form-control','placeholder'=>'Objetivo del Tratamiento','style'=>'margin-bottom:8px;')); ?>

                                <?php echo $form->error($modelDonacion,'diagnostico'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="control-label" for="">Cuentanos tu historia!!!</label>   

                                <ul>
                                    <li>Crea un vídeo desde de tu móvil ó cualquier dispositivo en un formato con resolución de no más de 2mb</li>
                                    <li>Súbelo a tu cuenta YouTube </li>
                                    <li>Copia el link de tu vídeo aquí <?php echo $form->textField($modelDonacion,'video',array('maxlength'=>60,'class'=>'form-control','placeholder'=>'Link del video','style'=>'margin-bottom:8px;')); ?></li>
                                    <!-- <li>Listo!!!</li> -->
                                </ul>             
                                

                                <?php echo $form->error($modelDonacion,'video'); ?>
                            </div>
                        </div>
                    <input type="hidden" id="idDonacion" name="idDonacion" value="<?php echo $modelDonacion->id_donacion; ?>">
                    <input type="hidden" id="idCotizacion" name="idCotizacion" value="<?php echo $modelCot->id_cotizacion; ?>"/>     
			      	</div>
			    </div>
         
  <?php $this->endWidget(); ?>
     </div>
  </div>