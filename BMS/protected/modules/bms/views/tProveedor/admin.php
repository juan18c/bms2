<?php
/* @var $this TProveedorController */
/* @var $model TProveedor */
Yii::app()->clientScript->registerScript('scriptAdminProveedor','
  

    //INICIO: ACTIVAR EL MENU DONDE ESTOY UBICADO
    var parent = $("#menuUsuarios > a").parent();
    var sub = parent.find("> ul #subMenuProveedor");  
    
    visibleSubMenuClose();
    parent.addClass("nav-active");
    sub.addClass("active");
    sub.slideDown(200, function(){
        mainContentHeightAdjust();
    });
    //FIN.-

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



  $("#TDatosBasicosDireccion_indicador_factura").bootstrapToggle({
    on: "SI",
    off: "NO",
    onstyle:"custom"
  });


  $("body").on("submit", "#tdatos-basicos-form", function(e){
    e.preventDefault();
    var dataFormUser=$("#tdatos-basicos-form").serialize(); 
       
    $.ajax({          
      type: "POST",
      url: "'.Yii::app()->createUrl("bms/TDatosBasicos/createIntegrado/id_perfil/$modelDB->id_perfil").'",
      data:dataFormUser,
      dataType:"json",
      success:function(data){
          if (data.salida == "OK") {
            $("#mensajeCreateIntegrado").html("<div class=\'alert alert-success fade in\' ><button type=\'button\' class=\'close close-sm\' data-dismiss=\'alert\'><i class=\'fa fa-times\'></i></button><strong>Registro Exitoso!</strong> Proveedor creado.</div>");
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


',CClientScript::POS_READY);


?>
<!-- page heading start-->
<div class="page-heading">
    <h3>
        Administrar Proveedores
    </h3>
    <ul class="breadcrumb">
        <li>
            <a href="#">Inicio</a>
        </li>        
        <li class="active"> Proveedores </li>
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
                    <a href="#datos" data-toggle="tab">Datos</a>
                </li>                
                <li class="">
                    <a href="#direccion" data-toggle="tab">Direcci&oacute;n Principal</a>
                </li>                                        
            </ul>           
            <span class="tools pull-right">
              <a href="javascript:;" class="fa fa-chevron-up" style="margin-top:-23px;"></a>                    
            </span> 
        </header>
        
        <div class="panel-body">
          <div class="tab-content">
            <div class="tab-pane active" id="datos">
                            
              <div class="col-md-6 col-lg-6"  style="border-right: 1px solid #eff2f7;">
              <input type="hidden" name="TDatosBasicos[id_perfil]" id="TDatosBasicos_id_perfil" value="<?php echo $modelDB->id_perfil; ?>">
                
                <div  class="form-group" >
                  <?php echo $form->labelEx($modelDB,'nombres',array('class'=>'control-label')); ?>
                  <?php echo $form->textField($modelDB,'nombres',array('class'=>'form-control','type'=>'text','size'=>40,'maxlength'=>40)); ?>
                  <?php echo $form->error($modelDB,'nombres',array('class'=>'help-block')); ?>                  
                </div>

                <div class="form-group">
                  <?php echo $form->labelEx($model,'persona_contacto',array('class'=>'control-label')); ?>
                  <?php echo $form->textField($model,'persona_contacto',array('class'=>'form-control phone-group','type'=>'text','size'=>40,'maxlength'=>250)); ?>
                  <?php echo $form->error($model,'persona_contacto',array('class'=>'help-block')); ?> 
                </div>

                <div class="form-group">
                  <?php echo $form->labelEx($model,'telefono_cel',array('class'=>'control-label')); ?>
                  <?php echo $form->textField($modelDB,'telefono_cel',array('class'=>'form-control phone-group','type'=>'text','size'=>40,'maxlength'=>20)); ?>
                  <?php echo $form->error($modelDB,'telefono_cel',array('class'=>'help-block')); ?> 
                </div>

                <div class="form-group">
                  <?php echo $form->labelEx($modelDB,'email',array('class'=>'control-label')); ?>
                  <?php echo $form->textField($modelDB,'email',array('class'=>'form-control','type'=>'usuario','size'=>40,'maxlength'=>40)); ?>
                  <?php echo $form->error($modelDB,'email',array('class'=>'help-block')); ?>
                </div>

                <div class="form-group clearfix">                  

                  <div class="col-md-6" style="padding-right:0;padding-left:0;">
                  <?php echo $form->labelEx($modelDB,'id_estatus',array('class'=>'control-label')); ?>
                  <?php echo $form->dropDownList($modelDB,'id_estatus',CHtml::listData(TEstatus::model()->findAll(),'id_estatus','descripcion'),array('class'=>'form-control')); ?>
                  <?php echo $form->error($modelDB,'id_estatus',array('class'=>'help-block')); ?>
                  </div>
                </div>               

              </div>                            
            </div>
                 
                    
            <div class="tab-pane" id="direccion">              
             
              <div class="form-group">                
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

              
            </div>

            <div class="form-group col-md-12">
              <hr>
              <button class="btn btn-primary pull-right" type="submit" style="background-color:#820906"><i class="fa fa-save"></i> Crear Proveedor</button>
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
		            Proveedores
		            <span class="tools pull-right">		            	
		                <a href="javascript:;" class="fa fa-chevron-down"></a>		                
		            </span>
		        </header>
		        <div class="panel-body">					

			        <div class="adv-table">

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tproveedor-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'itemsCssClass'=>'table table-bordered table-striped table-condensed',
	'columns'=>array(
		'id_proveedor',
		'id_datos_basicos',
		'persona_contacto',
		'id_estatus',
		'fecha_creacion',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>
		        </div>
	        </section>
    	</div>
	</div>
</div>