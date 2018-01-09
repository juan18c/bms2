
<script type="text/javascript">

function send()
{
  var data=$("#login-form").serialize(); 
  $.ajax({
    dataType:'json',
    type: 'POST',
    url: '<?php echo Yii::app()->createAbsoluteUrl("site/login"); ?>',
    data:data,
    success:function(data){   
      if(data.status==undefined){
            $.each(data, function(key, val) {                                                               
          $("#login-form #"+key+"_em_").text(val);
          $("#login-form #"+key+"_em_").show();
            });                                                         
      }else{
        window.location=data.status;
      } 
    },
    error: function(data) { // if error occured
      alert("Error: Ingreso al sistema fallido. Contacte al Administrador del Sistema."+data);      
    },  
  }); 
}

function recuperar()
{ 
  var data=$("#recuperar-form").serialize(); 
  $.ajax({
    dataType:'json',
    type: 'POST',
    url: '<?php echo Yii::app()->createAbsoluteUrl("site/recuperar"); ?>',
    data:data,
    success:function(data){

      if(data.status=="recuperado"){
        alert("Su clave fue enviada exitosamente a su correo.");
        $("#recuperar-form")[0].reset();
      }else{
        $.each(data, function(key, val) {
          $("#recuperar-form #"+key+"_em_").text(val);
          $("#recuperar-form #"+key+"_em_").show();
        });
      }
    },
    error: function(data) { // if error occured
      alert("Error ajax login");    
    },
  }) 
}

function crear()
{  
  var data=$("#tusuario-form").serialize(); 
  $.ajax({
    dataType:'json',
    type: 'POST',
    url: '<?php echo Yii::app()->createAbsoluteUrl("site/index"); ?>',
    data:data,
    success:function(data){
      if(data.status=="success"){
        alert("El usuario se registro exitosamente.");
        $("#tusuario-form")[0].reset();
        $("#registro").hide();
        $.each(data, function(key, val) {          
          $("#tusuario-form #"+key+"_em_").hide();
        });
      }else{
        $.each(data, function(key, val) {
          $("#tusuario-form #"+key+"_em_").text(val);
          $("#tusuario-form #"+key+"_em_").show();
        });
      } 
    },
    error: function(data) { // if error occured
      alert("Error ajax login");    
    },
  })
}
</script>
<br>
<div class="col-lg-4">
  <div class="well well-lg" style="background:#820906;color:#FFF">     
    <p>
      <strong style="color:#FFFFFF">Ya tienes cuenta?, ingresa aqui:</strong>
    </p>
    <?php $form=$this->beginWidget('CActiveForm', array(
      'id'=>'login-form',
      'enableAjaxValidation'=>false,
      'enableClientValidation'=>true,
      'htmlOptions'=>array(
             'onsubmit'=>"return false;",/* Disable normal form submit */
             'onkeypress'=>" if(event.keyCode == 13){ send(); } " /* Do ajax call when user presses enter key */
           ),
    ));
    ?>

      
      <div  class="form-group" >
          <?php echo $form->labelEx($model,'username',array('style'=>'color:#FFF')) ?>
          <?php echo $form->textField($model,'username',array('class'=>'form-control','maxlength'=>60)); ?>
          <?php echo $form->error($model,'username',array('class'=>'errorMessage')); ?>
      </div> 
      <div class="form-group">
          <?php echo $form->labelEx($model,'password',array('style'=>'color:#FFF')); ?>
          <?php echo $form->passwordField($model,'password',array('class'=>'form-control','maxlength'=>60)); ?>
          <?php echo $form->error($model,'password',array('class'=>'errorMessage','style'=>'padding-bottom:2px;')); ?>
      </div>                        
      <?php echo CHtml::Button('Login',array('onclick'=>'send();','class'=>'theme_button color2')); ?>

      <!-- <a href="register-right.html" class="theme_button color2">Registro</a>-->
               
    <?php $this->endWidget(); ?>

    <div class="greylinks topmargin_20" style="color:#FFFFF">
        <a href="register-right.html">Olvidaste tus datos?</a>
    </div>
  </div>
</div>

<div class="col-lg-8">
  <?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'tusuario-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'htmlOptions'=>array(
      'onsubmit'=>"return false;",/* Disable normal form submit */
      'onkeypress'=>" if(event.keyCode == 13){ crear(); } " /* Do ajax call when user presses enter key */
    ),
  )); 


  ?>
    <?php if(isset($_GET['idDonacion'])) { ?>  
      <input type="hidden" name="origen" id="origen" value="<?php echo $_GET['idDonacion'] ?> ">
     <?php } 
    ?>
    <div class="col-sm-6">
      <div  class="form-group" >
        <?php echo $form->labelEx($modelDB,'nombres',array('class'=>'grey','style'=>'font-weight: bold;')) ?>
         <?php echo $form->error($modelDB,'nombres',array('class'=>'errorMessage')); ?>
        <?php echo $form->textField($modelDB,'nombres',array('class'=>'form-control','maxlength'=>60)); ?>
       
      </div> 

      <div class="form-group" >
        <?php echo $form->labelEx($modelUsuario,'usuario',array('class'=>'grey','style'=>'font-weight: bold;')) ?>
        <?php echo $form->error($modelUsuario,'usuario',array('class'=>'errorMessage')); ?>  
        <?php echo $form->textField($modelUsuario,'usuario',array('class'=>'form-control','maxlength'=>60)); ?>
                
      </div>
    </div>

    <div class="col-sm-6">                        
      <div class="form-group" >
        <?php echo $form->labelEx($modelDB,'apellidos',array('class'=>'grey','style'=>'font-weight: bold;')) ?>
        <?php echo $form->error($modelDB,'apellidos',array('class'=>'errorMessage')); ?>
        <?php echo $form->textField($modelDB,'apellidos',array('class'=>'form-control','maxlength'=>60)); ?>
        
      </div>

      <div class="form-group" >
        <?php echo $form->labelEx($modelDB,'nro_identificacion',array('class'=>'grey','style'=>'font-weight: bold;')) ?>
          <?php echo $form->error($modelDB,'nro_identificacion',array('class'=>'errorMessage'));
         ?>
        <?php echo $form->textField($modelDB,'nro_identificacion',array('class'=>'form-control','maxlength'=>60)); ?>
      
      </div>
    </div>                    

    <div class="col-sm-6">
      <div class="form-group" > 
        <?php echo $form->labelEx($modelDireccion,'id_pais',array('class'=>'grey','style'=>'font-weight: bold;')) ?>   
        <?php echo $form->error($modelDireccion,'id_pais',array('class'=>'errorMessage')); ?>                  
        <?php echo $form->dropDownList($modelDireccion,'id_pais',CHtml::listData(TPais::model()->findAll(),'id_pais','descripcion'),array('class'=>'selectpicker form-control','empty'=>'Seleccione...','data-live-search'=>true,'style'=>'margin-bottom:15px;','ajax'=>array(
            'type'=>'POST', 
            'url'=>Yii::app()->createUrl('catalogo/TPais/updatePaisEstado'),
            'update'=>'#TDatosBasicosDireccion_id_estado', 
            'data'=>array('id_pais'=>'js:this.value')             
          )
        )); ?>   
        
      </div> 
     
      <div class="form-group" >       
        <?php echo $form->labelEx($modelUsuario,'palabra_clave',array('class'=>'grey','style'=>'font-weight: bold;')) ?>
        <?php echo $form->error($modelUsuario,'palabra_clave',array('class'=>'errorMessage')); ?>
        <?php echo $form->textField($modelUsuario,'palabra_clave',array('class'=>'form-control','maxlength'=>60)); ?>       
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <?php echo $form->labelEx($modelDireccion,'id_estado',array('class'=>'grey','style'=>'font-weight: bold;')) ?>  
        <?php echo $form->dropDownList($modelDireccion,'id_estado',array(),array('class'=>'form-control')); ?>
        <?php echo $form->error($modelDireccion,'id_estado',array('class'=>'errorMessage')); ?>
      </div>

      <div class="form-group" id="billing_password2_field">
        <?php echo $form->labelEx($modelUsuario,'confirmar_clave',array('class'=>'grey','style'=>'font-weight: bold;')) ?>
        <?php echo $form->error($modelUsuario,'confirmar_clave',array('class'=>'errorMessage')); ?>
        <?php echo $form->textField($modelUsuario,'confirmar_clave',array('class'=>'form-control','maxlength'=>60)); ?>
        
       </div>    
    </div>

    <div class="col-sm-12">                       
      <div class="form-group" >
        <?php echo $form->labelEx($modelDB,'telefono_cel',array('class'=>'grey','style'=>'font-weight: bold;')) ?>
        <?php echo $form->error($modelDB,'telefono_cel',array('class'=>'errorMessage')); ?>
        <?php echo $form->textField($modelDB,'telefono_cel',array('class'=>'form-control','maxlength'=>60)); ?>
        
      </div>
    </div>

    <div class="col-sm-12">
      <?php // echo CHtml::Button('Register',array('onclick'=>'crear();','class'=>'theme_button color1')); ?>
      <?php echo CHtml::Button('Register',array('onclick'=>'js:crear()','class'=>'theme_button color1')); ?>
      <?php echo CHtml::resetButton('Clear',array('class'=>'theme_button color2')); ?>
    </div>

  
  <?php $this->endWidget(); ?>
</div>