<?php

class TProductoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public function init()
	{
   		
      	Yii::app()->theme = 'bms';
      	$this->layout ='//layouts/portalCliente';
   		parent::init();
	}

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','updatePrecio'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete','createForm','updateForm','categoria','updateOrden'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','createForm','updateForm','categoria','updateOrden'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreateForm()
	{
		$model=new TProducto;
		$modelInventario=new TInventario;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TProducto']))
		{
			$model->attributes=$_POST['TProducto'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_almacen));
		}
		Yii::app()->theme = 'admin';
		$this->layout ='//layouts/portalAdmin';
		$this->render('create',array(
			'model'=>$model,'modelInventario'=>$modelInventario
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdateForm($id)
	{
		$model=$this->loadModel($id);
		$idInventario = TInventario::model()->with('idProducto')->find('t.id_producto = '.$id);
		$modelInventario=TInventarioController::loadModel($idInventario->id_inventario);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TProducto']))
		{
			$model->attributes=$_POST['TProducto'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_almacen));
		}
		Yii::app()->theme = 'admin';
		$this->layout ='//layouts/portalAdmin';

		$model->foto_principal = !empty($model->foto_principal) ? Yii::app()->request->baseUrl.'/'.$model->foto_principal : $model->foto_principal;
		$model->foto_detalle = !empty($model->foto_detalle)? Yii::app()->request->baseUrl.'/'.$model->foto_detalle : $model->foto_detalle;

		$modelInventario->fecha_compra = date('d/m/Y',strtotime($modelInventario->fecha_compra));
		$modelInventario->fecha_vencimiento = date('d/m/Y',strtotime($modelInventario->fecha_vencimiento));

		$this->render('update',array(
			'model'=>$model,'modelInventario'=>$modelInventario
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new TProducto;
		// $modelInventario=new TInventario;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TProducto']))
		{

			$id = isset($_POST['idProducto']) ? $_POST['idProducto'] : '';
			//$idInventario = isset($_POST['idInventario']) ? $_POST['idInventario'] : '';

			if (!empty($id)) {
				$model = $this->loadModel($id);

				$_POST['TProducto']['foto_principal'] = $model->foto_principal;
				$_POST['TProducto']['foto_detalle'] = $model->foto_detalle;
				$_POST['TProducto']['foto_descripcion'] = $model->foto_descripcion;
				$_POST['TProducto']['foto_posologia'] = $model->foto_posologia;
				$_POST['TProducto']['foto_uso'] = $model->foto_uso;
				$model->setScenario('update');
				
			}

			// if (!empty($idInventario)) {
			// 	$modelInventario = TInventarioController::loadModel($idInventario);
			// }

			$model->attributes=$_POST['TProducto'];
			//$modelInventario->attributes=$_POST['TInventario'];			
			//print_r($_FILES);
			if (isset($_FILES)) {				
				
				if ($_FILES['TProducto']['error']['foto_principal'] === 0) {
					$imagen=CUploadedFile::getInstance($model,'foto_principal');
					$ext = pathinfo($imagen, PATHINFO_EXTENSION);					
				}				

				if ($_FILES['TProducto']['error']['foto_detalle'] === 0) {					

					$imagen2=CUploadedFile::getInstance($model,'foto_detalle');
					$ext2 = pathinfo($imagen2, PATHINFO_EXTENSION);
				}

				if ($_FILES['TProducto']['error']['foto_descripcion'] === 0) {					

					$imagen2=CUploadedFile::getInstance($model,'foto_descripcion');
					$ext2 = pathinfo($imagen2, PATHINFO_EXTENSION);
				}

				if ($_FILES['TProducto']['error']['foto_posologia'] === 0) {					

					$imagen2=CUploadedFile::getInstance($model,'foto_posologia');
					$ext2 = pathinfo($imagen2, PATHINFO_EXTENSION);
				}

				if ($_FILES['TProducto']['error']['foto_uso'] === 0) {					

					$imagen2=CUploadedFile::getInstance($model,'foto_uso');
					$ext2 = pathinfo($imagen2, PATHINFO_EXTENSION);
				}	
			}			
			//if( $uploadedFile != null  and !$uploadedFile->getHasError())
			//echo $model->foto_detalle.'----'.$model->foto_principal;

			//exit();
			if ($model->save()) {
				//echo "guarde "; exit();
				if (isset($_FILES)) {
					if ($_FILES['TProducto']['error']['foto_principal'] === 0) {
						
						$modelUpdateImage = $this::loadModel($model->id_producto);
						$modelUpdateImage->foto_principal='images/Productos/'.$model->codigo.'-1.'.$ext;
						

						if ($modelUpdateImage->save()) {
							if (!empty($model->foto_principal)) 
								unlink(Yii::app()->basePath.'/../'.$model->foto_principal);		
							
							$imagen->saveAs($modelUpdateImage->foto_principal);							

							$salida = 'OK';
						}
					}

					if ($_FILES['TProducto']['error']['foto_detalle'] === 0) {
						
						$modelUpdateImage = $this::loadModel($model->id_producto);						
						$modelUpdateImage->foto_detalle='images/Productos/'.$model->codigo.'-2.'.$ext2;

						if ($modelUpdateImage->save()) {								
							
							if (!empty($model->foto_detalle)) 
								unlink(Yii::app()->basePath.'/../'.$model->foto_detalle);
							
							$imagen2->saveAs($modelUpdateImage->foto_detalle);

							$salida = 'OK';
						}
					}

					if ($_FILES['TProducto']['error']['foto_descripcion'] === 0) {
						
						$modelUpdateImage = $this::loadModel($model->id_producto);						
						$modelUpdateImage->foto_descripcion='images/Productos/'.$model->codigo.'-3.'.$ext2;

						if ($modelUpdateImage->save()) {								
							
							if (!empty($model->foto_descripcion)) 
								unlink(Yii::app()->basePath.'/../'.$model->foto_descripcion);
							
							$imagen2->saveAs($modelUpdateImage->foto_descripcion);

							$salida = 'OK';
						}
					}

					if ($_FILES['TProducto']['error']['foto_posologia'] === 0) {
						
						$modelUpdateImage = $this::loadModel($model->id_producto);						
						$modelUpdateImage->foto_posologia='images/Productos/'.$model->codigo.'-4.'.$ext2;

						if ($modelUpdateImage->save()) {								
							
							if (!empty($model->foto_posologia)) 
								unlink(Yii::app()->basePath.'/../'.$model->foto_posologia);
							
							$imagen2->saveAs($modelUpdateImage->foto_posologia);

							$salida = 'OK';
						}
					}

					if ($_FILES['TProducto']['error']['foto_uso'] === 0) {
						
						$modelUpdateImage = $this::loadModel($model->id_producto);						
						$modelUpdateImage->foto_uso='images/Productos/'.$model->codigo.'-5.'.$ext2;

						if ($modelUpdateImage->save()) {								
							
							if (!empty($model->foto_uso)) 
								unlink(Yii::app()->basePath.'/../'.$model->foto_uso);
							
							$imagen2->saveAs($modelUpdateImage->foto_uso);

							$salida = 'OK';
						}
					}
				}

				// $modelInventario->id_producto = $model->id_producto;
				// $modelInventario->fecha_compra=date('Y-m-d H:i:s',strtotime($_POST['TInventario']['fecha_compra']));
    //         	$modelInventario->fecha_vencimiento=date('Y-m-d H:i:s',strtotime($_POST['TInventario']['fecha_vencimiento']));

				//if($modelInventario->save()){
					echo CJSON::encode(array(
						'salida' => 'COMPLETO',
						'id'=>$model->id_producto,
						//'idi'=>$modelInventario->id_inventario,
						'mensaje' => '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="glyphicon glyphicon-ok-sign"></i> El producto fue creado exitosamente.</div>'
					));

					Yii::app()->end();
				//}


			}
				
		}

		echo CJSON::encode(array(
			'salida' => 'ERROR',			
			'mensaje' => 'Ocurrio un error por favor verifique'
		));
		Yii::app()->end();
			
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		// $idInventario = TInventario::model()->with('idProducto')->find('t.id_producto = '.$id);
		// $modelInventario=TInventarioController::loadModel($idInventario->id_inventario);

		$model->foto_principal = !empty($model->foto_principal) ? Yii::app()->request->baseUrl.'/images/Productos/'.$model->foto_principal : $model->foto_principal;
		$model->foto_detalle = !empty($model->foto_detalle)? Yii::app()->request->baseUrl.'/images/Productos/'.$model->foto_detalle : $model->foto_detalle;
		$model->foto_descripcion = !empty($model->foto_descripcion) ? Yii::app()->request->baseUrl.'/images/Productos/'.$model->foto_descripcion : $model->foto_descripcion;
		$model->foto_posologia = !empty($model->foto_posologia)? Yii::app()->request->baseUrl.'/images/Productos/'.$model->foto_posologia : $model->foto_posologia;
		$model->foto_uso = !empty($model->foto_uso)? Yii::app()->request->baseUrl.'/images/Productos/'.$model->foto_uso : $model->foto_uso;

		// $modelInventario->fecha_compra = date('d/m/Y',strtotime($modelInventario->fecha_compra));
		// $modelInventario->fecha_vencimiento = date('d/m/Y',strtotime($modelInventario->fecha_vencimiento));

		$formProducto = $this->renderPartial('application.modules.bms.views.tProducto._form', array('model'=>$model),true,false);

		echo CJSON::encode(array(	
			'idp' => $model->id_producto,
			//'idi' => $modelInventario->id_inventario,			
			'formProducto'=>$formProducto
		));

		Yii::app()->end();
	}

	/**
	 * Guarda el comentario del Signo Vital
	 * 
	 */
	public function actionUpdateOrden()
	{
		$model=$this->loadModel($_POST['pk']);
		$this->performAjaxValidation($model);
		if(isset($_POST['value']))
		{
			$model->orden=$_POST['value'];
			$model->save();
		}
	}

	/**
	 * Guarda el comentario del Signo Vital
	 * 
	 */
	public function actionUpdatePrecio()
	{
		$model=$this->loadModel($_POST['pk']);
		$this->performAjaxValidation($model);
		if(isset($_POST['value']))
		{
			$model->precioWeb=$_POST['value'];
			$model->save();
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);	
			
		// if (!empty($model->foto_principal)) 
		// 	unlink(Yii::app()->basePath.'/../'.$model->foto_principal);		
		
		// if (!empty($model->foto_detalle)) 
		// 	unlink(Yii::app()->basePath.'/../'.$model->foto_detalle);

		// if (!empty($model->foto_descripcion)) 
		// 	unlink(Yii::app()->basePath.'/../'.$model->foto_descripcion);

		// if (!empty($model->foto_posologia)) 
		// 	unlink(Yii::app()->basePath.'/../'.$model->foto_posologia);

		// if (!empty($model->foto_uso)) 
		// 	unlink(Yii::app()->basePath.'/../'.$model->foto_uso);
			
		//BORRA El PRODUCTO Y SACA DEL INVENTARIO
		// $idInventario = TInventario::model()->with('idProducto')->find('t.id_producto = '.$id);
		// $modelInventario=TInventarioController::loadModel($idInventario->id_inventario);

		// $modelInventario->delete();
		$model->id_estatus=2;
		$model->save();		
		

		echo CJSON::encode(array(	
			'salida' => "OK",			
			'mensaje' => '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="glyphicon glyphicon-ok-sign"></i> El producto fue eliminado exitosamente.</div>',
			'id' => $id			
		));

		Yii::app()->end();



	}

	/**
	 * Lists all models.
	 */
	public function actionIndex( $search = '', $size = 18, $cat='', $marca = '')
	{
		// $dataProvider=new CActiveDataProvider('TProducto');

		$criteria = new CDbCriteria();
		$criteriaCat = new CDbCriteria();
		$criteriaMarca = new CDbCriteria();
		$catCount=[];
		$marcaCount=[];

		//$model->unsetAttributes(); 

		// if(isset($_GET['ajax']) && $_GET['ajax']==='productos')
		// {
		// 	$salidaCat='';
		// 	$criteriaCat->select = array('idProductoCategoria.id_producto_categoria,idProductoCategoria.descripcion,count(*) as items');
	 //        $criteriaCat->with = array('idProductoCategoria');
	 //        $criteriaCat->condition="t.id_estatus = 1 AND t.descripcion like '%$search%'";
	 //        $criteriaCat->group = 'idProductoCategoria.id_producto_categoria,idProductoCategoria.descripcion';
	 //        $catCount = TProducto::model()->findAll($criteriaCat);

	 //        if (count($catCount) > 0 ) {
                   
  //           	foreach ($catCount as $key => $value) {
            		
	 //                $salidaCat.='<li>
	 //                    <a href="'.Yii::app()->createUrl('bms/tProducto/index/cat/'.$value->idProductoCategoria->id_producto_categoria).'" title="">'.$value->idProductoCategoria->descripcion.'</a> <span>('.$value->items.')</span>
	 //                </li>';
  //                }
  //           }

		// 	echo CJSON::encode(array(	
		// 		'salida' => "OK",			
		// 		'catCount' => $salidaCat
		// 	));
		// 	Yii::app()->end();
		// }
	    
	    //$cat='';

        // $criteriaMarca->select = array('idMarca.id_datos_basicos,idMarca.nombres,idProductoCategoria.id_producto_categoria,count(*) as items');
        // $criteriaMarca->with = array('idMarca','idProductoCategoria');
        // $criteriaMarca->condition='t.id_estatus = 1 ';
        // $criteriaMarca->group = 'idMarca.id_datos_basicos,idMarca.nombres,idProductoCategoria.id_producto_categoria';


		
		if ((strlen( $cat ) > 0 && strlen( $search ) == 0) || strlen( $marca ) > 0 ) {

			if (strlen( $marca ) > 0) {
				$criteria->addSearchCondition('idProductoCategoria.id_producto_categoria', $cat, true, 'OR' );
				$criteria->addSearchCondition('idMarca.id_datos_basicos', $marca, true, 'AND' );
				$criteria->with = array('idMarca','idProductoCategoria');
			}else{
				$criteria->addSearchCondition('idProductoCategoria.id_producto_categoria', $cat, true, 'AND' );
				//$criteria->addSearchCondition('idMarca.id_datos_basicos', $marca, true, 'AND' );
				$criteria->with = array('idProductoCategoria');
			}

			$criteriaMarca->select = array('idMarca.id_datos_basicos,idMarca.nombres,idProductoCategoria.id_producto_categoria,count(*) as items');
	        $criteriaMarca->with = array('idMarca','idProductoCategoria');
	        $criteriaMarca->condition='t.id_estatus = 1 AND idProductoCategoria.id_producto_categoria= '.$cat;
	        $criteriaMarca->group = 'idMarca.id_datos_basicos,idMarca.nombres,idProductoCategoria.id_producto_categoria';

	        $marcaCount = TProducto::model()->findAll($criteriaMarca);
	      

		}else if( strlen( $search ) > 0  && strlen( $cat ) > 0 && strlen( $marca ) > 0){
			
	        $criteria->addSearchCondition('t.descripcion', $search, true, 'OR' );
	        $criteria->addSearchCondition('t.codigo', $search, true, 'OR');
        	$criteria->addSearchCondition('idMarca.nombres', $search, true, 'OR');
        	$criteria->addSearchCondition('idProductoCategoria.id_producto_categoria', $cat, true, 'AND' );
        	$criteria->addSearchCondition('idMarca.id_datos_basicos', $marca, true, 'AND' );
        	$criteria->with = array('idMarca','idProductoCategoria');

        	$criteriaMarca->select = array('idMarca.id_datos_basicos,idMarca.nombres,idProductoCategoria.id_producto_categoria,count(*) as items');
	        $criteriaMarca->with = array('idMarca','idProductoCategoria');
	        $criteriaMarca->condition='t.id_estatus = 1 AND idProductoCategoria.id_producto_categoria= '.$cat;
	        $criteriaMarca->group = 'idMarca.id_datos_basicos,idMarca.nombres,idProductoCategoria.id_producto_categoria';

	        $marcaCount = TProducto::model()->findAll($criteriaMarca);
	        
	    }else if (strlen( $search ) > 0  && strlen( $cat ) == 0 && strlen( $marca ) == 0 ) {
	    	
	        $criteria->addSearchCondition('t.descripcion', $search, true, 'OR' );
	        $criteria->addSearchCondition('t.codigo', $search, true, 'OR');
        	$criteria->addSearchCondition('idMarca.nombres', $search, true, 'OR');        	
        	$criteria->with = array('idMarca');


        	// $criteriaCat->addSearchCondition('t.descripcion', $search, true, 'OR' );
	        // $criteriaCat->addSearchCondition('t.codigo', $search, true, 'OR');
        	// $criteriaCat->addSearchCondition('idMarca.nombre', $search, true, 'OR');
        	$criteriaCat->select = array('idProductoCategoria.id_producto_categoria,idProductoCategoria.descripcion,count(*) as items');
	        $criteriaCat->with = array('idProductoCategoria');
	        $criteriaCat->condition="t.id_estatus = 1  AND t.descripcion like '%$search%'";
	        $criteriaCat->group = 'idProductoCategoria.id_producto_categoria,idProductoCategoria.descripcion';
	        $catCount = TProducto::model()->findAll($criteriaCat);
	        

	    }else{

	    	// $criteriaCat->addSearchCondition('t.descripcion', $search, true, 'OR' );
	     //    $criteriaCat->addSearchCondition('t.codigo', $search, true, 'OR');
      //   	$criteriaCat->addSearchCondition('idMarca.nombre', $search, true, 'OR');
	    	$criteriaCat->select = array('idProductoCategoria.id_producto_categoria,idProductoCategoria.descripcion,count(*) as items');
	        $criteriaCat->with = array('idProductoCategoria');
	        $criteriaCat->condition="t.id_estatus = 1 AND t.descripcion like '%$search%'";
	        $criteriaCat->group = 'idProductoCategoria.id_producto_categoria,idProductoCategoria.descripcion';
	        $catCount = TProducto::model()->findAll($criteriaCat);        

	        
	    }    

	    $criteriaTotal=new CDbCriteria;
        $criteriaTotal->select = array('count(*) as items');
        $criteriaTotal->with = 'tCarritoDetalles';
        $criteriaTotal->condition='t.id_datos_basicos = '.Yii::app()->user->id_persona.' AND t.id_estatus = 1 AND t.id_tipo_accion IS NULL';

	    $totalProducto = TCarrito::model()->find($criteriaTotal)->items;

		$criteriaC=new CDbCriteria;
        $criteriaC->select = array('sum((`tInventarios`.`precio`) * `tCarritoDetalles`.`cantidad` ) as total');
        $criteriaC->with = array('tCarritoDetalles','tCarritoDetalles.idProducto','tCarritoDetalles.idProducto.tInventarios');
        $criteriaC->condition='t.id_datos_basicos = '.Yii::app()->user->id_persona.' AND t.id_estatus = 1 AND t.id_tipo_accion IS NULL';
		$totalCarrito = TCarrito::model()->find($criteriaC)->total;

	    
	    $dataProvider = new CActiveDataProvider( 'TProducto', array( 'criteria' => $criteria, 'pagination'=>array('pageSize'=>$size,), ) );

	    $dataProviderCart = new CActiveDataProvider('TCarritoDetalle');

	    Yii::app()->theme = 'bms';
      	$this->layout ='//layouts/portalCliente';      	

	    $categorias = TProductoCategoria::model()->findAll('t.ind_web=1 AND t.id_estatus = 1');

	    $this->render('index', array( 'dataProvider' => $dataProvider, 'dataProviderCart'=>$dataProviderCart,'totalProducto'=>$totalProducto,'totalCarrito'=>$totalCarrito,'categorias'=>$categorias,'catCount'=>$catCount,'marcaCount'=>$marcaCount ) );
			

		// $this->render('index',array(
		// 	'dataProvider'=>$dataProvider,
		// ));
	}

	/**
	 * Lists all models.
	 */
	public function actionCategoria()
	{
		// $dataProvider=new CActiveDataProvider('TProducto');

		$criteria = new CDbCriteria();
		$criteriaCat = new CDbCriteria();
		$criteriaMarca = new CDbCriteria();
		$catCount=[];
		$marcaCount=[];
		$search=$_GET['search'];
		$cat=isset($_GET['cat']) ? $_GET['cat'] : '';
		$marca=isset($_GET['marca']) ? $_GET['marca'] : '';
		$size=isset($_GET['size']) ? $_GET['size'] : 18;

		//$model->unsetAttributes(); 

		// if(isset($_GET['ajax']) && $_GET['ajax']==='productos')
		// {
			

		//$model->unsetAttributes(); 

		// if(isset($_GET['ajax']) && $_GET['ajax']==='productos')
		// {
		// 	$salidaCat='';
		// 	$criteriaCat->select = array('idProductoCategoria.id_producto_categoria,idProductoCategoria.descripcion,count(*) as items');
	 //        $criteriaCat->with = array('idProductoCategoria');
	 //        $criteriaCat->condition="t.id_estatus = 1 AND t.descripcion like '%$search%'";
	 //        $criteriaCat->group = 'idProductoCategoria.id_producto_categoria,idProductoCategoria.descripcion';
	 //        $catCount = TProducto::model()->findAll($criteriaCat);

	 //        if (count($catCount) > 0 ) {
                   
  //           	foreach ($catCount as $key => $value) {
            		
	 //                $salidaCat.='<li>
	 //                    <a href="'.Yii::app()->createUrl('bms/tProducto/index/cat/'.$value->idProductoCategoria->id_producto_categoria).'" title="">'.$value->idProductoCategoria->descripcion.'</a> <span>('.$value->items.')</span>
	 //                </li>';
  //                }
  //           }

		// 	echo CJSON::encode(array(	
		// 		'salida' => "OK",			
		// 		'catCount' => $salidaCat
		// 	));
		// 	Yii::app()->end();
		// }
	    
	    //$cat='';

        // $criteriaMarca->select = array('idMarca.id_datos_basicos,idMarca.nombres,idProductoCategoria.id_producto_categoria,count(*) as items');
        // $criteriaMarca->with = array('idMarca','idProductoCategoria');
        // $criteriaMarca->condition='t.id_estatus = 1 ';
        // $criteriaMarca->group = 'idMarca.id_datos_basicos,idMarca.nombres,idProductoCategoria.id_producto_categoria';


		
		if ((strlen( $cat ) > 0 && strlen( $search ) == 0) || strlen( $marca ) > 0 ) {

			if (strlen( $marca ) > 0) {
				$criteria->addSearchCondition('idProductoCategoria.id_producto_categoria', $cat, true, 'OR' );
				$criteria->addSearchCondition('idMarca.id_datos_basicos', $marca, true, 'AND' );
				$criteria->with = array('idMarca','idProductoCategoria');
			}else{
				$criteria->addSearchCondition('idProductoCategoria.id_producto_categoria', $cat, true, 'AND' );
				//$criteria->addSearchCondition('idMarca.id_datos_basicos', $marca, true, 'AND' );
				$criteria->with = array('idProductoCategoria');
			}

			$criteriaMarca->select = array('idMarca.id_datos_basicos,idMarca.nombres,idProductoCategoria.id_producto_categoria,count(*) as items');
	        $criteriaMarca->with = array('idMarca','idProductoCategoria');
	        $criteriaMarca->condition='t.id_estatus = 1 AND idProductoCategoria.id_producto_categoria= '.$cat;
	        $criteriaMarca->group = 'idMarca.id_datos_basicos,idMarca.nombres,idProductoCategoria.id_producto_categoria';

	        $marcaCount = TProducto::model()->findAll($criteriaMarca);	      
	        
		}else if( strlen( $search ) > 0  && strlen( $cat ) > 0 && strlen( $marca ) > 0){
			
	        $criteria->addSearchCondition('t.descripcion', $search, true, 'OR' );
	        $criteria->addSearchCondition('t.codigo', $search, true, 'OR');
        	$criteria->addSearchCondition('idMarca.nombres', $search, true, 'OR');
        	$criteria->addSearchCondition('idProductoCategoria.id_producto_categoria', $cat, true, 'AND' );
        	$criteria->addSearchCondition('idMarca.id_datos_basicos', $marca, true, 'AND' );
        	$criteria->with = array('idMarca','idProductoCategoria');

        	$criteriaMarca->select = array('idMarca.id_datos_basicos,idMarca.nombres,idProductoCategoria.id_producto_categoria,count(*) as items');
	        $criteriaMarca->with = array('idMarca','idProductoCategoria');
	        $criteriaMarca->condition='t.id_estatus = 1 AND idProductoCategoria.id_producto_categoria= '.$cat;
	        $criteriaMarca->group = 'idMarca.id_datos_basicos,idMarca.nombres,idProductoCategoria.id_producto_categoria';

	        $marcaCount = TProducto::model()->findAll($criteriaMarca);
	       
	    }else if (strlen( $search ) > 0  && strlen( $cat ) == 0 && strlen( $marca ) == 0 ) {	    	
	    	
	        $criteria->addSearchCondition('t.descripcion', $search, true, 'OR' );
	        $criteria->addSearchCondition('t.codigo', $search, true, 'OR');
        	$criteria->addSearchCondition('idMarca.nombres', $search, true, 'OR');        	
        	$criteria->with = array('idMarca');


        	// $criteriaCat->addSearchCondition('t.descripcion', $search, true, 'OR' );
	        // $criteriaCat->addSearchCondition('t.codigo', $search, true, 'OR');
        	// $criteriaCat->addSearchCondition('idMarca.nombre', $search, true, 'OR');
        	$criteriaCat->select = array('idProductoCategoria.id_producto_categoria,idProductoCategoria.descripcion,count(*) as items');
	        $criteriaCat->with = array('idProductoCategoria');
	        $criteriaCat->condition="t.id_estatus = 1  AND t.descripcion like '%$search%'";
	        $criteriaCat->group = 'idProductoCategoria.id_producto_categoria,idProductoCategoria.descripcion';
	        $catCount = TProducto::model()->findAll($criteriaCat);	        
	        
	    }else{

	    	// $criteriaCat->addSearchCondition('t.descripcion', $search, true, 'OR' );
	     //    $criteriaCat->addSearchCondition('t.codigo', $search, true, 'OR');
      //   	$criteriaCat->addSearchCondition('idMarca.nombre', $search, true, 'OR');

	    	$criteria->addSearchCondition('t.descripcion', $search, true, 'OR' );
	        $criteria->addSearchCondition('t.codigo', $search, true, 'OR');
        	$criteria->addSearchCondition('idMarca.nombres', $search, true, 'OR');
        	$criteria->addSearchCondition('idProductoCategoria.id_producto_categoria', $cat, true, 'AND' );
        	//if (!empty($marca)) {
        	$criteria->addSearchCondition('idMarca.id_datos_basicos', $marca, true, 'AND' );
        	//}
        	//$criteria->addSearchCondition('idProductoCategoria.id_producto_categoria', $cat, true, 'AND' );
        	//$criteria->addSearchCondition('idMarca.id_datos_basicos', $marca, true, 'AND' );
        	$criteria->with = array('idMarca','idProductoCategoria');

	    	$criteriaCat->select = array('idProductoCategoria.id_producto_categoria,idProductoCategoria.descripcion,count(*) as items');
	        $criteriaCat->with = array('idProductoCategoria');
	        $criteriaCat->condition="t.id_estatus = 1 AND t.descripcion like '%$search%'";
	        $criteriaCat->group = 'idProductoCategoria.id_producto_categoria,idProductoCategoria.descripcion';
	        $catCount = TProducto::model()->findAll($criteriaCat);   


	        $criteriaMarca->select = array('idMarca.id_datos_basicos,idMarca.nombres,idProductoCategoria.id_producto_categoria,count(*) as items');
	        $criteriaMarca->with = array('idMarca','idProductoCategoria');
	        $criteriaMarca->condition="t.id_estatus = 1 AND t.descripcion like '%$search%' AND idProductoCategoria.id_producto_categoria= ".$cat;
	        $criteriaMarca->group = 'idMarca.id_datos_basicos,idMarca.nombres,idProductoCategoria.id_producto_categoria';

	        $marcaCount = TProducto::model()->findAll($criteriaMarca);     

	    }    

	    $criteriaTotal=new CDbCriteria;
        $criteriaTotal->select = array('count(*) as items');
        $criteriaTotal->with = 'tCarritoDetalles';
        $criteriaTotal->condition='t.id_datos_basicos = '.Yii::app()->user->id_persona.' AND t.id_estatus = 1 AND t.id_tipo_accion IS NULL';

	    $totalProducto = TCarrito::model()->find($criteriaTotal)->items;

		$criteriaC=new CDbCriteria;
        $criteriaC->select = array('sum((`tInventarios`.`precio`) * `tCarritoDetalles`.`cantidad` ) as total');
        $criteriaC->with = array('tCarritoDetalles','tCarritoDetalles.idProducto','tCarritoDetalles.idProducto.tInventarios');
        $criteriaC->condition='t.id_datos_basicos = '.Yii::app()->user->id_persona.' AND t.id_estatus = 1 AND t.id_tipo_accion IS NULL';
		$totalCarrito = TCarrito::model()->find($criteriaC)->total;

	    
	    $dataProvider = new CActiveDataProvider( 'TProducto', array( 'criteria' => $criteria, 'pagination'=>array('pageSize'=>$size,), ) );

	    //$dataProviderCart = new CActiveDataProvider('TCarritoDetalle');

	    // Yii::app()->theme = 'bms';
     //  	$this->layout ='//layouts/portalCliente';      	

	    //$categorias = TProductoCategoria::model()->findAll('t.ind_web=1 AND t.id_estatus = 1');


        $gridProductos = $this->renderPartial('adminFront', array( 'dataProvider' => $dataProvider),true,false);

        $salidaCat='';
        $salidaMarca='';
			// $criteriaCat->select = array('idProductoCategoria.id_producto_categoria,idProductoCategoria.descripcion,count(*) as items');
	  //       $criteriaCat->with = array('idProductoCategoria');
	  //       $criteriaCat->condition="t.id_estatus = 1 AND t.descripcion like '%$search%'";
	  //       $criteriaCat->group = 'idProductoCategoria.id_producto_categoria,idProductoCategoria.descripcion';
	  //       $catCount = TProducto::model()->findAll($criteriaCat);

	        if (count($catCount) > 0 ) {
                   
            	foreach ($catCount as $key => $value) {
            		
	                $salidaCat.='<li>
	                    <a href="#" onclick="js:buscarCat('.$value->idProductoCategoria->id_producto_categoria.',null,\''.$search.'\');" title="">'.$value->idProductoCategoria->descripcion.'</a> <span>('.$value->items.')</span>
	                </li>';
                 }
            }



            if (count($marcaCount) > 0 ) {
              	foreach ($marcaCount as $key3 => $value3) {
                    	
                    $salidaMarca.='
                        <li>
                            <a href="#" onclick="js:buscarCat('.$value3->idProductoCategoria->id_producto_categoria.','.$value3->idMarca->id_datos_basicos.',\''.$search.'\');" title="">'.$value3->idMarca->nombres.'</a> <span>('.$value3->items.')</span>
                        </li>';
                }
            }

			echo CJSON::encode(array(	
				'salida' => "OK",			
				'catCount' => $salidaCat,
				'marcaCount' => $salidaMarca,
				'gridProductos'=>$gridProductos
			));
			Yii::app()->end();
		//}
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TProducto('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TProducto']))
			$model->attributes=$_GET['TProducto'];

		$this->layout ='//layouts/column2';
		
		if (Yii::app()->request->isAjaxRequest) {
		    $cs = Yii::app()->clientScript;
		    $cs->scriptMap['jquery.js'] = false;
		    $cs->scriptMap['jquery.min.js'] = false;
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TProducto the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TProducto::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TProducto $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tproducto-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
