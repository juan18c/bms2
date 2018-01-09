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
                <span style="font-size: 22px;font-weight: bold;"><?php echo '$'.$data->monto; ?></span><span style="font-size: 14px;"> Monto Recibido</span><i class="fa fa-thumbs-up" style="float:right;margin-top:12px"></i>               
              </li>
              <li class="list-group-item"> Donador<span class="badge"> <?php if ($data->publico==0) echo ucfirst(mb_strtolower(TDatosBasicos::model()->findByPk($data->id_donador)->nombres." ".TDatosBasicos::model()->findByPk($data->id_donador)->apellidos)); else echo "Anónimo"; ?></span>
              <li class="list-group-item">Fecha Donación<span class="badge"> <?php echo date( 'd-m-y',strtotime($data->fecha_creacion)) ?></span>
              </li>
              </li>
               <li class="list-group-item"><i class="fa fa-map-marker"></i> Ubicación<span class="badge"> <?php echo ucfirst(mb_strtolower(TDatosBasicosDireccion::model()->with('idPais')->findAll('id_datos_basicos='.$data->id_donador)[0]->idPais->descripcion)); ?></span>
              </li>
              
            </ul>
            
      </div>