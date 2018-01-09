<?php  
    //Yii::app()->getClientScript()->scriptMap=array('jquery.js'=>false,'jquery.min.js'=>false, 'jquery-ui.min.js'=>false,'i18nScriptFile'=>false); 
  $modelDBEmpresa=new TDatosBasicos;
?>

<!-- <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.js"></script>
common scripts for all pages
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/scripts.js"></script> -->

<?php
  $idMenu= "#menuUsuarios";
  switch ($model->id_perfil) {
    case 1:
      $titulo= "Clientes";      
      $tituloSecond= "Cliente";  
      $idSubMenu= "#subMenuCliente";
      break;
    case 2:
      $titulo= "M&eacute;dicos";      
      $tituloSecond= "M&eacute;dico";  
      $idSubMenu= "#subMenuMedico";
      break;
    case 3:
      $titulo= "Laboratorio";  
      $tituloSecond= "Laboratorio";      
      $idSubMenu= "#subMenuLaboratorio";
      break;
    case 4:
      $titulo= "Marca Comercial";   
      $tituloSecond= "Marca Comercial";     
      $idSubMenu= "#subMenuMarcaCom";
      break;
    case 5:
      $titulo= "Empleado";     
      $tituloSecond= "Empleado";   
      $idSubMenu= "#subMenuEmpleado";
      break;
    case 6:
      $titulo= "Proveedor";     
      $tituloSecond= "Proveedor";   
      $idSubMenu= "#subMenuProveedor";
      break;
    case 7:
      $titulo= "Empresa";      
      $tituloSecond= "Empresa";  
      $idSubMenu= "#subMenuEmpresa";
      break;
    default:
      $titulo= "Clientes";
      $tituloSecond= "Cliente";  
      $idSubMenu= "#subMenuCliente";
      break;
  }
  
  $indProveedor='';
  if (($model->id_perfil== 1 ) || ($model->id_perfil== 2 ) || ($model->id_perfil== 5 )){
    $indProveedor='$("#TDatosBasicos_ind_proveedor").bootstrapToggle({on: "SI",off: "NO",onstyle:"custom"});';
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

  $("body").on("submit", "#tdatos-basicos-form", function(e){
    e.preventDefault();
    var dataFormUser=$("#tdatos-basicos-form").serialize(); 
       
    $.ajax({          
      type: "POST",
      url: "'.Yii::app()->createUrl("bms/TDatosBasicos/createIntegrado/id_perfil/$model->id_perfil").'",
      data:dataFormUser,
      dataType:"json",
      success:function(data){
          if (data.salida == "OK") {
            $("#mensajeCreateIntegrado").html("<div class=\'alert alert-success fade in\' ><button type=\'button\' class=\'close close-sm\' data-dismiss=\'alert\'><i class=\'fa fa-times\'></i></button><strong>Registro Exitoso!</strong> '. $titulo .' creado.</div>");
            $("#tdatos-basicos-form")[0].reset();

          }else{
            $("#mensajeCreateIntegrado").html("<div class=\'alert alert-danger fade in\' ><button type=\'button\' class=\'close close-sm\' data-dismiss=\'alert\'><i class=\'fa fa-times\'></i></button><strong>ERROR: </strong> "+data.sms+" </div>");
          }

          $("#tdatos-basicos-grid").yiiGridView("update", { data: $(this).serialize() });
          $("#tusuario-grid").yiiGridView("update", { data: $(this).serialize() });

          return false;
          
              
          
     },
     error: function(xhr, ajaxOptions, thrownError) { // if error occured
          alert(thrownError);          
      },
   
    
    })

  })

  $("#TDatosBasicos_sexo").bootstrapToggle({
    on: "Femenino",
    off: "Masculino",
    onstyle:"custom",
    width:"150px"
  });


  '.$indProveedor.'

  $("#TDatosBasicosDireccion_indicador_factura,#TDatosBasicosDireccion_1_indicador_factura").bootstrapToggle({
    on: "SI",
    off: "NO",
    onstyle:"custom"
  });
  
  $("#TMedico_ind_modulo_cita").bootstrapToggle({
    on: "SI",
    off: "NO",
    onstyle:"custom"
  }).change(function() {
    $("#div_dia").hide();
    $("#div_tipo").hide();

    if($(this).prop("checked")){
      $("#div_dia").show();
      $("#div_tipo").show();
    }
  });

  $("#TDatosBasicosDireccion_id_pais").change(function(){

    $.ajax({          
      type: "POST",
      url: "'.Yii::app()->createUrl('catalogo/TPais/updatePaisEstadoEnvio').'",
      data:{id_pais:$(this).val()},
      dataType:"json",
      success:function(data){

        $("#TDatosBasicosDireccion_id_estado").html(""); 
        $("#TDatosBasicosDireccion_indicador_envio_div").hide(); 

        $.each(data.listado, function (key, value) {
          
          $("#TDatosBasicosDireccion_id_estado").append("<option value=\'"+value.value+"\'>" + value.descripcion + "</option>"); 
        }); 
        
        if(data.envio == "APLICA"){
          $("#TDatosBasicosDireccion_indicador_envio_div").show();
          $("#TDatosBasicosDireccion_indicador_envio").bootstrapToggle({
            on: "SI",
            off: "NO",
            onstyle:"custom"
          });
        }

        return false;          
     },
     error: function(xhr, ajaxOptions, thrownError) { // if error occured
          alert(thrownError);          
      },
   
    
  })                     
                    
  })


//   $("#TDatosBasicos_ind_empresa").bootstrapToggle({
//   on: "Si",
//   off: "No",
//   onstyle:"custom"
// });

//   $("#TDatosBasicos_ind_empresa").change(function() {
      
//     if($(this).prop("checked")){
//         $("#divEncargadoEmpresaCotizacion").show();
//         $("#divEncargadoEmpresaCotizacion #TDatosBasicos_sexo").bootstrapToggle({
//           on: "Femenino",
//           off: "Masculino",
//           onstyle:"custom",
//           width:150
//         });
//         $("#divEncargadoEmpresaCotizacion #fechaNacResponsable").datepicker({language:"es"});
//     }else 
//         $("#divEncargadoEmpresaCotizacion").hide();
// });

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
 <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'tdatos-basicos-form',
                // Please note: When you enable ajax validation, make sure the corresponding
                // controller action is handling ajax validation correctly.
                // There is a call to performAjaxValidation() commented in generated controller code.
                // See class documentation of CActiveForm for details on this.
                'enableAjaxValidation'=>true,
                //'enableClientValidation'=>true,                
                'clientOptions'=>array(
                  'errorCssClass'=>'has-error',
                ),
                'htmlOptions'=>array('role'=>'form')
              )); ?>  
  <div class="row">
    <div class="col-md-12">

      <div id="mensajeCreateIntegrado"></div>

      <section class="panel">                            
        <header class="panel-heading custom-tab ">
          <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#datos" data-toggle="tab">Datos de <?php echo $tituloSecond; ?></a>
                </li>

                <?php if ($model->id_perfil == 1 || $model->id_perfil == 2 || $model->id_perfil == 7) { ?>
                 
                <li class="">
                    <a href="#beneficiario" data-toggle="tab">Beneficiarios</a>
                </li>

                <?php } ?>

                <?php if ($model->id_perfil == 2) { ?>
                 
                <li class="">
                    <a href="#consulta" data-toggle="tab">Consultorio</a>
                </li>

                <?php } ?>
                <li class="">
                    <a href="#direccion" data-toggle="tab">Direcci&oacute;n Principal</a>
                </li>

                <?php if ($model->id_perfil !=3 && $model->id_perfil !=4 ) { ?>    
                <li class="">
                    <a href="#direccionEnvio" data-toggle="tab">Direcci&oacute;n de Env&iacute;o</a>
                </li>
                <?php } ?>                                 
            </ul>           
            <span class="tools pull-right">
              <a href="javascript:;" class="fa fa-chevron-up" style="margin-top:-23px;"></a>                    
            </span> 
        </header>
        
        <div class="panel-body">
          <div class="tab-content">
            <div class="tab-pane active" id="datos">
              
              
              <div class="col-md-6 col-lg-6"  style="border-right: 1px solid #eff2f7;">
              <input type="hidden" name="TDatosBasicos[id_perfil]" id="TDatosBasicos_id_perfil" value="<?php echo $model->id_perfil; ?>">
                <?php /*if ($model->id_perfil == 3 || $model->id_perfil== 4) { ?>
                <div class="form-group">                
                  <?php echo $form->labelEx($model,'nombres',array('class'=>'control-label')) ?>
                  <?php echo $form->dropDownList($model,'nombres',CHtml::listData(TDatosBasicos::model()->findAll('t.id_perfil = '.$model->id_perfil),'id_datos_basicos','nombres'),array('class'=>'selectpicker form-control','data-live-search'=>true)); ?>                 
                </div>
                <!-- <div class="form-group">    -->             
                  <button class="btn btn-primary pull-right" onclick="js: $('#formDatosPrincipales').show(); return false;"><i class="fa fa-plus"></i> Nuevo Proveedor</button>

                  
                  <br>
                  <br>
                <!-- </div> -->
                <?php } */?>

                <?php if ($model->id_perfil != 3 && $model->id_perfil != 4 && $model->id_perfil != 6 && $model->id_perfil != 7) { ?>
                
                
                <div class="form-group">
                  <div class="col-md-6 col-lg-6" style="padding-left: 0; margin-bottom:15px;">
                      <?php echo $form->labelEx($model,'id_tipo_identificacion'); ?>            
                      <?php echo $form->dropDownList($model,'id_tipo_identificacion',CHtml::listData(TTipoIdentificacion::model()->findAll(),'id_tipo_identificacion','descripcion'),array('class'=>'form-control')); ?>
                      <?php echo $form->error($model,'id_tipo_identificacion',array('class'=>'help-block')); ?>
                  </div>

                  <div class="col-md-6 col-lg-6" style="margin-bottom:15px;padding-right: 0;">
                      <?php echo $form->labelEx($model,'nro_identificacion'); ?>
                      <?php echo $form->textField($model,'nro_identificacion',array('maxlength'=>60,'class'=>'form-control')); ?>
                      <?php echo $form->error($model,'nro_identificacion',array('class'=>'help-block')); ?>
                  </div>                 
                </div>

                <?php  } ?>

                <?php if ($model->id_perfil == 7) { ?>
                <div  class="form-group" >
                  <?php echo $form->labelEx($modelEmpresa,'nro_empresa',array('class'=>'control-label')); ?>
                  <?php echo $form->textField($modelEmpresa,'nro_empresa',array('class'=>'form-control','type'=>'text','size'=>40,'maxlength'=>40,'placeholder'=>'ej: RIF J-12345678-0, RUC 222-323-333')); ?>
                  <?php echo $form->error($modelEmpresa,'nro_empresa',array('class'=>'help-block')); ?>
                </div>
                <?php } ?>

                <div  class="form-group" >
                  <?php echo $form->labelEx($model,'nombres',array('class'=>'control-label')); ?>
                  <?php echo $form->textField($model,'nombres',array('class'=>'form-control','type'=>'text','size'=>40,'maxlength'=>40)); ?>
                  <?php echo $form->error($model,'nombres',array('class'=>'help-block')); ?>
                </div>

                <?php if ($model->id_perfil != 3 && $model->id_perfil != 4 && $model->id_perfil != 6 && $model->id_perfil != 7) { ?>
                <div class="form-group" >
                  <?php echo $form->labelEx($model,'apellidos',array('class'=>'control-label')); ?>
                  <?php echo $form->textField($model,'apellidos',array('class'=>'form-control','type'=>'text','size'=>40,'maxlength'=>40)); ?>   
                  <?php echo $form->error($model,'apellidos',array('class'=>'help-block')); ?>                    
                </div>
                <?php } ?>

                <div class="form-group">
                  <?php echo $form->labelEx($model,'telefono_cel',array('class'=>'control-label')); ?>                      
                  <?php echo $form->textField($model,'telefono_cel',array('class'=>'form-control phone-group','type'=>'text','size'=>40,'maxlength'=>20)); ?>
                  <?php echo $form->error($model,'telefono_cel',array('class'=>'help-block')); ?> 
                </div>

                <div class="form-group">
                  <?php echo $form->labelEx($model,'email',array('class'=>'control-label')); ?>
                  <?php echo $form->textField($model,'email',array('class'=>'form-control','type'=>'usuario','size'=>40,'maxlength'=>40)); ?>
                  <?php echo $form->error($model,'email',array('class'=>'help-block')); ?>
                </div>

                <div class="form-group clearfix">
                  <?php if ($model->id_perfil!=3 && $model->id_perfil!=4 && $model->id_perfil != 6 && $model->id_perfil != 7) { ?>                    
                  <div class="col-md-6" style="padding-left:0;">
                  <?php echo $form->labelEx($model,'sexo',array('class'=>'control-label')); ?><br>
                  <?php echo $form->checkBox($model,'sexo',array('class'=>'form-control')); ?>
                  <?php echo $form->error($model,'sexo',array('class'=>'help-block')); ?>
                  </div>                  
                  <?php } ?>

                  <div class="col-md-6" style="padding-right:0;padding-left:0;">
                  <?php echo $form->labelEx($model,'id_estatus',array('class'=>'control-label')); ?>
                  <?php echo $form->dropDownList($model,'id_estatus',CHtml::listData(TEstatus::model()->findAll(),'id_estatus','descripcion'),array('class'=>'form-control')); ?>
                  <?php echo $form->error($model,'id_estatus',array('class'=>'help-block')); ?>
                  </div>
                </div>

                <?php /*if ($model->id_perfil == 3 || $model->id_perfil== 4) { ?>

                </div>
                <?php } */ ?>

              </div>

              <div class="col-md-6">

                <?php if($model->id_perfil==7) { ?>
                  
                  <input type="hidden" name="TDatosBasicos[ind_empresa]" id="TDatosBasicos_ind_empresa" value="1">
                  
                    <h4>Datos del Encargado</h4>
                    <div class="form-group">
                      <div class="col-lg-6" style="padding-left: 0; margin-bottom:15px;">
                        <?php echo $form->labelEx($modelDBEmpresa,'[empresa]id_tipo_identificacion'); ?>            
                        <?php echo $form->dropDownList($modelDBEmpresa,'[empresa]id_tipo_identificacion',CHtml::listData(TTipoIdentificacion::model()->findAll(),'id_tipo_identificacion','descripcion'),array('class'=>'form-control')); ?>
                        <?php echo $form->error($modelDBEmpresa,'[empresa]id_tipo_identificacion'); ?>
                      </div>
                      <div class="col-lg-6" style="padding-right: 0; margin-bottom:15px;">
                        <?php echo $form->labelEx($modelDBEmpresa,'[empresa]nro_identificacion'); ?>
                        <?php echo $form->textField($modelDBEmpresa,'[empresa]nro_identificacion',array('maxlength'=>60,'class'=>'form-control')); ?>
                        <?php echo $form->error($modelDBEmpresa,'[empresa]nro_identificacion'); ?>
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
                      <div class="col-lg-6" style="padding-left : 0; margin-bottom:15px;">
                        <?php echo $form->labelEx($modelDBEmpresa,'[empresa]email'); ?>
                        
                        <?php echo $form->textField($modelDBEmpresa,'[empresa]email',array('class'=>'form-control','value'=>'','placeholder'=>'ejemplo@servidor.com')); ?>
                        
                        <?php echo $form->error($modelDBEmpresa,'[empresa]email'); ?>
                      </div>
                      <div class="col-lg-6" style="padding-right: 0; margin-bottom:15px;">
                        <label class="control-label">Tel&eacute;fono Celular</label> 
                        <!--  data-provide="datepicker" -->             
                        <?php echo $form->textField($modelDBEmpresa,'[empresa]telefono_cel',array('class'=>'form-control','value'=>'','placeholder'=>'+58 412 582 1571')); ?>    
                        <?php echo $form->error($modelDBEmpresa,'[empresa]telefono_cel'); ?>
                      </div>                      
                      
                    </div>          

                  

              
                <?php } ?>

                <?php if ($model->id_perfil != 3 && $model->id_perfil != 4 && $model->id_perfil != 6) { ?>
                <div class="form-group" >
                  <?php echo $form->labelEx($model,'nota_interes',array('class'=>'control-label')); ?>                    
                  <?php echo $form->textArea($model,'nota_interes',array('class'=>'form-control','type'=>'text','size'=>40,'maxlength'=>20)); ?>                     
                </div>
                <?php } ?>


                <?php if ($model->id_perfil == 2 ) {  ?>
                                      
                <div class="form-group"> 
                  <?php echo $form->labelEx($modelMedico,'cod_matricula',array('class'=>'control-label')) ?>                  
                  <?php echo $form->textField($modelMedico,'cod_matricula',array('class'=>'form-control')); ?>                  
                </div> 

                <!-- VERIFICAR SI ESTE DATO ES UNIVERSAL O SOLO APLICA PARA VENEZUELA -->
                <!-- <div class="form-group"> 
                  <?php echo $form->labelEx($modelMedico,'rif',array('class'=>'control-label')) ?>
                  <?php echo $form->textField($modelMedico,'rif',array('class'=>'form-control')); ?>
                </div> -->

                <div class="form-group"> 
                  <?php echo $form->labelEx($modelMedico,'datos_contacto',array('class'=>'control-label')) ?>
                  <?php echo $form->textArea($modelMedico,'datos_contacto',array('class'=>'form-control')); ?>
                </div>

                                             
                <?php } ?>

                <?php if (($model->id_perfil== 1 ) || ($model->id_perfil== 2 ) || ($model->id_perfil== 5 )){   ?>

                <div class="form-group">
                  <?php echo $form->labelEx($model,'ind_proveedor',array('class'=>'control-label')); ?>                  
                  <?php echo $form->checkBox($model,'ind_proveedor',array('class'=>'form-control')); ?>
                </div>
                <?php }else{ ?>
                <input type="hidden" id="TDatosBasicos_ind_proveedor" name="TDatosBasicos_ind_proveedor" value="1">
                <?php } ?>
              </div>      
              
            </div>
                 
                    
            <div class="tab-pane" id="direccion">                      
              
              <!-- <div class="form-group">               
                <label class="control-label" for="TDatosBasicosDireccion_id_datos_basicos_direccion">Seleccione una direcci&oacute;n</label>                
                <?php echo $form->dropDownList($modelDireccion,'id_datos_basicos_direccion',CHtml::listData($modelDireccion->getLista(Yii::app()->user->id_persona),'id_datos_basicos_direccion','descripcionList'),array('class'=>'selectpicker form-control','data-style'=>'btn-custom','empty'=>'Agregar Direcci&oacute;n')); ?>
              </div> -->

              <div class="form-group"> 
                <!-- <div class="col-md-3"> 
                <?php echo $form->labelEx($modelDireccion,'nombre',array('class'=>'control-label')); ?>                
                <?php echo $form->textField($modelDireccion,'nombre',array('class'=>'form-control','style'=>'margin-bottom:15px;','readonly'=>'readonly')); ?>
                </div>  -->
                <input type="hidden" name="TDatosBasicosDireccion[nombre]" id="TDatosBasicosDireccion_nombre" value="Principal">

                <div class="col-md-4"> 
                <?php echo $form->labelEx($modelDireccion,'id_pais',array('class'=>'control-label'));?>                
                <?php echo $form->dropDownList($modelDireccion,'id_pais',CHtml::listData(TPais::model()->findAll(),'id_pais','descripcion'),array('class'=>'selectpicker form-control','data-style'=>'btn-custom','empty'=>'Seleccione...','data-live-search'=>true,'style'=>'margin-bottom:15px;')); ?>
                </div>

                <div class="col-md-4"> 
                <?php echo $form->labelEx($modelDireccion,'id_estado',array('class'=>'control-label')) ?>                
                <?php echo $form->dropDownList($modelDireccion,'id_estado',array(),array('class'=>'form-control','style'=>'margin-bottom:15px;')); ?>  
                </div>              
              
                <div class="col-md-4"> 
                <?php echo $form->labelEx($modelDireccion,'ciudad',array('class'=>'control-label')) ?>                
                <?php echo $form->textField($modelDireccion,'ciudad',array('class'=>'form-control','style'=>'margin-bottom:15px;')); ?>  
                </div>              
              </div> 

              <div class="form-group clearfix">
                <div class="col-md-2">
                <?php echo $form->labelEx($modelDireccion,'codigo_zip',array('class'=>'control-label')); ?>                  
                <?php echo $form->textField($modelDireccion,'codigo_zip',array('class'=>'form-control','type'=>'text','size'=>40,'maxlength'=>20,'style'=>'margin-bottom:15px;')); ?>                
                </div>

                <div class="col-md-2">
                <?php echo $form->labelEx($modelDireccion,'telefono_fijo',array('class'=>'control-label')); ?>                  
                <?php echo $form->textField($modelDireccion,'telefono_fijo',array('class'=>'form-control','type'=>'text','size'=>40,'maxlength'=>20,'style'=>'margin-bottom:15px;')); ?>                 
                </div>

                <div id="TDatosBasicosDireccion_indicador_envio_div" class="col-md-4" style="display: none;">
                <?php echo $form->labelEx($modelDireccion,'indicador_envio',array('class'=>'control-label')); ?><br>                              
                <?php echo $form->checkBox($modelDireccion,'indicador_envio',array('class'=>'form-control','type'=>'checkbox','style'=>'margin-bottom:15px;')); ?>      
                </div>
                <!-- <input type="hidden" id="TDatosBasicosDireccion_indicador_envio" name="TDatosBasicosDireccion[indicador_envio]" value="0"> -->
                <div class="col-md-4">               
                <?php echo $form->labelEx($modelDireccion,'indicador_factura',array('class'=>'control-label')); ?><br>
                <?php echo $form->checkBox($modelDireccion,'indicador_factura',array('class'=>'form-control','type'=>'checkbox','style'=>'margin-bottom:15px;')); ?>
                </div>
                                        
              </div>

              <div class="form-group">
                <div class="col-md-6">
                <?php echo $form->labelEx($modelDireccion,'direccion1',array('class'=>'control-label')); ?>                  
                <?php echo $form->textArea($modelDireccion,'direccion1',array('class'=>'form-control','type'=>'textarea','row'=>5)); ?>                  
                </div>

                <div class="col-md-6">
                <?php echo $form->labelEx($modelDireccion,'direccion2',array('class'=>'control-label')); ?>                
                <?php echo $form->textArea($modelDireccion,'direccion2',array('class'=>'form-control','type'=>'textarea','row'=>5)); ?>
                </div> 
              </div>

              <!-- HAY QUE COLOCAR UN BOTON CUANDO SE MODIFICA LA DIRECCION DESDE LA LISTA DE DIRECCIONES -->
              <div class="form-group col-md-12" style="display: none;">
                <hr>
                <button class="btn btn-primary pull-right" type="submit" id="TDatosBasicosDireccion_modificar" name="TDatosBasicosDireccion_modificar" style="background-color:#820906"><i class="fa fa-pencil"></i> Modificar Dirección</button>
              </div>
              
              <!-- ESTO DEBE APARECER EN EL EDITAR UN USUARIO  -->
              <div class="form-group">
                <div class="col-md-12" id="listaDireccionAdmin">               

                <?php //$this->renderPartial('application.modules.bms.views.tDatosBasicosDireccion.admin', array('model'=>$modelDireccion)); ?>
                </div>
              </div>
                         
            </div>

            <?php if ($model->id_perfil !=3 && $model->id_perfil !=4 ) { ?>           
            
            <div class="tab-pane" id="direccionEnvio">                      
              
              <!-- <div class="form-group">               
                <label class="control-label" for="TDatosBasicosDireccion_id_datos_basicos_direccion">Seleccione una direcci&oacute;n</label>                
                <?php echo $form->dropDownList($modelDireccion,'id_datos_basicos_direccion',CHtml::listData($modelDireccion->getLista(Yii::app()->user->id_persona),'id_datos_basicos_direccion','descripcionList'),array('class'=>'selectpicker form-control','data-style'=>'btn-custom','empty'=>'Agregar Direcci&oacute;n')); ?>
              </div> -->

              <div class="form-group"> 
                <!-- <div class="col-md-3"> 
                <?php echo $form->labelEx($modelDireccion,'[1]nombre',array('class'=>'control-label')); ?>                
                <?php echo $form->textField($modelDireccion,'[1]nombre',array('class'=>'form-control','style'=>'margin-bottom:15px;','value'=>'Envío','readonly'=>'readonly')); ?>
                </div>  -->
                <input type="hidden" name="TDatosBasicosDireccion[1][nombre]" id="TDatosBasicosDireccion_1_nombre" value="Envío">
                <div class="col-md-4"> 
                <?php echo $form->labelEx($modelDireccion,'[1]id_pais',array('class'=>'control-label'));?>                
                <?php echo $form->dropDownList($modelDireccion,'[1]id_pais',CHtml::listData(TEnvioPais::model()->with('idPais')->findAll(),'id_pais','idPais.descripcion'),array('class'=>'selectpicker form-control','data-style'=>'btn-custom','empty'=>'Seleccione...','data-live-search'=>true,'style'=>'margin-bottom:15px;','ajax'=>array(
                      'type'=>'POST', 
                      'url'=>Yii::app()->createUrl('catalogo/TPais/updatePaisEstado'),
                      'update'=>'#TDatosBasicosDireccion_1_id_estado', 
                      'data'=>array('id_pais'=>'js:this.value'),                  
                       
                    )
                  )); ?>
                </div>

                <div class="col-md-4"> 
                <?php echo $form->labelEx($modelDireccion,'[1]id_estado',array('class'=>'control-label')) ?>                
                <?php echo $form->dropDownList($modelDireccion,'[1]id_estado',array(),array('class'=>'form-control','style'=>'margin-bottom:15px;')); ?>  
                </div>              
              
                <div class="col-md-4"> 
                <?php echo $form->labelEx($modelDireccion,'[1]ciudad',array('class'=>'control-label')) ?>                
                <?php echo $form->textField($modelDireccion,'[1]ciudad',array('class'=>'form-control','style'=>'margin-bottom:15px;')); ?>  
                </div>              
              </div> 

              <div class="form-group clearfix">
                <div class="col-md-4">
                <?php echo $form->labelEx($modelDireccion,'[1]codigo_zip',array('class'=>'control-label')); ?>                  
                <?php echo $form->textField($modelDireccion,'[1]codigo_zip',array('class'=>'form-control','type'=>'text','size'=>40,'maxlength'=>20,'style'=>'margin-bottom:15px;')); ?>                
                </div>

                <div class="col-md-4">
                <?php echo $form->labelEx($modelDireccion,'[1]telefono_fijo',array('class'=>'control-label')); ?>                  
                <?php echo $form->textField($modelDireccion,'[1]telefono_fijo',array('class'=>'form-control','type'=>'text','size'=>40,'maxlength'=>20,'style'=>'margin-bottom:15px;')); ?>                 
                </div>

                <!-- <div id="TDatosBasicosDireccion_1_indicador_envio_div" class="col-md-2" style="display: none;" >
                <?php echo $form->labelEx($modelDireccion,'indicador_envio',array('class'=>'control-label')); ?><br>                              
                <?php echo $form->checkBox($modelDireccion,'indicador_envio',array('class'=>'form-control','type'=>'checkbox','style'=>'margin-bottom:15px;')); ?>                      
                </div> -->
                <input type="hidden" id="TDatosBasicosDireccion_1_indicador_envio" name="TDatosBasicosDireccion[1][indicador_envio]" value="1">

                <div class="col-md-4">               
                <?php echo $form->labelEx($modelDireccion,'[1]indicador_factura',array('class'=>'control-label')); ?><br>
                <?php echo $form->checkBox($modelDireccion,'[1]indicador_factura',array('class'=>'form-control','type'=>'checkbox','style'=>'margin-bottom:15px;')); ?>
                </div>
                                        
              </div>

              <div class="form-group">
                <div class="col-md-6">
                <?php echo $form->labelEx($modelDireccion,'[1]direccion1',array('class'=>'control-label')); ?>                  
                <?php echo $form->textArea($modelDireccion,'[1]direccion1',array('class'=>'form-control','type'=>'textarea','row'=>5)); ?>                  
                </div>

                <div class="col-md-6">
                <?php echo $form->labelEx($modelDireccion,'[1]direccion2',array('class'=>'control-label')); ?>                
                <?php echo $form->textArea($modelDireccion,'[1]direccion2',array('class'=>'form-control','type'=>'textarea','row'=>5)); ?>
                </div> 
              </div>

              <!-- HAY QUE COLOCAR UN BOTON CUANDO SE MODIFICA LA DIRECCION DESDE LA LISTA DE DIRECCIONES -->
              <div class="form-group col-md-12" style="display: none;">
                <hr>
                <button class="btn btn-primary pull-right" type="submit" id="TDatosBasicosDireccion_modificar" name="TDatosBasicosDireccion_modificar" style="background-color:#820906"><i class="fa fa-pencil"></i> Modificar Dirección</button>
              </div>
              
              <!-- ESTO DEBE APARECER EN EL EDITAR UN USUARIO  -->
              <div class="form-group">
                <div class="col-md-12" id="listaDireccionAdmin">               

                <?php //$this->renderPartial('application.modules.bms.views.tDatosBasicosDireccion.admin', array('model'=>$modelDireccion)); ?>
                </div>
              </div>
                         
            </div>

            <?php } ?>

            <?php if ($model->id_perfil == 2) { ?>
            <div class="tab-pane" id="consulta">
              <div class="form-group">
                  <?php echo $form->labelEx($modelMedico,'ind_modulo_cita',array('class'=>'control-label')); ?>             
                  <?php echo $form->checkBox($modelMedico,'ind_modulo_cita',array('class'=>'form-control')); ?>
                </div>

                <div class="form-group" id="div_dia" style="display:none" >
                 <?php echo CHtml::label('Seleccione los dias de consulta','',array('class'=>'control-label'));?>
                    
                    <select name="dia[]" id="dia" class="selectpicker form-control" empty="dias de consulta" data-style="btn-custom" multiple >
                      <option value"1"> Lunes</option>
                      <option value"2"> Martes</option>
                      <option value"3"> Miercoles</option>
                      <option value"4"> Jueves</option>
                      <option value"5"> Viernes</option>
                      <option value"6"> S&aacute;bado</option>
                    </select>
                   
                </div>

                <div class="form-group" id="div_tipo" style="display:none" >
                  <?php echo $form->labelEx($modelMedico,'tipo_atencion',array('class'=>'control-label')); ?>                    
                  <?php echo $form->dropDownList($modelMedico,'tipo_atencion',array('1'=>'Particular','2'=>'Corporativa'),array('class'=>'selectpicker form-control')); ?>
                </div>         
            </div>
            <?php } ?>


            <?php if ($model->id_perfil == 1 || $model->id_perfil == 2 || $model->id_perfil == 7) { ?>
            <div class="tab-pane" id="beneficiario">
              <?php 
                
                $modelCotizacion=new TCotizacion;
                $modelBeneficiario=new TBeneficiario;
                $modelDB=new TDatosBasicos;
                $modelDBMedico=new TDatosBasicos;
                $modelDirMedico=new TDatosBasicosDireccion;
                $modelEspecialidad=new TEspecialidad;
                $modelParentesco=new TParentesco;
                $modelHM=new THistoriaMedica;
                $modelHMC=new THistoriaMedicaCaso;
                $modelHMD=new THistoriaMedicaDocumento;
                $modelHMM=new THistoriaMedicaCasoMedico;

                $this->renderPartial('application.modules.bms.views.tBeneficiario.adminCot', array('modelHM'=>$modelHM,'modelHMC'=>$modelHMC,'model'=>$modelCotizacion,'modelB'=>$modelBeneficiario,'modelDB'=>$modelDB,'modelParentesco'=>$modelParentesco,'modelHMM'=>$modelHMM,'modelMedico'=>$modelMedico,'modelDBMedico'=>$modelDBMedico,'modelDirMedico'=>$modelDirMedico,'modelEspecialidad'=>$modelEspecialidad),true,false); ?>     
            </div>
            <?php } ?>

            <div class="form-group col-md-12">
              <hr>
              <button class="btn btn-primary pull-right" type="submit" style="background-color:#820906"><i class="fa fa-save"></i> Crear <?php echo $titulo; ?></button>
            </div>

          </div>
        </div>   
      </section>
    </div>
  </div>

<?php $this->endWidget(); ?>
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
                  if ($model->id_perfil == 1 || $model->id_perfil == 5 || $model->id_perfil == 7) {
                    $modelUsuario->perfil=$model->id_perfil;
                    $this->renderPartial('application.modules.seguridad.views.tUsuario.admin', array('model'=>$modelUsuario)); 
                  }else{
                    $model->id_perfil;
                    $this->renderPartial('application.modules.bms.views.tDatosBasicos.admin', array('model'=>$model)); 
                  }

              ?>
              </div>
            </div>
          </section>
      </div>
  </div>
</div>