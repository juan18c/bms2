<?php
/* @var $this TProductoController */
/* @var $model TProducto */
/* @var $form CActiveForm */
$fotoPrincipal= "http://www.placehold.it/300x300/EFEFEF/AAAAAA&amp;text=no+image";
$fotoDetalle= "http://www.placehold.it/300x300/EFEFEF/AAAAAA&amp;text=no+image";
$fotoDescripcion= "http://www.placehold.it/300x300/EFEFEF/AAAAAA&amp;text=no+image";
$fotoPosologia= "http://www.placehold.it/300x300/EFEFEF/AAAAAA&amp;text=no+image";
$fotoUso= "http://www.placehold.it/300x300/EFEFEF/AAAAAA&amp;text=no+image";

?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tproducto-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('role'=>'form','enctype' => 'multipart/form-data')
)); ?>	

	<?php echo $form->errorSummary($model); ?>
	<div id="divProductoMensaje"></div>

	<input type="hidden" id="idProducto" name="idProducto" value="" />
	<!-- <input type="hidden" id="idInventario" name="idInventario" value="" /> -->

	<div class="form-group">					

		<div class="col-lg-2" style="padding-left: 0; margin-bottom:15px;">
			<?php echo $form->labelEx($model,'codigo'); ?>						
			<?php echo $form->textField($model,'codigo',array('maxlength'=>60,'class'=>'form-control','maxlength'=>250)); ?>
			<?php echo $form->error($model,'codigo'); ?>
		</div>

		<div class="col-lg-2" style="margin-bottom:15px;">
			<?php echo $form->labelEx($model,'id_estatus'); ?>
			<?php echo $form->dropDownList($model,'id_estatus',CHtml::listData(TEstatus::model()->findAll(),'id_estatus','descripcion'),array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'id_estatus'); ?>
		</div>

		<div class="col-lg-6" style="margin-bottom:15px;">
			<?php echo $form->labelEx($model,'descripcion'); ?>
			<?php echo $form->textField($model,'descripcion',array('maxlength'=>60,'class'=>'form-control','maxlength'=>250)); ?>
			<?php echo $form->error($model,'descripcion'); ?>
		</div>

		<div class="col-lg-2" style="padding-right: 0; margin-bottom:15px;">
			<?php echo $form->labelEx($model,'precioWeb'); ?>			
			<?php echo $form->textField($model,'precioWeb',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'precioWeb'); ?>
		</div>
	</div>

	<div class="form-group">					

		<div class="col-lg-4" style="padding-left: 0; margin-bottom:15px;">
			<?php echo $form->labelEx($model,'id_producto_tipo'); ?>			
			<?php echo $form->dropDownList($model,'id_producto_tipo',CHtml::listData(TProductoTipo::model()->findAll(),'id_producto_tipo','descripcion'),array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'id_producto_tipo'); ?>
		</div>

		<div class="col-lg-4" style="padding-right: 0; margin-bottom:15px;">
			<?php echo $form->labelEx($model,'id_producto_categoria'); ?>
			<?php echo $form->dropDownList($model,'id_producto_categoria',CHtml::listData(TProductoCategoria::model()->findAll(),'id_producto_categoria','descripcion'),array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'id_producto_categoria'); ?>
		</div>

		<div class="col-lg-4" style="padding-right: 0; margin-bottom:15px;">
			<?php echo $form->labelEx($model,'id_marca'); ?>
			<?php echo $form->dropDownList($model,'id_marca',CHtml::listData(TDatosBasicos::model()->findAll('t.id_perfil IN (3,4)'),'id_datos_basicos','nombres'),array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'id_marca'); ?>
		</div>
	</div>
	
	<div class="form-group">
        <div class="col-md-4">
            <?php echo $form->labelEx($model,'foto_principal'); ?>
            <input id="TProducto_foto_principal" name="TProducto[foto_principal]" type="file">
            <?php 
            	if((isset($model->foto_principal))&&($model->foto_principal!=""))
					$fotoPrincipal=$model->foto_principal;						
			?>
			<input type="hidden" id="fotoPrincipal" name="fotoPrincipal" value="<?php echo $fotoPrincipal; ?>">
        </div>

        <div class="col-md-4">
            <?php echo $form->labelEx($model,'foto_detalle'); ?>
            <input id="TProducto_foto_detalle" name="TProducto[foto_detalle]" type="file">
            <?php 
            	if((isset($model->foto_detalle))&&($model->foto_detalle!=""))
					$fotoDetalle=$model->foto_detalle;
			?>
			<input type="hidden" id="fotoDetalle" name="fotoDetalle" value="<?php echo $fotoDetalle; ?>">
        </div>

        <div class="col-md-4">
            <?php echo $form->labelEx($model,'foto_descripcion'); ?>
            <input id="TProducto_foto_descripcion" name="TProducto[foto_descripcion]" type="file">
            <?php 
            	if((isset($model->foto_descripcion))&&($model->foto_descripcion!=""))
					$fotoDescripcion=$model->foto_descripcion;
			?>
			<input type="hidden" id="fotoDescripcion" name="fotoDescripcion" value="<?php echo $fotoDescripcion; ?>">
        </div>        

    </div>

    <div class="form-group">
    	<div class="col-md-4">
            <?php echo $form->labelEx($model,'foto_posologia'); ?>
            <input id="TProducto_foto_posologia" name="TProducto[foto_posologia]" type="file">
            <?php 
            	if((isset($model->foto_posologia))&&($model->foto_posologia!=""))
					$fotoPosologia=$model->foto_posologia;
			?>
			<input type="hidden" id="fotoPosologia" name="fotoPosologia" value="<?php echo $fotoPosologia; ?>">
        </div>

    	<div class="col-md-4">
            <?php echo $form->labelEx($model,'foto_uso'); ?>
            <input id="TProducto_foto_uso" name="TProducto[foto_uso]" type="file">
            <?php 
            	if((isset($model->foto_uso))&&($model->foto_uso!=""))
					$fotoUso=$model->foto_uso;
			?>
			<input type="hidden" id="fotoUso" name="fotoUso" value="<?php echo $fotoUso; ?>">
        </div>

   		<div class="col-md-4" style="margin-bottom:15px;">
   			<br>

   			<?php if ($model->isNewRecord){ ?>
   			<button class="btn btn-primary pull-right" type="submit" id="buttonCrearProducto" name="buttonCrearProducto" style="background-color:#820906" onclick='js: grabarProducto(event); '><i class="fa fa-plus"></i> Crear Producto</button>
   			<?php }else{ ?>
   			<button class="btn btn-primary pull-right" type="submit" id="buttonCrearProducto" name="buttonCrearProducto" style="background-color:#820906" onclick='js: grabarProducto(event); '><i class="fa fa-save"></i> Guardar Producto</button>
   			<?php } ?>
   			
   		</div>

	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->