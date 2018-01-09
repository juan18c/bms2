

<?php
$totalPage= $widget->dataProvider->getItemCount();

$totalItems= $widget->dataProvider->getTotalItemCount();
//echo $this->grid->dataProvider->getTotalItemCount(); //(idepended of pagination)
?>
<?php if($index == 0){ ?>
<ul id="products" class="grid-holder col-3 causes-grid"> 
<?php } 
?>
    <li class="grid-item cause-item format-standard">
        <div class="grid-item-inner">
          <a href="<?php echo Yii::app()->createUrl("bms/TDonacion/detalleDonacion",array('id'=>$data->id_donacion))?>" class="" > <img src="<?php echo Yii::app()->request->baseUrl.'/'.$data->foto; ?>" alt=""> </a>
          <div class="grid-content">
            <h3><?php echo $data->nombre_caso ?></h3>
            <div class="progress-label">
               <?php
               $porc=floatval($data->monto_acumulado)*100/floatval($data->monto_solicitado);
                echo $porc; ?>% Donado de <span>$ <?php echo $data->monto_solicitado ?></span> 
                <label class="cause-days-togo label label-default pull-right"><?php echo date( 'd-m-y',strtotime($data->fecha_creacion)) ?></label>              
            </div>

            <div class="progress">
              <div class="progress-bar progress-bar-success" data-appear-progress-animation="<?php echo $porc;?>%" data-appear-animation-delay="200"></div><!-- Upto 30% use class progress-bar-danger , upto 70% use class progress-bar-warning , afterwards use class progress-bar-success -->
            </div>
            <p><?php echo $data->resumen ?>...</p>
            <button type="button" class="theme_button inverse add_to_cart_button_<?php echo $data->id_donacion; ?>" onclick=" verImg(<?php echo $data->id_donacion; ?>); return false;" >
                    <i class="fa fa-thumbs-up"></i>
                    Donar
            </button>
           <!--  <a href="#" class="btn btn-default donate-paypal" data-toggle="modal" data-target="#PaymentModal">Donate Now</a>-->
          </div>
        </div>
</li>




<?php if(($index+1) == $totalItems){ ?>
</ul>
<?php } ?>

