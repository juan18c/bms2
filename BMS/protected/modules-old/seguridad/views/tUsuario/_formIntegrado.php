<?php
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'tusuario-form',
        'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'htmlOptions'=>array(
           'onsubmit'=>"return false;"
        ),
    )); 
?>

    <div class="row-fluid" >    
        <div class="row-fluid">
            <div class="span6">
                <?php //echo $form->labelEx($model,'id_tipo_identificacion'); ?>
                <?php echo $form->labelEx($modelDatos,'nro_identificacion'); ?>
                <?php echo $form->dropDownList($modelDatos,'id_tipo_identificacion',CHtml::listData(TTipoIdentificacion::model()->findAll(),'id_tipo_identificacion','abreviatura'),array('class'=>'span12','style'=>'width:20%')); ?>              
                <?php //echo $form->error($model,'id_tipo_identificacion'); ?>          
                <?php echo $form->textField($modelDatos,'nro_identificacion',array('style'=>'width:60%')); ?>
                <?php echo $form->error($modelDatos,'nro_identificacion',array('class'=>'text-error')); ?>
                
            </div>
            <div class="span6">
                <?php echo $form->labelEx($modelDatos,'nombres'); ?>
                 <?php echo $form->textField($modelDatos,'nombres',array('size'=>30,'maxlength'=>100)); ?>          
                <?php echo $form->error($modelDatos,'nombres',array('class'=>'text-error')); ?>
            </div>      
        </div>
        <div class="row-fluid">
            <div class="span6">
                <?php echo $form->labelEx($modelDatos,'apellidos'); ?>
                <?php echo $form->textField($modelDatos,'apellidos',array('size'=>30,'maxlength'=>100)); ?>
                <?php echo $form->error($modelDatos,'apellidos',array('class'=>'text-error')); ?>
            </div>  
            <div class="span6">
                <?php echo $form->labelEx($modelDatos,'telefono'); ?>
                 <?php echo $form->textField($modelDatos,'telefono',array('size'=>30,'maxlength'=>150)); ?>         
                <?php echo $form->error($modelDatos,'telefono',array('class'=>'text-error')); ?>
            </div>  
        </div>
        <div class="row-fluid">
            <div class="span">
                <?php echo $form->labelEx($modelDatos,'direccion'); ?>
                <?php echo $form->textArea($modelDatos,'direccion',array('maxlength'=>300)); ?>
                <?php echo $form->error($modelDatos,'direccion',array('class'=>'text-error')); ?>
            </div>      
        </div>
        <div class="row-fluid">
            <div class="span6"> 
                <?php echo $form->labelEx($model,'usuario'); ?>
                 <?php echo $form->textField($model,'usuario',array('size'=>40,'maxlength'=>150)); ?>        
                
                <?php echo $form->error($model,'usuario',array('class'=>'text-error')); ?>
            </div>
            <div class="span6">
                <?php echo $form->labelEx($model,'palabra_clave'); ?>
                <?php echo $form->textField($model,'palabra_clave',array('size'=>40,'maxlength'=>150)); ?>
                <?php echo $form->error($model,'palabra_clave',array('class'=>'text-error')); ?>
            </div>      
        </div>

        <div class="row-fluid">
            <div class="span6"> 
                <?php echo $form->labelEx($model,'confirmar_clave'); ?>
                 <?php echo $form->textField($model,'confirmar_clave',array('size'=>40,'maxlength'=>150)); ?>        
                
                <?php echo $form->error($model,'confirmar_clave',array('class'=>'text-error')); ?>
            </div>
            
        </div>


        <div class="row-fluid"> 
                <?php echo $form->labelEx($model,'&nbsp;'); ?>
                 <?php echo CHtml::ajaxSubmitButton('Registrar',
                                    array('/TUsuario/create'),
                                    array( 
                                        'type'=>'POST',
                                        'dataType'=>'json',
                                        'success'=>'function(data){
                                            if(data.status == "listo"){
                                                alert("Usuario registrado con exito.");
                                                
                                                /*$("#tusuario-form")[0].reset();*/

                                               /* $("#tdatos-basicos-form")[0].reset();*/
                                                $("#salir").show();
                                                window.location=data.ruta;
                                                
                                            }else{
                                                $.each(data, function(key, val) {
                                                    $("#tdatos-basicos-form #"+key+"_em_").text(val);                                                    
                                                    $("#tdatos-basicos-form #"+key+"_em_").show();
                                                    $("#tusuario-form #"+key+"_em_").text(val);                                                    
                                                    $("#tusuario-form #"+key+"_em_").show();
                                                });
                                            }
 
                                        }' 
                                ),
                         array("id"=>"login","class" => "btn btn-inverse")      
                ); ?>


        </div>    

    


 </div>     


<?php $this->endWidget(); ?>