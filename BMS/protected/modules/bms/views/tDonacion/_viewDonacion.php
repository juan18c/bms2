<?php
/* @var $this TProductoController */
/* @var $data TProducto */
?>
<?php
$totalPage= $widget->dataProvider->getItemCount();

$totalItems= $widget->dataProvider->getTotalItemCount();
//echo $this->grid->dataProvider->getTotalItemCount(); //(idepended of pagination)
?>
        <div class="col-md-3">
            <ul class="list-group">
              <li class="list-group-item">
                
                <a style="float:right;margin-left: 10px" class="fa fa-file-pdf-o fa-lg tooltips" data-toggle="tooltip" data-original-title="Ver Cotización" target="_blank" title="" href="<?php echo "/bms/index.php/bms/TCotizacion/cotizacion/idCotizacion/".$data->id_cotizacion; ?>" ></a>

                <a style="float:right;margin-left: 5px" class="fa fa-video-camera fa-lg tooltips" data-toggle="tooltip" data-original-title="Video del Caso" target="_blank" title="" href="<?php echo $data->video; ?>"></a>
                
                <span style="font-size: 32px;font-weight: bold;"><?php echo '$'.$data->monto_acumulado; ?></span><span style="font-size: 14px;"> del monto solicitado <?php echo '$'.$data->monto_solicitado; ?></span>
                
                
              </li>
              
               <li class="list-group-item"><i class="fa fa-map-marker"></i> Ubicación<span class="badge"> Venezuela</span>
              </li>
              
            </ul>
            
      </div>
