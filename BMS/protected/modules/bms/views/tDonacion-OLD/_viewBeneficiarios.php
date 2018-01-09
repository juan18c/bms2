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
        <span style="font-size: 22px;font-weight: bold;"><?php echo '$'.$data->monto; ?></span><span style="font-size: 14px;"> Monto Donado</span><i class="fa fa-share-square-o" style="float:right;margin-top:12px"></i>               
      </li>
      <li class="list-group-item"> Beneficia<span class="badge"> <?php $id_datos=TCotizacion::model()->findByPk($data->idDonacion->id_cotizacion)->id_beneficiario; 
      echo ucfirst(mb_strtolower(TDatosBasicos::model()->findByPk($id_datos)->nombres." ".TDatosBasicos::model()->findByPk($id_datos)->apellidos)); ?></span>
      <li class="list-group-item">Fecha Donación<span class="badge"> <?php echo date( 'd-m-y',strtotime($data->fecha_creacion)) ?></span>
      </li>
      </li>      
    </ul>    
</div>
