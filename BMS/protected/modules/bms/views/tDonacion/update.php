
<section id="content" class="ls section_padding_50">
    <div class="container">


        <div class="page-heading">
        <!-- <div class="row"> -->
        <!-- <div class="col-md-9"> -->
            <h3>
                Modificar Donación Postulada #<?php echo substr($modelDonacion->codigo_donacion, 2, 5); ?> creada el <?php echo date('d/m/Y H:i A',strtotime($modelDonacion->fecha_creacion)); ?>
            </h3>    
        <!-- </div> -->
        <!-- <div class="col-md-3">
            
            <button class="btn btn-primary pull-right" type="submit" id="TCotizacion_pagar_cotizacion" name="TCotizacion_pagar_cotizacion" style="background-color:#820906;margin-right:10px;"><i class="fa fa-save"></i> Pagar</button>
                            
        </div> -->

        <!-- </div> -->
        </div>

        <div class="wrapper">
		<?php 
		 $this->renderPartial('_form', array('modelDonacion'=>$modelDonacion,'modelDB'=>$modelDB,'modelRes'=>$modelRes,'modelBene'=>$modelB)); ?>
        </div>


    </div>
</section>
