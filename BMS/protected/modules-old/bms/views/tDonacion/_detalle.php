 <?php 

 Yii::app()->clientScript->registerScript('enviarDonaciones',"

    $('.ejemplo_4').fancybox({
      'autoScale'     : false,
      'transitionIn'    : 'none',
      'transitionOut'   : 'none',
      'width'       : 680,
      'height'      : 450,
      'type'        : 'iframe'
    });

    $('#enviarDonar').click(function(){
        $.ajax({
            type : 'POST',
            url : '".Yii::app()->createUrl("bms/TDonacionAdjudicado/create/id")."/'+$('#TDonacionAdjudicado_id_donacion').val(),            
            dataType:'json',      
            data: $('#tdonacion-adjudicado-form').serialize(),
            success : function (data) {         
                if (data.salida=='completo'){
                     $('#divDonar').html(data.mensaje).show();
                     $('#modalPagoDonacion').modal('hide'); 
                     
                }else{
                    $.each(data, function(key, val) { 
                        $('#tdonacion-adjudicado-form #'+key+'_em_').text(val);                                                    
                        $('#tdonacion-adjudicado-form #'+key+'_em_').show();
                        
                    });
                    //$('#divDonarIndexMensaje').html(data.mensaje).show();  
                }   
            }
        })
    });


    $('.progress-bar').each(function() {
        var bar_value = $(this).attr('aria-valuenow') + '%';                
        $(this).animate({ width: bar_value }, { duration: 2000, easing: 'easeOutCirc' });
    });

");

 $porc=intval(floatval($model->monto_acumulado)*100/floatval($model->monto_solicitado));
 $cantDonadores=TDonacionAdjudicado::model()->count('id_donacion='.$model->id_donacion.' and id_estatus=3');
 if (is_null($cantDonadores))
  $cantDonadores=0;
?>
<section id="content" class="ls section_padding_50">
  <div class="container">
    <div class="page-heading">
          <h3><?php echo $model->nombre_caso;?></h3>
    </div>
    <div id="divDonar"></div>
    <div class="row">
    	<div class="col-md-8">
    			<img src="<?php echo $model->foto; ?>" class="img-responsive">
      </div>
    	<div class="col-md-4">
            <ul class="list-group">
              <li class="list-group-item">
              	
                <a style="float:right;margin-left: 10px" class="fa fa-file-pdf-o fa-lg tooltips" data-toggle="tooltip" data-original-title="Ver Cotización" target="_blank" title="" href="<?php echo "/bms/index.php/bms/TCotizacion/update/id/".$model->id_cotizacion; ?>" ></a>

                <a style="float:right;margin-left: 5px" class="ejemplo_4 fa fa-video-camera fa-lg tooltips" data-toggle="tooltip" data-original-title="Video del Caso" title="" href="<?php echo $model->video; ?>"></a>
                
                <span style="font-size: 32px;font-weight: bold;"><?php echo '$'.$model->monto_acumulado; ?></span><span style="font-size: 14px;"> del monto solicitado <?php echo '$'.$model->monto_solicitado; ?></span>
                <div class="progress" style="margin-bottom: 5px">
                  <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $porc;?>" aria-valuemin="0" aria-valuemax="100" ><span><?php echo $porc."%";?></span></div>

                </div>
                <span style="font-size: 12px;"> Acumulado de  <?php echo $cantDonadores; ?> personas en <?php $datetime1 = new DateTime($model->fecha_creacion);
                  $tiempo= TDonacion::model()->tiempoTranscurridoFechas($datetime1);
                  echo $tiempo ?>
                </span>
              </li>
          	  <li class="list-group-item">Responsable <span class="badge"><?php echo $modelResp->nombres." ".$modelResp->apellidos ?></span>
              </li>
               <li class="list-group-item">Beneficiario <span class="badge"><?php echo $modelB->idBeneficiarioDB->nombres." ".$modelB->idBeneficiarioDB->apellidos ?></span>
              </li>
               <li class="list-group-item"><i class="fa fa-child"></i> Parentesco <span class="badge"><?php echo $modelB->idParentesco->descripcion;?></span>
              </li>
               <li class="list-group-item"><i class="fa fa-map-marker"></i> Ubicación<span class="badge"><?php echo TDatosBasicosDireccion::model()->findByPk($modelCot->idCarrito->id_direccion)->idPais->descripcion; ?></span>
              </li>
              
            </ul>
            <button class="btn btn-primary pull-right" type="button" id="compartir" onClick="window.open('https://www.facebook.com/sharer/sharer.php?u=http://www.biometabolicservice.com/index.php/bms/TDonacion/detalleDonacion/id/5')" name="compartir" style="background-color:#337ab7" target="_blank"><img src="https://lh3.googleusercontent.com/-H8xMuAxM-bE/UefWwJr2vwI/AAAAAAAAEdY/N5I41q19KMk/s32-no/facebook.png" width="20px" height="20px"> Compartir</button>

          <?php if ($model->id_estatus==1){ ?>   
      		<button class="btn btn-primary pull-right" type="submit" id="enviarDonacion" onclick="js:$('#modalPagoDonacion').modal('show');" name="enviarDonacion" style="background-color:#820906"><i class="fa fa-save"></i> Donar Ahora</button>
           <?php } ?>   
      </div> 
      


      <div class="col-md-12">
        <ul class="nav nav-tabs" role="tablist">                    
          <li class="active">
          <a href="#caso" role="tab" data-toggle="tab">Descripcion del Caso</a>
          </li>
          <li class="">
          <a href="#donadores" role="tab" data-toggle="tab">Listado de Donadores</a>
          </li>
          <li class="">
          <a href="#avances" role="tab" data-toggle="tab">Listado de Avances del Caso</a>
          </li>                    
        </ul>

        <div class="tab-content top-color-border bottommargin_30">

          <div class="tab-pane fade in active" id="caso">
            <p><span class="badge accent-bg">Resumen  </span>&nbsp;&nbsp;<?php echo $model->resumen; ?></p>
            <p><span class="badge accent-bg">Síntomas</span>&nbsp;&nbsp;<?php echo $model->sintomas; ?></p>
            <p><span class="badge accent-bg">Diagnostico</span>&nbsp;&nbsp;<?php echo $model->diagnostico; ?></p>
            <p><span class="badge accent-bg">Objetivo</span>&nbsp;&nbsp;<?php echo $model->objetivo; ?></p> 

          </div>

          <div class="tab-pane fade" id="donadores">
            <?php  $modelAd= new TDonacionAdjudicado();
                  $modelAd->id_donacion=$model->id_donacion;
                  $this->renderPartial('application.modules.bms.views.tDonacionAdjudicado.admin', array('model'=>$modelAd,'idDonacion'=>$model->id_donacion)); ?>
          


          </div>

          <div class="tab-pane fade" id="avances">

         ddd

          </div>      

        </div>

      </div>
                
    </div>



    <div class="modal fade  bs-example-modal" id="modalPagoDonacion" tabindex="-1" role="dialog" aria-labelledby="modalPagoDonacionLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modalPagoCotLabel">Donar al Caso</h4>
                </div>
                <div class="modal-body">
                
                    <?php  $modelAd= new TDonacionAdjudicado();
                        $this->renderPartial('application.modules.bms.views.tDonacionAdjudicado._form', array('model'=>$modelAd,'modelCaso'=>$model)); ?>

                

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn theme_button pull-right" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn theme_button color1 pull-right" id="enviarDonar"><i class="fa fa-money"></i>&nbsp;Donar</button>
                </div>
            </div>
        </div>
    </div>




    
  </div>
</section>

