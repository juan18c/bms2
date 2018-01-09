<?php
/* @var $this TProductoController */
/* @var $data TProducto */
?>
<?php
$totalPage= $widget->dataProvider->getItemCount();

$totalItems= $widget->dataProvider->getTotalItemCount();
//echo $this->grid->dataProvider->getTotalItemCount(); //(idepended of pagination)
?>


<?php if($index == 0){ ?>
<ul id="products23" class="products list-unstyled grid-view"> 
<?php } ?>
        
  <li class="product type-product">     
    <div class="side-item">    
      <!-- <div class="row">

        <div class="col-sm-4"> -->

        <div class="price-table after_cover color_bg_1 bg_teaser" ><div class="bg_overlay"></div>
                    
          <div class="plan-price"><?php echo "<span>$</span><span>".$data->monto_conciliado."</span>"; ?></div>
          <div class="features-list">
            <ul>
              <li class="enabled">
                <b style="font-size: 18px;"> <?php $id_datos=TCotizacion::model()->findByPk($data->idDonacion->id_cotizacion)->id_beneficiario; 
      echo ucfirst(mb_strtolower(TDatosBasicos::model()->findByPk($id_datos)->nombres." ".TDatosBasicos::model()->findByPk($id_datos)->apellidos)); ?></b> <br>
                <i class="fa fa-calendar"></i> <?php echo date( 'd/m/Y',strtotime($data->fecha_creacion)) ?> <br> 
                <i class="fa fa-map-marker"></i> <?php echo $data->idDonacion->idCotizacion->idCarrito->idDatosBasicosDireccion->idPais->descripcion; ?>
              </li>                
            </ul>
          </div>
                    <!-- <div class="call-to-action">
                        <a href="#" class="theme_button">Order Now</a>
                    </div> -->
        </div>

      </div>

       <!--  </div>
    </div> -->
  </li>
                
              
<?php if(($index+1) == $totalItems){ ?>
</ul>
<?php } ?>












