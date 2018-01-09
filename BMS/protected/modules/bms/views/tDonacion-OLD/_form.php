<?php
/* @var $this TDonacionController */
/* @var $model TDonacion */
/* @var $form CActiveForm */
$fotoDonacion= "http://www.placehold.it/300x300/EFEFEF/AAAAAA&amp;text=no+image";

Yii::app()->clientScript->registerScript('enviar',"
$('#enviarDatos').click(function(){
   
    $.ajax({
        type : 'POST',
        url : '".Yii::app()->createUrl("bms/TDonacion/update/id")."/'+$('#idDonacion').val(),            
        dataType:'json',      
        data: $('#tdonacionguardar-form').serialize(),
        success : function (data) {         
            alert();            

            /*$('#tcotizacion-grid').yiiGridView('update', {
                data: $(this).serialize()
            });*/
        }
    })
});

//$('#TDonacion_foto').fileinput('destroy');
      var fotoDe=$('#fotoDonacion').val();
     // alert($('#fotoDonacion').val());
      $('#TDonacion_foto').fileinput({
        initialPreview: [fotoDe],
            initialPreviewAsData: true,
            // initialPreviewConfig: [
              //   {caption: 'Moon.jpg', size: 930321, width: '120px', key: 1}
             //],
            overwriteInitial: true,
        language:'es',
        browseLabel:'Seleccionar',
        browseIcon: '<i class=\"fa fa-paperclip\"></i> ',
        showUpload: false,
        showCaption: false,
        showClose:false,
        browseClass: 'btn btn-primary',
        fileType: 'any',
            previewFileIcon: '<i class=\"glyphicon glyphicon-king\"></i>'
      });

            $('.file-preview ').attr('style','border:0px;');

//$('#TDonacion_foto').fileinput();
");
?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'tdonacionguardar-form',
		'enableAjaxValidation'=>false,
        'enableClientValidation' => true,
		'htmlOptions' => array(
        'enctype' => 'multipart/form-data'),
			)); ?>
                  
                <div id="direccionEnvioModal"></div>
                <div id="divDonacionMensaje"></div>
                <!-- <div class="alert alert-info" role="alert"><i class="glyphicon glyphicon-info-sign"></i>Campos con <b>*</b> son obligatorios</div> -->
                <div class="form-group">
                				    
                    <div class="col-xs-3">                     
                      <div class="form-group">
                            <div class="col-xs-12">
                                <label class="control-label" for="TDonacion_foto">Foto</label>                               

                                <input id="TDonacion_foto" type="file" name="TDonacion['foto']">

                                <?php                                    
                                    if ((isset($modelDonacion->foto))&&($modelDonacion->foto!=""))
                                        $fotoDonacion= Yii::app()->request->baseUrl.'/'.$modelDonacion->foto;

                                ?>
                                <input type="hidden" id="fotoDonacion" name="fotoDonacion" value="<?php echo $fotoDonacion; ?>">

                                
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
                                <label class="control-label" for="TBeneficiario_donacion_id_beneficiario">Beneficiario</label>                          
                               <?php echo $form->textField($modelDB,'[donacion]nombres',array('maxlength'=>60,'class'=>'form-control','placeholder'=>'Nombre','value'=>$modelBene->nombres.' '.$modelBene->apellidos,'readOnly'=>true)); ?>

                                <?php echo $form->error($modelDB,'[donacion]nombres'); ?>
                            </div>
                      </div>
                      
                      <div class="form-group">
                            <div class="col-xs-12">
                                <label class="control-label" for="TDonacion_monto_solicitado">Monto Solicitado</label>                          
                               <?php echo $form->textField($modelDonacion,'monto_solicitado',array('maxlength'=>60,'class'=>'form-control','placeholder'=>'$0.00','readOnly'=>true)); ?>

                                <?php echo $form->error($modelDonacion,'monto_solicitado'); ?>
                            </div>
                      </div>
                    </div>

			    	<div class="col-xs-9"> 

                        <div class="form-group">
                            <div class="col-xs-12">
                                 <?php echo $form->labelEx($modelDonacion,'nombre_caso'); ?>
                                
                  
                                <?php echo $form->textField($modelDonacion,'nombre_caso',array('maxlength'=>60,'class'=>'form-control','placeholder'=>'Ayudanos, mi hijo te necesita')); ?>

                                <?php echo $form->error($modelDonacion,'nombre_caso'); ?>
                            </div>                            
                        </div>                                             

                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="control-label" for="TDonacion_resumen">Descripcion</label>                          
                               <?php echo $form->textField($modelDonacion,'diagnostico',array('maxlength'=>60,'class'=>'form-control','placeholder'=>'Diagnósticos','style'=>'margin-bottom:8px;')); ?>
                               <?php echo $form->error($modelDonacion,'diagnostico'); ?>
                               <?php echo $form->textField($modelDonacion,'sintomas',array('maxlength'=>60,'class'=>'form-control','placeholder'=>'Síntomas','style'=>'margin-bottom:8px;')); ?>
                               <?php echo $form->error($modelDonacion,'sintomas'); ?>
                               <?php echo $form->textArea($modelDonacion,'resumen',array('maxlength'=>60,'class'=>'form-control','placeholder'=>'Resumen del Caso','style'=>'margin-bottom:8px;')); ?>
                               <?php echo $form->error($modelDonacion,'resumen'); ?>
                               <?php echo $form->textArea($modelDonacion,'objetivo',array('maxlength'=>60,'class'=>'form-control','placeholder'=>'Objetivo del Tratamiento','style'=>'margin-bottom:8px;')); ?>
                               <?php echo $form->error($modelDonacion,'objetivo'); ?>

                                
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
                        <br>
							<hr>
							<button class="btn btn-primary pull-right" type="submit" id="enviarDatos" name="enviarDatos" style="background-color:#820906"><i class="fa fa-save"></i> Guardar Donación</button>

			      	</div>
			    </div>
			    
                   


  <?php $this->endWidget(); ?>
  </div>
