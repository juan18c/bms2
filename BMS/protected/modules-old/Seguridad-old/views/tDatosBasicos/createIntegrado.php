<?php
    //Yii::app()->getClientScript()->scriptMap=array('jquery.js'=>false,'jquery.min.js'=>false, 'jquery-ui.min.js'=>false,'i18nScriptFile'=>false); 
?>

<!-- <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.js"></script>
common scripts for all pages
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/scripts.js"></script> -->

<?php
  $idMenu= "#menuUsuarios";
  switch ($model->id_perfil) {
    case 1:
      $titulo= "Clientes";      
      $idSubMenu= "#subMenuCliente";
      break;
    case 2:
      $titulo= "M&eacute;dicos";      
      $idSubMenu= "#subMenuMedico";
      break;
    case 3:
      $titulo= "Laboratorio";      
      $idSubMenu= "#subMenuLaboratorio";
      break;
    case 4:
      $titulo= "Marca Comercial";      
      $idSubMenu= "#subMenuMarcaCom";
      break;
    case 5:
      $titulo= "Empleado";      
      $idSubMenu= "#subMenuEmpleado";
      break;
    default:
      $titulo= "Clientes";
      $idSubMenu= "#subMenuCliente";
      break;
  }
                

  Yii::app()->clientScript->registerScript('scriptCreateIntegrado','
  

    //INICIO: ACTIVAR EL MENU DONDE ESTOY UBICADO
    var parent = $("'.$idMenu.' > a").parent();
    var sub = parent.find("> ul '.$idSubMenu.'");  
    
    visibleSubMenuClose();
    parent.addClass("nav-active");
    sub.addClass("active");
    sub.slideDown(200, function(){
        mainContentHeightAdjust();
    });
    //FIN.-


  /**
  * Validacion con una complejidad mayor
  */
  $.validator.addMethod("validacionCompleja",function(param) {
  var result = true;

   if ($("#TUsuario_palabra_clave").val() == $("#TUsuario_confirmar_clave").val())
      return true;
  else
      return false;

  }, "validacionCompleja");

  $.validator.addMethod("validaExiste",function(param) {

  //var result = true;

    $.ajax({
     dataType:"json",
     type: "GET",
     url: "'.Yii::app()->createUrl("Seguridad/TUsuario/existeEmail/email/").'"+param,
     //data:data,
      success:function(data){
          //alert(data.status);
          if(data.status=="1"){
              result= false;
          }else{
             result= true;
          } 
      },
     /*error: function(xhr, ajaxOptions, thrownError) { // if error occured
           alert(thrownError);
           //alert(data);
      },*/
   
    
    });

    return result;

  }, "validaExiste");
       

  $("#tdatos-basicos-form").stepy({

      backLabel: "Atrás",
      nextLabel: "Siguiente",
      errorImage: true,
      block: false,
      description: true,
      legend: false,
      titleClick: true,
      titleTarget: ".stepy-tab",
      validate: true

     // backLabel: "Previous",
      /*block: true,
      nextLabel: "Next",
      titleTarget: ".stepy-tab",
      errorImage: true,
      description: true,
      titleClick: true,
      legend: true,
      validate: true*/
  });

  $("#tdatos-basicos-form").validate({
      //errorPlacement: function(error, element) {
      //    $("#t_datos_basicos1 div.stepy-error").append(error);
      //},
      rules: {
          "TUsuario[confirmar_clave]" : {
              "required":true,
              "validacionCompleja" : "#TUsuario_palabra_clave",
                /*  function(element) {
                    //  alert($("#TUsuario_palabra_clave").val() +"--"+ $("#TUsuario_confirmar_clave").val());
                     varia= $("#TUsuario_palabra_clave").val() == $("#TUsuario_confirmar_clave").val();
                    alert(varia);
                    return true;
                   // alert(variable);
                    //return true;
                  },*/
                

              //function(element) { return ( $("#TUsuario[palabra_clave]").val() == $("#TUsuario[confirmar_clave]").val()) },  
              "minlength": {
                  // min needs a parameter passed to it
                  param: 6,
                },

          }, 
          "TUsuario[palabra_clave]" :{
              "required":true,
              "minlength": 6,
          }, 
          "TUsuario[usuario]":  {
                "required": true,
                "email": true,
                "validaExiste": "#TUsuario_usuario",
                /*{
                  depends: function(element) {
                   //   alert();
                    return $("#contactform_email").is(":checked");
                  }
                }*/
          },
          "TDatosBasicos[nombres]":  {
                "required": true,
          },
          "TDatosBasicos[apellidos]":  {
                "required": true,
          },
          "TDatosBasicos[telefono_cel]":  {
                "required": true,
                "digits": true,
                "minlength":5,
                "maxlength":15,
                //"require_from_group": [1, ".phone-group"],
          },
          "dia[]": {
              "required": {
                  depends: function(element) {
                      return $("#TMedico_ind_modulo_cita").is(":checked");
                  }
              } 
          }

      },
      messages: {
          "TUsuario[confirmar_clave]": {
              required: "Confirmar clave es requerido!",
              validacionCompleja : "Este campo debe ser igual a la palabra clave"
          },
          "TUsuario[palabra_clave]": {
              required: "Palabra clave es requerido!"
          },
          "TUsuario[usuario]": {
              required: "Usuario es requerido!",
              mail: "El formato del correo no es válido!",
              validaExiste:"El correo ya se encuentra registrado. Verifique su correo"
          },
          "TDatosBasicos[nombres]": {
              required: "Nombre es requerido!"
          },
          "TDatosBasicos[apellidos]": {
              required: "Apellido es requerido!"
          },
          "TDatosBasicos[telefono_cel]": {
              required: "Telefono es requerido!",
              digits: "Tiene que ser digitos",
              minlength:"Mínimo son 5 digitos",
              maxlength:"Maximo son 15 digitos"
          },
          "dia[]": "Seleccione al menos un dia",
      },



      submitHandler: function(form){
        //$("#tdatos-basicos-form").validate();

        var data=$("#tdatos-basicos-form").serialize(); 
        alert("envio");
        $.ajax({
        // dataType:"json",
         type: "POST",
         url: "'.Yii::app()->createUrl("Seguridad/tDatosBasicos/createIntegrado/id_perfil/1").'",
         data:data,
          success:function(data){
              alert(data.estatus);
             /* if(data.status=="success"){
                  alert("El usuario se registro exitosamente.");
                  $("#tusuario-form")[0].reset();
              }else{
                  $.each(data, function(key, val) {
                      alert(key+" "+val);
                  //$("#tusuario-form #"+key+"_em_").text(val);                                                    
                  //$("#tusuario-form #"+key+"_em_").show();
                  });
              } */
         },
         error: function(xhr, ajaxOptions, thrownError) { // if error occured
               alert(thrownError);
               //alert(data);
          },
       
        
        });


         /* var dataString = "name="+$("#TUsuario_email").val()+"...";
          alert(dataString);
          $.ajax({
              type: "POST",
              //url:"send.php",
              data: dataString,
              success: function(data){
                  alert("envio"+dataString);
                  //$("#ok").html(data);
                  //$("#ok").show();
                  //$("#formid").hide();
              }
          });*/
      }
  
  });

  ',CClientScript::POS_READY);

?>

<!-- page heading start-->
<div class="page-heading">
    <h3>
        Administrar <?php echo $titulo; ?>
    </h3>
    <ul class="breadcrumb">
        <li>
            <a href="#">Inicio</a>
        </li>        
        <li class="active"> <?php echo $titulo; ?> </li>
    </ul>
</div>

<div class="wrapper">
  <div class="row">
        <div class="col-sm-12">
          <section class="panel">
            <header class="panel-heading">
                <?php if ($model->id_perfil == 1) echo "Registrar Cliente"; elseif ($model->id_perfil == 2) echo "Registrar M&eacute;dico";
                elseif ($model->id_perfil == 3) echo " Registrar Laboratorio"; elseif ($model->id_perfil == 4) echo "Registrar Marca Comercial";  
                elseif ($model->id_perfil == 5) echo " Registrar Empleado";?>
                <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-up"></a>                    
                </span>
            </header>
            <div class="panel-body"  style="display:none">

                <?php if ((isset($model->id_perfil))&&($model->id_perfil !=  null )){  ?>
                    <div class="square-widget">
                       
                        <div class="widget-container">
                            <div class="stepy-tab">
                            </div>
                                <?php $form=$this->beginWidget('CActiveForm', array(
                                    'id'=>'tdatos-basicos-form',
                                    // Please note: When you enable ajax validation, make sure the corresponding
                                    // controller action is handling ajax validation correctly.
                                    // There is a call to performAjaxValidation() commented in generated controller code.
                                    // See class documentation of CActiveForm for details on this. 
                                    //'enableAjaxValidation'=>false,      
                                    'enableAjaxValidation'=>true,
                                    'enableClientValidation' => true,
                                    // 'clientOptions'=> array('validateOnSubmit'=>true,
                                 //                            'afterValidate'=>'js:function() 
                                 //                            {     
                                 //                                 return false
                                 //                            }'
                                 //    ),
                                    'htmlOptions'=>array('class'=>'form-horizontal left-align form-well','enctype' => 'multipart/form-data',
                                    ),
                                )); ?>
                                <?php echo chtml::hiddenField('id_perfil',$model->id_perfil);  ?>
                                    <!-- <form id="stepy_form" class=" form-horizontal left-align form-well">-->
                                        <?php if (($model->id_perfil != 3) && ($model->id_perfil!= 4)) {  ?>
                                        <fieldset title="Datos del Usuario"> 
                                            <legend></legend>
                                            <?php //$this->renderPartial('application.modules.Seguridad.views.tUsuario._formUsuario', array('model'=>$modelUsuario,'form'=>$form)); ?>   

                                            <div  class="form-group" >
                                                <?php echo $form->labelEx($modelUsuario,'usuario',array('class'=>'col-md-2 col-sm-2 control-label')); ?>
                                                <div class="col-md-6 col-sm-6">
                                                <?php echo $form->textField($modelUsuario,'usuario',array('class'=>'form-control','type'=>'usuario','size'=>40,'maxlength'=>40)); ?>
                                                </div>  
                                            </div>
                                            <div  class="form-group" >
                                                <?php echo $form->labelEx($modelUsuario,'palabra_clave',array('class'=>'col-md-2 col-sm-2 control-label')); ?>
                                                <div class="col-md-6 col-sm-6">
                                                <?php echo $form->textField($modelUsuario,'palabra_clave',array('class'=>'form-control','type'=>'password','size'=>40,'maxlength'=>40)); ?>
                                                </div>   
                                            </div>
                                            <div  class="form-group" >
                                                <?php echo $form->labelEx($modelUsuario,'confirmar_clave',array('class'=>'col-md-2 col-sm-2 control-label')); ?>
                                                <div class="col-md-6 col-sm-6">
                                                <?php echo $form->textField($modelUsuario,'confirmar_clave',array('class'=>'form-control','type'=>'password','size'=>40,'maxlength'=>40)); ?>
                                                </div>   
                                            </div>

                                        </fieldset>
                                        <?php } ?>
                                        <?php if ($model->id_perfil == 3 || $model->id_perfil== 4) {  ?>

                                        <?php } ?>
                                        <fieldset title="Datos Personales">
                                            <legend></legend>
                                            <?php if ($model->id_perfil == 3 || $model->id_perfil== 4) {?>
                                            <div  class="form-group" >
                                              <?php echo $form->labelEx($model,'nombres',array('class'=>'col-md-2 col-sm-2 control-label')) ?>
                                              <div class="col-md-6 col-sm-6">
                                              <?php echo $form->dropDownList($model,'nombres',CHtml::listData(TDatosBasicos::model()->findAll(),'id_datos_basicos','nombres'),array('class'=>'selectpicker','data-live-search="true"')); ?>    
                                              </div>
                                             </div>
                                             <?php }?>
                                            <div  class="form-group" >
                                                <?php echo $form->labelEx($model,'nombres',array('class'=>'col-md-2 col-sm-2 control-label')); ?>
                                                <div class="col-md-6 col-sm-6">
                                                <?php echo $form->textField($model,'nombres',array('class'=>'form-control','type'=>'text','size'=>40,'maxlength'=>40)); ?>
                                                </div>  
                                            </div>
                                            <div  class="form-group" >
                                                <?php echo $form->labelEx($model,'apellidos',array('class'=>'col-md-2 col-sm-2 control-label')); ?>
                                                <div class="col-md-6 col-sm-6">
                                                <?php echo $form->textField($model,'apellidos',array('class'=>'form-control','type'=>'text','size'=>40,'maxlength'=>40)); ?>
                                                </div>  
                                            </div>
                                            <div  class="form-group" >
                                                <?php echo $form->labelEx($model,'telefono_cel',array('class'=>'col-md-2 col-sm-2 control-label ')); ?>
                                                <div class="col-md-6 col-sm-6">
                                                <?php echo $form->textField($model,'telefono_cel',array('class'=>'form-control phone-group','type'=>'text','size'=>40,'maxlength'=>20)); ?>
                                                </div>  
                                            </div>
                                            <div  class="form-group" >
                                                <?php echo $form->labelEx($model,'nota_interes',array('class'=>'col-md-2 col-sm-2 control-label')); ?>
                                                <div class="col-md-6 col-sm-6">
                                                <?php echo $form->textField($model,'nota_interes',array('class'=>'form-control','type'=>'text','size'=>40,'maxlength'=>20)); ?>
                                                </div>  
                                            </div>
                                            <?php if (($model->id_perfil== 2 ) || ($model->id_perfil== 4 ) || ($model->id_perfil== 5 )) {  ?>
                                            <div class="form-group">
                                                    <?php echo $form->labelEx($model,'ind_proveedor',array('class'=>'col-md-2 col-sm-2 control-label')); ?> 
                                                    <div class="col-md-1 col-sm-1">                                                                                              
                                                    <?php echo $form->checkBox($model,'ind_proveedor',array('class'=>'form-control','type'=>'checkbox')); ?>
                                                    </div>                                              

                                            </div>
                                            <?php } ?>
                                        </fieldset>
                                        <fieldset title="Direcciones">
                                            <legend></legend>
                                              <div class="form-group"> 
                                              <?php //echo $form->labelEx($modelDireccion,'id_datos_basicos_direccion',array('class'=>'control-label')) ?>
                                              <label class="control-label" for="TDatosBasicosDireccion_id_datos_basicos_direccion">Seleccione una direcci&oacute;n</label>
                                              <div class="">
                                              <?php echo $form->dropDownList($modelDireccion,'id_datos_basicos_direccion',CHtml::listData($modelDireccion->getLista(Yii::app()->user->id_persona),'id_datos_basicos_direccion','descripcionList'),array('class'=>'selectpicker form-control','data-style'=>'btn-custom','empty'=>'Agregar Dirección')); ?>      
                                              </div>
                                            </div>
                                            <div class="form-group"> 
                                              <?php echo $form->labelEx($modelDireccion,'id_pais',array('class'=>'col-md-2 col-sm-2 control-label')) ?>
                                              <div class="col-md-6 col-sm-6">
                                              <?php echo $form->dropDownList($modelDireccion,'id_pais',CHtml::listData(TPais::model()->findAll(),'id_pais','descripcion'),array('class'=>'form-control')); ?>    
                                              </div>
                                            </div>
                                            <div class="form-group"> 
                                              <?php echo $form->labelEx($modelDireccion,'estado',array('class'=>'col-md-2 col-sm-2 control-label')) ?>
                                              <div class="col-md-6 col-sm-6">
                                              <?php echo $form->textField($modelDireccion,'estado',array('class'=>'form-control')); ?>   
                                              </div>
                                            </div> 
                                            <div class="form-group"> 
                                              <?php echo $form->labelEx($modelDireccion,'ciudad',array('class'=>'col-md-2 col-sm-2 control-label')) ?>
                                              <div class="col-md-6 col-sm-6">
                                              <?php echo $form->textField($modelDireccion,'ciudad',array('class'=>'form-control')); ?>   
                                              </div>
                                            </div> 
                                            <div  class="form-group" >
                                                <?php echo $form->labelEx($modelDireccion,'direccion1',array('class'=>'col-md-2 col-sm-2 control-label')); ?>
                                                <div class="col-md-6 col-sm-6">
                                                <?php echo $form->textArea($modelDireccion,'direccion1',array('class'=>'form-control','type'=>'textarea','row'=>5)); ?>
                                                </div>  
                                            </div>
                                            <div  class="form-group" >
                                                <?php echo $form->labelEx($modelDireccion,'direccion2',array('class'=>'col-md-2 col-sm-2 control-label')); ?>
                                                <div class="col-md-6 col-sm-6">
                                                <?php echo $form->textArea($modelDireccion,'direccion2',array('class'=>'form-control','type'=>'textarea','row'=>5)); ?>
                                                </div>  
                                            </div>
                                            <div  class="form-group" >
                                                <?php echo $form->labelEx($modelDireccion,'codigo_zip',array('class'=>'col-md-2 col-sm-2 control-label')); ?>
                                                <div class="col-md-6 col-sm-6">
                                                <?php echo $form->textField($modelDireccion,'codigo_zip',array('class'=>'form-control','type'=>'text','size'=>40,'maxlength'=>20)); ?>
                                                </div>  
                                            </div>
                                            <div  class="form-group" >
                                                <?php echo $form->labelEx($modelDireccion,'telefono_fijo',array('class'=>'col-md-2 col-sm-2 control-label')); ?>
                                                <div class="col-md-6 col-sm-6">
                                                <?php echo $form->textField($modelDireccion,'telefono_fijo',array('class'=>'form-control','type'=>'text','size'=>40,'maxlength'=>20)); ?>
                                                </div>  
                                            </div>
                                            <div class="form-group">
                                                    <?php echo $form->labelEx($modelDireccion,'indicador_envio',array('class'=>'col-md-2 col-sm-2 control-label')); ?> 
                                                    <div class="col-md-1 col-sm-1">                                                                                              
                                                    <?php echo $form->checkBox($modelDireccion,'indicador_envio',array('class'=>'form-control','type'=>'checkbox')); ?>
                                                    </div> 
                                                    <?php echo $form->labelEx($modelDireccion,'indicador_factura',array('class'=>'col-md-2 col-sm-2 control-label')); ?> 
                                                    <div class="col-md-1 col-sm-1">                                                                                              
                                                    <?php echo $form->checkBox($modelDireccion,'indicador_factura',array('class'=>'form-control','type'=>'checkbox')); ?>
                                                    </div>                          
                                            </div>
                                        </fieldset>
                                        <?php if ($model->id_perfil== 2 ) {  ?>
                                        <fieldset title="Datos del M&eacute;dico">
                                            <legend></legend>
                                            <div class="form-group"> 
                                              <?php echo $form->labelEx($modelMedico,'cod_matricula',array('class'=>'col-md-2 col-sm-2 control-label')) ?>
                                              <div class="col-md-6 col-sm-6">
                                              <?php echo $form->textField($modelMedico,'cod_matricula',array('class'=>'form-control')); ?>   
                                              </div>
                                            </div> 
                                            <div class="form-group"> 
                                              <?php echo $form->labelEx($modelMedico,'rif',array('class'=>'col-md-2 col-sm-2 control-label')) ?>
                                              <div class="col-md-6 col-sm-6">
                                              <?php echo $form->textField($modelMedico,'rif',array('class'=>'form-control')); ?>   
                                              </div>
                                            </div>
                                            <div class="form-group"> 
                                              <?php echo $form->labelEx($modelMedico,'datos_contacto',array('class'=>'col-md-2 col-sm-2 control-label')) ?>
                                              <div class="col-md-6 col-sm-6">
                                              <?php echo $form->textField($modelMedico,'datos_contacto',array('class'=>'form-control')); ?>   
                                              </div>
                                            </div>
                                            <div class="form-group">
                                                    <?php echo $form->labelEx($modelMedico,'ind_modulo_cita',array('class'=>'col-md-2 col-sm-2 control-label')); ?> 
                                                    <div class="col-md-1 col-sm-1">                                                                                              
                                                    <?php echo $form->checkBox($modelMedico,'ind_modulo_cita',array('class'=>'form-control','onclick'=>'js: if ( $(this).is(":checked")) {
                                                             $("#div_dia").show();
                                                             $("#div_tipo").show();
                                                    }else{   
                                                             $("#div_tipo").hide();
                                                             $("#div_dia").hide();
                                                    }')); ?>
                                                    </div>                                              

                                            </div>
                                            <div class="form-group" id="div_dia" style="display:none" >
                                             <?php echo CHtml::label('Seleccione los dias de consulta','',array('class'=>'col-md-2 col-sm-2 control-label'));?>
                                                <div class="col-md-6 col-sm-6"> 
                                                <select name="dia[]" id="dia" class="selectpicker form-control" multiple  >
                                                  <option value"1"> Lunes</option>
                                                  <option value"2"> Martes</option>
                                                  <option value"3"> Miercoles</option>
                                                  <option value"4"> Jueves</option>
                                                  <option value"5"> Viernes</option>
                                                  <option value"6"> S&aacute;bado</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group" id="div_tipo" style="display:none" >
                                                <?php echo $form->labelEx($modelMedico,'tipo_atencion',array('class'=>'col-md-2 col-sm-2 control-label')); ?>
                                                <div class="col-md-6 col-sm-6"> 
                                                    <?php echo $form->dropDownList($modelMedico,'tipo_atencion',array('1'=>'Particular','2'=>'Corporativa'),array('class'=>'selectpicker form-control')); ?>                                             
                                                </div>
                                            </div>
                                        </fieldset>
                                         <?php } ?>
                                          <?php if ($model->id_perfil== 2 ) {  ?>
                                        <fieldset title="Datos Consultorio">
                                            <legend></legend>
                                            <div class="form-group"> 
                                              <?php echo $form->labelEx($modelMedico,'cod_matricula',array('class'=>'col-md-2 col-sm-2 control-label')) ?>
                                              <div class="col-md-6 col-sm-6">
                                              <?php echo $form->textField($modelMedico,'cod_matricula',array('class'=>'form-control')); ?>   
                                              </div>
                                            </div> 
                                            <div class="form-group"> 
                                              <?php echo $form->labelEx($modelMedico,'rif',array('class'=>'col-md-2 col-sm-2 control-label')) ?>
                                              <div class="col-md-6 col-sm-6">
                                              <?php echo $form->textField($modelMedico,'rif',array('class'=>'form-control')); ?>   
                                              </div>
                                            </div>
                                            <div class="form-group"> 
                                              <?php echo $form->labelEx($modelMedico,'datos_contacto',array('class'=>'col-md-2 col-sm-2 control-label')) ?>
                                              <div class="col-md-6 col-sm-6">
                                              <?php echo $form->textField($modelMedico,'datos_contacto',array('class'=>'form-control')); ?>   
                                              </div>
                                            </div>
                                            <div class="form-group">
                                                    <?php echo $form->labelEx($modelMedico,'ind_modulo_cita',array('class'=>'col-md-2 col-sm-2 control-label')); ?> 
                                                    <div class="col-md-1 col-sm-1">                                                                                              
                                                    <?php echo $form->checkBox($modelMedico,'ind_modulo_cita',array('class'=>'form-control','onclick'=>'js: if ( $(this).is(":checked")) {
                                                             $("#div_dia").show();
                                                             $("#div_tipo").show();
                                                    }else{   
                                                             $("#div_tipo").hide();
                                                             $("#div_dia").hide();
                                                    }')); ?>
                                                    </div>                                              

                                            </div>
                                            <div class="form-group" id="div_dia" style="display:none" >
                                             <?php echo CHtml::label('Seleccione los dias de consulta','',array('class'=>'col-md-2 col-sm-2 control-label'));?>
                                                <div class="col-md-6 col-sm-6"> 
                                                <select name="dia[]" id="dia" class="selectpicker form-control" multiple  >
                                                  <option value"1"> Lunes</option>
                                                  <option value"2"> Martes</option>
                                                  <option value"3"> Miercoles</option>
                                                  <option value"4"> Jueves</option>
                                                  <option value"5"> Viernes</option>
                                                  <option value"6"> S&aacute;bado</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group" id="div_tipo" style="display:none" >
                                                <?php echo $form->labelEx($modelMedico,'tipo_atencion',array('class'=>'col-md-2 col-sm-2 control-label')); ?>
                                                <div class="col-md-6 col-sm-6"> 
                                                    <?php echo $form->dropDownList($modelMedico,'tipo_atencion',array('1'=>'Particular','2'=>'Corporativa'),array('class'=>'selectpicker form-control')); ?>                                             
                                                </div>
                                            </div>
                                        </fieldset>
                                         <?php } ?>


                                        <button type="submit" class="finish btn btn-info btn-extend"> Crear</button>
                                    <?php $this->endWidget(); ?>
                        </div>
                    </div>
                    <?php }  ?>     
            </div>
          </section>
      </div>
  </div>
</div>

<div class="wrapper">
  <div class="row">
        <div class="col-sm-12">
          <section class="panel">
            <header class="panel-heading">
                Lista de <?php echo $titulo; ?>                
            </header>
            <div class="panel-body">
              <div class="adv-table">
              <?php  
                  if ($model->id_perfil == 1) {
                    $modelUsuario->perfil=$model->id_perfil;
                    $this->renderPartial('application.modules.Seguridad.views.tUsuario.admin', array('model'=>$modelUsuario)); 
                  }else{
                    $model->id_perfil;
                    $this->renderPartial('application.modules.Seguridad.views.tDatosBasicos.admin', array('model'=>$model)); 
                  }
                  


              ?>
              </div>
            </div>
          </section>
      </div>
  </div>
</div>