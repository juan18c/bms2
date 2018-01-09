<?php
/* @var $this TImagenLoginController */
/* @var $model TImagenLogin */

$this->breadcrumbs=array(
	'Timagen Logins'=>array('index'),
	$model->id_imagen,
);

$this->menu=array(
	array('label'=>'List TImagenLogin', 'url'=>array('index')),
	array('label'=>'Create TImagenLogin', 'url'=>array('create')),
	array('label'=>'Update TImagenLogin', 'url'=>array('update', 'id'=>$model->id_imagen)),
	array('label'=>'Delete TImagenLogin', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_imagen),'confirm'=>'Está seguro que desea eliminar este registro?')),
	array('label'=>'Manage TImagenLogin', 'url'=>array('admin')),
);
?>

<h1>Imagen de Logueo #<?php echo $model->id_imagen; ?></h1>
<br>
<div class="row-fluid">
	<div class="span2">
		<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/sesion_images/<?php echo $model->nombre; ?>" width="170" />
	</div>
	<div class="span10">
		<?php $this->widget('bootstrap.widgets.TbDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				array('name' => 'id_imagen', 'label' => 'Código'),
				array('name' => 'nombre', 'label' => 'Nombre de la Imagen'),
				array('name' => 'grupo', 'label' => 'Código de Grupo'),
				array('name' => 'orden', 'label' => 'Orden de Vista'),
				array('name' => 'dias_vigentes', 'label' => 'Expira en'),
				array('name' => 'fecha_creacion', 'label' => 'Fecha de Creación','value'=>date('d/m/Y',strtotime($model->fecha_creacion))),
				array('name' => 'id_estatus', 'label' => 'Estatus','value'=>TEstatus::model()->getDescEstatus($model->id_estatus)),		
				
			),
		)); ?>
	</div>
</div>

<h1>Imágenes del Grupo #<?php echo $model->grupo; ?></h1>
<br>
<div class="row-fluid">	
	<div class="span12">
		<div class="container"> 
		<?php
			$criteria = new CDbCriteria;
			$criteria->select = array('id_imagen, nombre');
			$criteria->condition = "grupo = ".$model->grupo." AND id_imagen != ".$model->id_imagen;
			//$criteria->order = 'orden';
			$imagenes = TImagenLogin::model()->findAll($criteria);
		
			foreach ($imagenes as $key => $value) {
				if ($key == 0) 
					echo '<div class="row-fluid">';
				
				echo '	<div class="span3">';
				
				echo '		<a href="'.Yii::app()->createUrl('Seguridad/TImagenLogin/view',array('id'=>$value->id_imagen)).'">
								<img src="'.Yii::app()->request->baseUrl.'/images/sesion_images/'.$value->nombre.'" width="170" alt="'.$value->nombre.'" title="'.$value->nombre.'" />
							</a>';
				
				echo '	</div>';
				
				if ($key == 3) {
					echo '<br><br><br>';
					echo '</div>';
					echo '<div class="row-fluid">';
				
				}

								
			}
			echo '</div>';
		 ?>
		</div>
	</div>
</div>