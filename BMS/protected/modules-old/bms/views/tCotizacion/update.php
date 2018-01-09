<?php
/* @var $this TCotizacionController */
/* @var $model TCotizacion */
?>
<section id="content" class="ls section_padding_50">
    <div class="container">


        <div class="page-heading">
        <!-- <div class="row"> -->
        <!-- <div class="col-md-9"> -->
            <h3>
                Modificar Cotización #<?php echo substr($model->codigo_cotizacion, 2, 5); ?> creada el <?php echo date('d/m/Y H:i A',strtotime($model->fecha_creacion)); ?>
            </h3>    
        <!-- </div> -->
        <!-- <div class="col-md-3">
            
            <button class="btn btn-primary pull-right" type="submit" id="TCotizacion_pagar_cotizacion" name="TCotizacion_pagar_cotizacion" style="background-color:#820906;margin-right:10px;"><i class="fa fa-save"></i> Pagar</button>
                            
        </div> -->

        <!-- </div> -->
        </div>

        <div class="wrapper">
        <?php $this->renderPartial('_formCliente', array('model'=>$model,'modelBeneficiario'=>$modelBeneficiario,'modelDBBeneficiario'=>$modelDBBeneficiario,'modelParentesco'=>$modelParentesco,'modelHM'=>$modelHM,'modelHMC'=>$modelHMC,'modelHMD'=>$modelHMD,'modelHMM'=>$modelHMM,'modelMedico'=>$modelMedico,'modelDBMedico'=>$modelDBMedico,'modelDirMedico'=>$modelDirMedico,'modelEspecialidad'=>$modelEspecialidad,'modelCar'=>$modelCar,'categorias'=>$categorias,'resumenCart'=>$resumenCart,'dataProviderCart'=>$dataProviderCart,'totalItems'=>$totalItems,'modelDireccion'=>$modelDireccion,'carritoDetalle'=>$carritoDetalle,'modelCot'=>$modelCot,'direccionEnvio'=>$direccionEnvio,'modelDB'=>$modelDB,'modelProducto'=>$modelProducto,'modelCartDet'=>$modelCartDet,'modelDonacion'=>$modelDonacion,'modelRes'=>$modelRes,'resumenCart'=>$resumenCart)); ?>
        </div>


    </div>
</section>