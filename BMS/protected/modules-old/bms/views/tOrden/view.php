<?php
/* @var $this TOrdenController */
/* @var $model TOrden */
?>

<section class="ls ms section_padding_15">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="shop-adds text-center">
                    <?php if (!empty($origen) && $origen=='cot'){ ?>
                    <span>Cotización #<?php echo substr($modelCot->codigo_cotizacion, 2, 5); ?></span>
                    <?php }else{ ?>
                    <span>Carrito de Compra</span>
                    <?php } ?>
                    <i class="arrow-icon-right-open-mini"></i>
                    <span>MultiPagos</span>
                    <i class="arrow-icon-right-open-mini"></i>

                    <span class="grey">Orden Completa #<?php echo substr($model->codigo_orden, 2, 5); ?></span>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="content" class="ls section_padding_50">
    <div class="container">
        <div class="row">
			<?php $this->widget('zii.widgets.CDetailView', array(
				'data'=>$model,
				'attributes'=>array(
					//'id_orden',
					'codigo_orden',
					'id_cotizacion',
					'id_beneficiario',
					'items',
					'monto_total',
					'saldo',
					'id_estatus',
					'fecha_creacion',
				),
			)); ?>
		</div>
	</div>
</section>