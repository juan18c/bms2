<?php
/* @var $this TCotizacionController */
/* @var $model TCotizacion */
?>
<section id="content" class="ls section_padding_50">
    <div class="container">

        <div class="page-heading">       
            <h3>
                Solicitar Despacho
            </h3>       
        </div>

        <div class="wrapper">
        <?php $this->renderPartial('_formCliente', array('model'=>$model,'modelBeneficiario'=>$modelBeneficiario,'modelDBBeneficiario'=>$modelDBBeneficiario,'modelParentesco'=>$modelParentesco,'modelHM'=>$modelHM,'modelHMC'=>$modelHMC,'modelHMD'=>$modelHMD,'modelHMM'=>$modelHMM,'modelMedico'=>$modelMedico,'modelDBMedico'=>$modelDBMedico,'modelDirMedico'=>$modelDirMedico,'modelEspecialidad'=>$modelEspecialidad,'modelCar'=>$modelCar,'categorias'=>$categorias,'resumenCart'=>$resumenCart,'dataProviderCart'=>$dataProviderCart,'totalItems'=>$totalItems,'modelDireccion'=>$modelDireccion,'carritoDetalle'=>$carritoDetalle,'modelCot'=>$modelCot,'direccionEnvio'=>$direccionEnvio,'modelDB'=>$modelDB,'modelProducto'=>$modelProducto,'modelOrden'=>$modelOrden,'envio'=>$envio,'gastos'=>$gastos,'paisDestino'=>$paisDestino,'paisAbreviatura'=>$paisAbreviatura,'modelCartDet'=>$modelCartDet)); ?>
        </div>


    </div>
</section>