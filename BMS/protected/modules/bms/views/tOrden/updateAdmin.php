<?php
/* @var $this TCotizacionController */
/* @var $model TCotizacion */
?>
<div class="wrapper">

    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    Modificar Orden #<?php echo substr($modelOrden->codigo_orden, 2, 5); ?> creada el <?php echo date('d/m/Y H:i A',strtotime($modelOrden->fecha_creacion)); ?>
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>                      
                    </span>
                </header>
                <div class="panel-body">

        

        
                <?php $this->renderPartial('_formAdmin', array('model'=>$model,'modelBeneficiario'=>$modelBeneficiario,'modelDBBeneficiario'=>$modelDBBeneficiario,'modelParentesco'=>$modelParentesco,'modelHM'=>$modelHM,'modelHMC'=>$modelHMC,'modelHMD'=>$modelHMD,'modelHMM'=>$modelHMM,'modelMedico'=>$modelMedico,'modelDBMedico'=>$modelDBMedico,'modelDirMedico'=>$modelDirMedico,'modelEspecialidad'=>$modelEspecialidad,'modelCar'=>$modelCar,'categorias'=>$categorias,'resumenCart'=>$resumenCart,'dataProviderCart'=>$dataProviderCart,'totalItems'=>$totalItems,'modelDireccion'=>$modelDireccion,'carritoDetalle'=>$carritoDetalle,'modelCot'=>$modelCot,'direccionEnvio'=>$direccionEnvio,'modelDB'=>$modelDB,'modelProducto'=>$modelProducto,'modelOrden'=>$modelOrden,'envio'=>$envio,'gastos'=>$gastos,'paisDestino'=>$paisDestino,'paisAbreviatura'=>$paisAbreviatura,'modelCartDet'=>$modelCartDet)); ?>
                </div>
            </section>
        </div>
    </div>
</div>