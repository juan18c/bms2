<?php
/* @var $this TOrdenController */
/* @var $model TOrden */
/* @var $form CActiveForm */
?>

<div class="row">
    <div class="col-sm-12">
	    <section class="panel">
	    	<header class="panel-heading">
		    	Conciliar Pagos de la Orden #<?php echo $model->codigo_orden; ?>
		        <span class="text-muted" style="font-size:10px;">Campos con <span class="required">*</span> son obligatorios.</span>		            
		        <span class="tools pull-right">
		            <a href="javascript:;" class="fa fa-chevron-down"></a>		                
		        </span>
		    </header>
		    <div class="panel-body">
		        	

			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'torden-conciliar-form',
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// There is a call to performAjaxValidation() commented in generated controller code.
				// See class documentation of CActiveForm for details on this.
				'enableAjaxValidation'=>false,
			)); ?>
				<input type="hidden" id="total" name="total" value="<?php echo $model->monto_total; ?>">
				<input type="hidden" id="idOrden" name="idOrden" value="<?php echo $model->id_orden; ?>">
				<h4>RESUMEN DE ORDEN</h4>
				<div class="form-group clearfix">
					<div class="col-lg-3" style="padding-left: 0; margin-bottom:15px;">
						<?php echo $form->labelEx($model,'monto_total'); ?>		
						<?php echo $form->textField($model,'monto_total',array('class'=>'form-control','readonly'=>'readonly')); ?>
					</div>
					<div class="col-lg-3" style="padding-left: 0; margin-bottom:15px;">
						<label>Monto Conciliado</label>
						<input type="text" name="montoConciliado" id="montoConciliado" class="form-control" value="0">
					</div>
					<div class="col-lg-3" style="padding-left: 0; margin-bottom:15px;">
						<label>Monto Restante</label>
						<input type="text" name="montoRestante" id="montoRestante" class="form-control" value="0">
					</div>
				</div>

				<?php

					$pagos = $modelPago->findAll('t.id_orden='.$model->id_orden);

					foreach ($pagos as $key => $value) {
						switch ($value->id_medio_pago) {
							case '1': //PAYPAL
							
				?>
							
							<h4>PAYPAL</h4>
							<div class="form-group clearfix">
								<div class="col-lg-3" style="padding-left: 0; margin-bottom:15px;">
									<?php echo $form->labelEx($modelPago,'email'); ?>		
									<?php echo $form->textField($modelPago,'email',array('class'=>'form-control','value'=>$value->email,'readonly'=>'readonly')); ?>
								</div>
								<div class="col-lg-3" style="padding-left: 0; margin-bottom:15px;">
									<?php echo $form->labelEx($modelPago,'fecha_pago'); ?>		
									<?php echo $form->textField($modelPago,'fecha_pago',array('class'=>'form-control','value'=>$value->fecha_pago,'readonly'=>'readonly')); ?>
								</div>								

								<div class="col-lg-3" style="padding-left: 0; margin-bottom:15px;">
									<?php echo $form->labelEx($modelPago,'comisionPorcentaje'); ?>		
									<?php echo $form->textField($modelPago,'comisionPorcentaje',array('class'=>'form-control','value'=>$value->comisionPorcentaje,'readonly'=>'readonly')); ?>
								</div>

								<div class="col-lg-3" style="padding-left: 0; margin-bottom:15px;">
									<?php echo $form->labelEx($modelPago,'comisionValorFijo'); ?>		
									<?php echo $form->textField($modelPago,'comisionValorFijo',array('class'=>'form-control','value'=>$value->comisionValorFijo,'readonly'=>'readonly')); ?>
								</div>								
								
							</div>

							<div class="form-group clearfix">
								<div class="col-lg-2" style="padding-left: 0; margin-bottom:15px;">
									<?php echo $form->labelEx($modelPago,'comision'); ?>		
									<?php echo $form->textField($modelPago,'comision',array('class'=>'form-control','value'=>$value->comision,'readonly'=>'readonly')); ?>
								</div>

								<div class="col-lg-2" style="padding-left: 0; margin-bottom:15px;">
									<?php echo $form->labelEx($modelPago,'monto'); ?>		
									<?php echo $form->textField($modelPago,'monto',array('class'=>'form-control','value'=>$value->monto,'readonly'=>'readonly')); ?>
								</div>

								<div class="col-lg-2" style="padding-left: 0; margin-bottom:15px;">
									<input type="hidden" name="relleno">
								</div>
								<div class="col-lg-2" style="padding-left: 0; margin-bottom:15px;">
									<input type="hidden" name="relleno">
								</div>
								<div class="col-lg-2" style="padding-left: 0; margin-bottom:15px;">
									<label>Monto Recibido</label>
									<input type="text" name="montoRecibidoPaypal" id="montoRecibidoPaypal" class="form-control monto-a-pagar" placeholder="0.00">
								</div>

								<div class="col-lg-2" style="padding-left: 0; margin-bottom:15px;">
									<label>Fecha</label>
									<input type="text" name="fechaRecibidoPaypal" id="fechaRecibidoPaypal" class="form-control">
								</div>
								
							</div>
				<?php
								break;
							case '2'://TARJETA DE CREDITO
								# code...
								break;
							case '3'://TARJETA DE DEBITO
								# code...
								break;
							case '4': //TRANSFERENCIA/DEPOSITO
				?>
							
							<h4>TRANSFERENCIA/DEPOSITO</h4>
							<div class="form-group clearfix">
								<div class="col-lg-3" style="padding-left: 0; margin-bottom:15px;">
									<?php echo $form->labelEx($modelPago,'nombre_banco'); ?>		
									<?php echo $form->textField($modelPago,'nombre_banco',array('class'=>'form-control','value'=>$value->nombre_banco,'readonly'=>'readonly')); ?>
								</div>

								<div class="col-lg-3" style="padding-left: 0; margin-bottom:15px;">
									<?php echo $form->labelEx($modelPago,'numero_cuenta'); ?>		
									<?php echo $form->textField($modelPago,'numero_cuenta',array('class'=>'form-control','value'=>$value->numero_cuenta,'readonly'=>'readonly')); ?>
								</div>

								<div class="col-lg-3" style="padding-left: 0; margin-bottom:15px;">
									<?php echo $form->labelEx($modelPago,'numero_ruta_bancaria'); ?>		
									<?php echo $form->textField($modelPago,'numero_ruta_bancaria',array('class'=>'form-control','value'=>$value->numero_ruta_bancaria,'readonly'=>'readonly')); ?>
								</div>
								<div class="col-lg-3" style="padding-left: 0; margin-bottom:15px;">
									<?php echo $form->labelEx($modelPago,'fecha_pago'); ?>		
									<?php echo $form->textField($modelPago,'fecha_pago',array('class'=>'form-control','value'=>$value->fecha_pago,'readonly'=>'readonly')); ?>
								</div>								
								
								
							</div>

							<div class="form-group clearfix">

								<div class="col-lg-2" style="padding-left: 0; margin-bottom:15px;">
									<?php echo $form->labelEx($modelPago,'comisionValorFijo'); ?>	
									<?php echo $form->textField($modelPago,'comisionValorFijo',array('class'=>'form-control','value'=>$value->comisionValorFijo,'readonly'=>'readonly')); ?>
								</div>

								<div class="col-lg-2" style="padding-left: 0; margin-bottom:15px;">
									<?php echo $form->labelEx($modelPago,'comision'); ?>		
									<?php echo $form->textField($modelPago,'comision',array('class'=>'form-control','value'=>$value->comision,'readonly'=>'readonly')); ?>
								</div>

								<div class="col-lg-2" style="padding-left: 0; margin-bottom:15px;">
									<?php echo $form->labelEx($modelPago,'monto'); ?>		
									<?php echo $form->textField($modelPago,'monto',array('class'=>'form-control','value'=>$value->monto,'readonly'=>'readonly')); ?>
								</div>

								<div class="col-lg-2" style="padding-left: 0; margin-bottom:15px;">
									<input type="hidden" name="relleno">
								</div>
								<div class="col-lg-2" style="padding-left: 0; margin-bottom:15px;">
									<label>Monto Recibido</label>
									<input type="text" name="montoRecibidoDeposito" id="montoRecibidoDeposito" class="form-control monto-a-pagar" placeholder="0.00">
								</div>

								<div class="col-lg-2" style="padding-left: 0; margin-bottom:15px;">
									<label>Fecha</label>
									<input type="text" name="fechaRecibidoDeposito" id="fechaRecibidoDeposito" class="form-control">
								</div>
								
							</div>
				<?php
								break;
							case '5'://CREDITO BMS
								# code...
								break;
							case '6'://DONACION
								# code...
								break;
							default:
								echo "No existe medio de pagos para esta orden. Verifique";
								break;
						}
					}
					
				?>

				<h4>EFECTIVO</h4>
				<div class="form-group clearfix">
					<div class="col-lg-3" style="padding-left: 0; margin-bottom:15px;">
						<label>Monto Recibido</label>
						<input type="text" name="montoRecibidoEfectivo" id="montoRecibidoEfectivo" class="form-control monto-a-pagar" placeholder="0.00">						
					</div>					

					<div class="col-lg-3" style="padding-right: 0; margin-bottom:15px;">
						<label>Fecha</label>
						<input type="text" name="fechaRecibidoEfectivo" id="fechaRecibidoEfectivo" class="form-control">
					</div>

					<!-- <div class="col-lg-3" style="padding-right: 0; margin-bottom:15px;">
						<br>
						<button class="btn btn-primary" type="button" id="TOrden_agregar_efectivo" name="TOrden_agregar_efectivo"><i class="fa fa-plus"></i></button>
					</div> -->
				</div>

				<div class="form-group clearfix">
					<button class="btn btn-primary" type="button" id="TOrden_conciliar" name="TOrden_conciliar"><i class="fa fa-save"></i> Conciliar</button>
				</div>

			<?php $this->endWidget(); ?>


	        </div>
        </section>
	</div>
</div>