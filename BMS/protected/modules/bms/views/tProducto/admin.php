<?php
/* @var $this TProductoController */
/* @var $model TProducto */

//$modelInventario = new TInventario;
	

Yii::app()->clientScript->registerScript('search', "

crearProducto = function(){

	$('#idProducto').val('');
    $('#idInventario').val('');
	$('#divProductoMensaje').html('').hide();
	$('#TInventario_precio').val('');
	$('#TProducto_codigo').val('');
	$('#TProducto_descripcion').val('');
}

// function bindFileUpload() {

//     $('.fileinput').fileinput({
//         dataType: 'json',
//         done: function (e, data) {
//             $.each(data.result.files, function (index, file) {
//                 alert(file.name);
//             });
//         }
//     });
// };

grabarProducto = function(e){
	
    e.preventDefault();

    var data = new FormData($('#tproducto-form')[0]);
    
    $.ajax({
        type : 'POST',
        url : '".Yii::app()->createUrl("bms/TProducto/create")."',
        data : data,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        success : function (data) {                 
            if (data.salida == 'COMPLETO') {                
                $('#idProducto').val(data.id);
                // $('#idInventario').val(data.idi);

                $('#divProductoMensaje').html(data.mensaje).show();
            }

            $('#tproducto-grid').yiiGridView('update', {
				data: $(this).serialize()
			});

            return false;
        }
    });  

    return false;                             

}

getProducto = function(parametros){
   
    $.ajax({
        type : 'POST',
        url : '".Yii::app()->createUrl("bms/TProducto/update")."'+parametros,            
        dataType:'json',
        cache: false,
        contentType: false,
		processData: false,	       
        success : function (data) {

        	$('#producto-div').html(data.formProducto).show();   

            $('#idProducto').val(data.idp);   
            // $('#idInventario').val(data.idi);  

            // $('#tproducto-form').find('#fechaCompraProducto').datepicker({language:'es'});
            // $('#tproducto-form').find('#fechaVencimientoProducto').datepicker({language:'es'});   

            var fotoPrincipal = $('#fotoPrincipal').val();
			var fotoDetalle = $('#fotoDetalle').val();
			var fotoDescripcion = $('#fotoDescripcion').val();
			var fotoPosologia = $('#fotoPosologia').val();
			var fotoUso = $('#fotoUso').val();

			$('#TProducto_foto_principal').fileinput('destroy');
			$('#TProducto_foto_detalle').fileinput('destroy');
			$('#TProducto_foto_descripcion').fileinput('destroy');
			$('#TProducto_foto_posologia').fileinput('destroy');
			$('#TProducto_foto_uso').fileinput('destroy');

			$('#TProducto_foto_principal').fileinput({
				initialPreview: [fotoPrincipal],
		        initialPreviewAsData: true,
		        // initialPreviewConfig: [
		        //     {caption: 'Moon.jpg', size: 930321, width: '120px', key: 1}
		        // ],
		        overwriteInitial: true,
				language:'es',
				browseLabel:'Seleccionar',
				browseIcon: '<i class=\"fa fa-paperclip\"></i> ',
				showUpload: false,
				showCaption: false,
				browseClass: 'btn btn-primary',
				fileType: 'any',
		        previewFileIcon: '<i class=\"glyphicon glyphicon-king\"></i>'
			});

			$('#TProducto_foto_detalle').fileinput({
				initialPreview: [fotoDetalle],
		        initialPreviewAsData: true,
		        // initialPreviewConfig: [
		        //     {caption: 'Moon.jpg', size: 930321, width: '120px', key: 1}
		        // ],
		        overwriteInitial: true,
				language:'es',
				browseLabel:'Seleccionar',
				browseIcon: '<i class=\"fa fa-paperclip\"></i> ',
				showUpload: false,
				showCaption: false,
				browseClass: 'btn btn-primary',
				fileType: 'any',
		        previewFileIcon: '<i class=\"glyphicon glyphicon-king\"></i>'
			});        

			$('#TProducto_foto_descripcion').fileinput({
				initialPreview: [fotoDescripcion],
		        initialPreviewAsData: true,
		        // initialPreviewConfig: [
		        //     {caption: 'Moon.jpg', size: 930321, width: '120px', key: 1}
		        // ],
		        overwriteInitial: true,
				language:'es',
				browseLabel:'Seleccionar',
				browseIcon: '<i class=\"fa fa-paperclip\"></i> ',
				showUpload: false,
				showCaption: false,
				browseClass: 'btn btn-primary',
				fileType: 'any',
		        previewFileIcon: '<i class=\"glyphicon glyphicon-king\"></i>'
			});

			$('#TProducto_foto_posologia').fileinput({
				initialPreview: [fotoPosologia],
		        initialPreviewAsData: true,
		        // initialPreviewConfig: [
		        //     {caption: 'Moon.jpg', size: 930321, width: '120px', key: 1}
		        // ],
		        overwriteInitial: true,
				language:'es',
				browseLabel:'Seleccionar',
				browseIcon: '<i class=\"fa fa-paperclip\"></i> ',
				showUpload: false,
				showCaption: false,
				browseClass: 'btn btn-primary',
				fileType: 'any',
		        previewFileIcon: '<i class=\"glyphicon glyphicon-king\"></i>'
			});

			$('#TProducto_foto_uso').fileinput({
				initialPreview: [fotoUso],
		        initialPreviewAsData: true,
		        // initialPreviewConfig: [
		        //     {caption: 'Moon.jpg', size: 930321, width: '120px', key: 1}
		        // ],
		        overwriteInitial: true,
				language:'es',
				browseLabel:'Seleccionar',
				browseIcon: '<i class=\"fa fa-paperclip\"></i> ',
				showUpload: false,
				showCaption: false,
				browseClass: 'btn btn-primary',
				fileType: 'any',
		        previewFileIcon: '<i class=\"glyphicon glyphicon-king\"></i>'
			});
            
            return false;
        }
    });

    return false;
}



// $('.search-button').click(function(){
// 	$('.search-form').toggle();
// 	return false;
// });
// $('.search-form form').submit(function(){
// 	$('#tproducto-grid').yiiGridView('update', {
// 		data: $(this).serialize()
// 	});
// 	return false;
// });

// $('#tproducto-form').find('#fechaCompraProducto').datepicker({language:'es'});
// $('#tproducto-form').find('#fechaVencimientoProducto').datepicker({language:'es'});


borrarItem = function(idProducto){                
    $.ajax({
        type : 'POST',
        url : '".Yii::app()->createUrl("bms/TProducto/delete")."/id/'+idProducto,                    
        dataType:'json',            
        success : function (data) {
                          
            $('#shop-order-div').html(data.totalOrden);
            $('#tproducto-grid').yiiGridView('update', {
				data: $(this).serialize()
			});

            return false;
        }

    });

    return false;
}  


	var fotoPrincipal = $('#fotoPrincipal').val();
	var fotoDetalle = $('#fotoDetalle').val();
	var fotoDescripcion = $('#fotoDescripcion').val();
	var fotoPosologia = $('#fotoPosologia').val();
	var fotoUso = $('#fotoUso').val();

	$('#TProducto_foto_principal').fileinput({
		initialPreview: [fotoPrincipal],
        initialPreviewAsData: true,
        // initialPreviewConfig: [
        //     {caption: 'Moon.jpg', size: 930321, width: '120px', key: 1}
        // ],
        overwriteInitial: true,
		language:'es',
		browseLabel:'Seleccionar',
		browseIcon: '<i class=\"fa fa-paperclip\"></i> ',
		showUpload: false,
		showCaption: false,
		browseClass: 'btn btn-primary',
		fileType: 'any',
        previewFileIcon: '<i class=\"glyphicon glyphicon-king\"></i>'
	});

	$('#TProducto_foto_detalle').fileinput({
		initialPreview: [fotoDetalle],
        initialPreviewAsData: true,
        // initialPreviewConfig: [
        //     {caption: 'Moon.jpg', size: 930321, width: '120px', key: 1}
        // ],
        overwriteInitial: true,
		language:'es',
		browseLabel:'Seleccionar',
		browseIcon: '<i class=\"fa fa-paperclip\"></i> ',
		showUpload: false,
		showCaption: false,
		browseClass: 'btn btn-primary',
		fileType: 'any',
        previewFileIcon: '<i class=\"glyphicon glyphicon-king\"></i>'
	});

	$('#TProducto_foto_descripcion').fileinput({
		initialPreview: [fotoDescripcion],
        initialPreviewAsData: true,
        // initialPreviewConfig: [
        //     {caption: 'Moon.jpg', size: 930321, width: '120px', key: 1}
        // ],
        overwriteInitial: true,
		language:'es',
		browseLabel:'Seleccionar',
		browseIcon: '<i class=\"fa fa-paperclip\"></i> ',
		showUpload: false,
		showCaption: false,
		browseClass: 'btn btn-primary',
		fileType: 'any',
        previewFileIcon: '<i class=\"glyphicon glyphicon-king\"></i>'
	});

	$('#TProducto_foto_posologia').fileinput({
		initialPreview: [fotoPosologia],
        initialPreviewAsData: true,
        // initialPreviewConfig: [
        //     {caption: 'Moon.jpg', size: 930321, width: '120px', key: 1}
        // ],
        overwriteInitial: true,
		language:'es',
		browseLabel:'Seleccionar',
		browseIcon: '<i class=\"fa fa-paperclip\"></i> ',
		showUpload: false,
		showCaption: false,
		browseClass: 'btn btn-primary',
		fileType: 'any',
        previewFileIcon: '<i class=\"glyphicon glyphicon-king\"></i>'
	});

	$('#TProducto_foto_uso').fileinput({
		initialPreview: [fotoUso],
        initialPreviewAsData: true,
        // initialPreviewConfig: [
        //     {caption: 'Moon.jpg', size: 930321, width: '120px', key: 1}
        // ],
        overwriteInitial: true,
		language:'es',
		browseLabel:'Seleccionar',
		browseIcon: '<i class=\"fa fa-paperclip\"></i> ',
		showUpload: false,
		showCaption: false,
		browseClass: 'btn btn-primary',
		fileType: 'any',
        previewFileIcon: '<i class=\"glyphicon glyphicon-king\"></i>'
	});


");

//PENDIENTE SI HACE FALTA HABILITARLO O NO
// $cs=Yii::app()->getClientScript();		
// $cs->registerPackage('group-grid-view');
//$cs->registerScript(__CLASS__.'#'.$id,"jQuery('#$id').yiiGroupGridView($options);");


?>

</style>

<!-- page heading start-->
<div class="page-heading">
    <h3>
        Administrar Productos
    </h3>
    <ul class="breadcrumb">
        <li>
            <a href="#">Inicio</a>
        </li>        
        <li class="active"> Productos </li>
    </ul>
</div>
<!-- page heading end-->


<div class="wrapper">
	<div class="row">
        <div class="col-sm-12">
	        <section class="panel">
		        <header class="panel-heading">
		            Crear Producto
		            <span class="text-muted" style="font-size:10px;">Campos <span class="required">*</span> son obligatorios.</span>		            
		           	<span class="tools pull-right">		
		           		<button class="btn btn-primary" onclick="js: crearProducto(); return false;" style="float:left;"><i class="fa fa-plus"></i></button>           		
		                <a href="javascript:;" class="fa fa-chevron-down"></a>		                
		            </span>
		        </header>
		        <div class="panel-body">
		        	<div id="producto-div">
	            	<?php $this->renderPartial('application.modules.bms.views.tProducto._form', array('model'=>$model)); ?>	            		
	            	</div>
		        </div>
	        </section>
    	</div>
	</div>

	<div class="row">
        <div class="col-sm-12">
	        <section class="panel">
		        <header class="panel-heading">
		            Productos
		            <span class="tools pull-right">		            	
		                <a href="javascript:;" class="fa fa-chevron-down"></a>		                
		            </span>
		        </header>
		        <div class="panel-body">					

			        <div class="adv-table">

			        <?php
			        	// $this->widget('zii.widgets.grid.CGridView',array('dataProvider'=>$model->search()));

			        	//$this->widget('booster.widgets.TbGridView', array(
			        	//$this->widget('zii.widgets.grid.CGridView', array(	

			        	$this->widget('booster.widgets.TbGroupGridView', array(			        	
						    'id'=>'tproducto-grid',
							'dataProvider'=>$model->search(),
							'filter'=>$model,
							'itemsCssClass'=>'table table-bordered table-striped table-condensed',	
						    'extraRowColumns'=> array('id_producto_categoria'),
						    'extraRowExpression' => '"<b style=\"font-size: 3em; color: #333;\">".$data->idProductoCategoria->descripcion."</b>"',
						    'extraRowHtmlOptions' => array('style'=>'padding:10px'),
						    'columns'=>array(
								'codigo',
								'descripcion',								
								array(
									'class' => 'booster.widgets.TbEditableColumn',
								    'name' => 'precioWeb',
								    'value' => '$data->precioWeb',     
					                'sortable' => false,
					                'editable' => array(
					                    'url' => Yii::app()->createUrl("bms/TProducto/updatePrecio"),
					                    'placement' => 'left',
					                    'inputclass' => 'span2',
					                    'validate'   => 'js: function(value) {
										    if($.trim(value) == "") return "valor requerido."
										    else if (!$.isNumeric(value)) return "el valor debe ser numérico.";
										}',
										'display' => 'js: function(value, sourceData) {
										  var escapedValue = $("<div>").text(value).html();
										  $(this).html("<b>$" + parseFloat(escapedValue).toFixed(2) + "</b>")
										}'
					                ),								    
								    'filter'=>false,
								    'htmlOptions'=>array('style'=>'text-align:right;'),
								),
								
								array(	
									'name'=>'id_estatus',
									'header' =>'Estatus',
									'value'=>'TEstatus::model()->findByPk($data->id_estatus)->descripcion',
									'filter'=> CHtml::listData(TEstatus::model()->findAll(),'id_estatus','descripcion')
								),
								array(	
									'name'=>'fecha_creacion',
									'header' =>'Fecha Creación',								
									'value'=>'date(\'d/m/Y H:i A\',strtotime($data->fecha_creacion))',
									'filter'=>false
								),
								array(
									'class'=>'CButtonColumn',								
									'template'=>'{edit}&nbsp;&nbsp;{borrar}',
									'buttons'=>array(
									    'edit' => array(
									        'label'=>'', 
									        'url'=>'"/id/".$data->id_producto',		
									        'options'=>array('class'=>'fa fa-pencil fa-lg'),
									        'click'=>'function(){ getProducto($(this).attr("href")); return false; } ',
									    	'live'=>false,				          
									    ),
	                                    'borrar' => array(
						                    'label'=>'',	
						                    'url'=>'Yii::app()->createUrl("bms/TProducto/delete",array("id"=>$data->id_producto))',
								            'options'=>array(		            	
								            	'title' => 'Eliminar Producto',
								            	'onclick'=>'					            		
													var r = confirm("¿Está seguro que desea borrar este producto?");
													
													if (r == true) {											   
									            		$.ajax({
														    url:$(this).attr("href"),
														    type:"POST",   
														    dataType:"json",   						    
														    success: function(data){ 
														    	if(data.salida == "OK"){														
														    		$("#divProductoMensaje").html(data.mensaje).show();

														    		$("#tproducto-grid").yiiGridView("update", {
																		data: $(this).serialize()
																	});
																	return false;

									            				}else{
									            					alert(data);
									            				}

									            				return false;           				
															}
														});	
													} 
													return false;								            		
								            	',
						                   		'class'=>'fa fa-trash fa-lg'
								            ),															             
								            'click'=>'js: function(){ return false; } ',   
								            //'visible'=>'$data["id_medico"] == '.$idMedico,
						                ),       

									),	
								),
							),
						));
						
			        ?>

					
 					</div>
		        </div>
	        </section>
    	</div>
	</div>
</div>