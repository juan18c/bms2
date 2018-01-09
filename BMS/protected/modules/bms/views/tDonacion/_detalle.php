
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.10";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
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
      if (confirm('Confirma que desea realizar la donación?')){

         $(this).attr('disabled','disabled');
        $.ajax({
            type : 'POST',
            url : '".Yii::app()->createUrl("bms/TDonacionAdjudicado/create/id")."/'+$('#TDonacionAdjudicado_id_donacion').val(),
            dataType:'json',
            data: $('#tdonacion-adjudicado-form').serialize(),
            success : function (data) {
                $('#enviarDonar').removeAttr('disabled');
                if (data.salida=='completo'){
                     $('#tdonacion-adjudicado-form')[0].reset();
                     $('#divDonar').html(data.mensaje).show();
                     $('#modalPagoDonacion').modal('hide');

                }else{
                    $.each(data, function(key, val) {
                        $('#tdonacion-adjudicado-form #'+key+'_em_').text(val);
                        $('#tdonacion-adjudicado-form #'+key+'_em_').show();

                    });
                    //$('#divDonarIndexMensaje').html(data.mensaje).show();
                }
            },

        })
        }
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
          <h3><?php echo $model->nombre_caso;?> </h3>
    </div>
    <div id="divDonar"></div>
    <div class="row">
    	<div class="col-md-3">
    			<img src="<?php echo $model->foto; ?>" class="img-responsive" style="min-width:100%;">
                   <?php  $this->widget('application.extensions.SocialShareButton-master.SocialShareButton', array(
              'style'=>'horizontal',
                  'networks' => array('facebook'),
                  'data_via'=>array('datos'=>$model), //twitter username (for twitter only, if exists else leave empty)
          )); ?>
      </div>


    	<div class="col-md-4">
            <ul class="list-group">
              <li class="list-group-item">
                <span style="font-size: 32px;font-weight: bold;"><?php echo '$'.$model->monto_acumulado; ?></span><span style="font-size: 14px;"> del monto solicitado <?php echo '$'.$model->monto_solicitado; ?></span>
                <div class="progress" style="margin-bottom: 5px">
                  <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $porc;?>" aria-valuemin="0" aria-valuemax="100" ><span style="font-weight:bold;"><?php echo $porc."%";?></span></div>

                </div>
                <span style="font-size: 12px;"> Acumulado de  <?php echo $cantDonadores; ?> personas en <?php $datetime1 = new DateTime($model->fecha_creacion);
                  $tiempo= TDonacion::model()->tiempoTranscurridoFechas($datetime1);
                  echo $tiempo ?>
                </span>

              </li>
          	  <li class="list-group-item bold">Fecha Creación  <span class="pull-right" style="font-weight: normal; "><?php echo date( 'd-m-Y',strtotime($model->fecha_creacion)) ?></span>
              </li>
              <li class="list-group-item bold">Responsable <span class="pull-right" style="font-weight: normal; "><?php echo $modelResp->nombres." ".$modelResp->apellidos ?></span>
              </li>
               <li class="list-group-item bold">Beneficiario <span class="pull-right" style="font-weight: normal; "><?php echo $modelB->idBeneficiarioDB->nombres." ".$modelB->idBeneficiarioDB->apellidos ?></span>
              </li>
               <li class="list-group-item bold"><i class="fa fa-child"></i> Parentesco <span class="pull-right" style="font-weight: normal; "><?php echo $modelB->idParentesco->descripcion;?></span>
              </li>
               <li class="list-group-item bold"><i class="fa fa-map-marker"></i> Ubicación<span class="pull-right" style="font-weight: normal; "><?php echo TDatosBasicosDireccion::model()->findByPk($modelCot->idCarrito->id_direccion)->idPais->descripcion; ?></span>
              </li>
              <li class="list-group-item bold"> Video del Caso
                <a style="float:right;margin-right: -192px;margin-top:-5px" class="ejemplo_4"  title="" href="<?php echo $model->video; ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/video.png" width="15%" hight="15%" class="tooltips" data-toggle="tooltip" data-original-title="Video del Caso"></a>

              </li>
                <li class="list-group-item bold">Detalle de la Cotización<a style="float:right;" class="fa fa-file-pdf-o fa-2x tooltips" data-toggle="tooltip" data-original-title="Ver Cotización" target="_blank" title="" href="<?php echo "/bms/index.php/bms/TCotizacion/update/id/".$model->id_cotizacion; ?>" ></a>
              </li>

            </ul>

          <?php if ($model->id_estatus==1){ ?>
           <div class="" style="margin: auto; width: 50%;">
      		<button class="btn btn-primary"  type="submit" id="enviarDonacion" onclick="js:$('#modalPagoDonacion').modal('show');" name="enviarDonacion" style="background-color:#820906"><i class="fa fa-money"></i> &nbsp;&nbsp;&nbsp;&nbsp;Donar &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
           </div>
           <?php } ?>
      </div>



      <div class="col-md-5">
        <ul class="nav nav-tabs" role="tablist">
          <li class="active">
          <a href="#caso" role="tab" data-toggle="tab">Detalles</a>
          </li>
          <li class="">
          <a href="#donadores" role="tab" data-toggle="tab">Donadores</a>
          </li>
          <li class="">
          <a href="#avances" role="tab" data-toggle="tab">Avances</a>
          </li>
        </ul>

        <div class="tab-content top-color-border bottommargin_30">

          <div class="tab-pane fade in active" id="caso">
            <p><span class="bold">Resumen  </span>&nbsp;&nbsp;<?php echo $model->resumen; ?></p>
            <p><span class="bold">Síntomas</span>&nbsp;&nbsp;<?php echo $model->sintomas; ?></p>
            <p><span class="bold">Diagnostico</span>&nbsp;&nbsp;<?php echo $model->diagnostico; ?></p>
            <p><span class="bold">Objetivo</span>&nbsp;&nbsp;<?php echo $model->objetivo; ?></p>

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
                    <button type="button" onclick="js:$('#tdonacion-adjudicado-form')[0].reset();" class="btn theme_button pull-right" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn theme_button color1 pull-right" id="enviarDonar"><i class="fa fa-money"></i>&nbsp;Donar</button>
                </div>
            </div>
        </div>
    </div>





  </div>
</section>
