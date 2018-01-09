<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'BMS',
	'theme'=>'bms',
	'language'=>'es',
	
	'aliases' => array(       
        'booster' => realpath(__DIR__ . '/../extensions/booster'), // change this if necessary
    ),	

	// preloading 'log' component
	'preload'=>array('log','booster'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.controllers.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'bms',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1','http://104.197.207.184'),
		),'auth','seguridad','configuracion','catalogo','bms','donacion'
	),

	// application components
	'components'=>array(

		'clientScript'=>array(
            'coreScriptPosition'=>CClientScript::POS_END,
            'defaultScriptPosition'=>CClientScript::POS_END,
            'defaultScriptFilePosition'=>CClientScript::POS_END
        ),
		/*'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),*/
		'user'=>array(
			'class' => 'auth.components.AuthWebUser',
			//'admins' => array('admin'), // users with full access
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),

		'ePdf' => array(
			'class'			=> 'ext.yii-pdf.EYiiPdf',
			'params'		=> array(
				'mpdf'	   => array(
					'librarySourcePath' => 'application.vendor.mpdf.*',
					'constants'			=> array(
						'_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
					),
					'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder.
					/*'defaultParams'	  => array( // More info: http://mpdf1.com/manual/index.php?tid=184
						'mode'				=> '', //  This parameter specifies the mode of the new document.
						'format'			=> 'A4', // format A4, A5, ...
						'default_font_size' => 0, // Sets the default document font size in points (pt)
						'default_font'		=> '', // Sets the default font-family for the new document.
						'mgl'				=> 15, // margin_left. Sets the page margins for the new document.
						'mgr'				=> 15, // margin_right
						'mgt'				=> 16, // margin_top
						'mgb'				=> 16, // margin_bottom
						'mgh'				=> 9, // margin_header
						'mgf'				=> 9, // margin_footer
						'orientation'		=> 'P', // landscape or portrait orientation
					)*/
				),
				'HTML2PDF' => array(
					'librarySourcePath' => 'application.vendor.html2pdf.*',
					'classFile'			=> 'html2pdf.class.php', // For adding to Yii::$classMap
					/*'defaultParams'	  => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
						'orientation' => 'P', // landscape or portrait orientation
						'format'	  => 'A4', // format A4, A5, ...
						'language'	  => 'en', // language: fr, en, it ...
						'unicode'	  => true, // TRUE means clustering the input text IS unicode (default = true)
						'encoding'	  => 'UTF-8', // charset encoding; Default is UTF-8
						'marges'	  => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
					)*/
				)
			),
		),

		'booster' => array(
		    'class' => 'booster.components.Booster',
		),

		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

		'authManager'=>array(
	        'class'=>'CDbAuthManager',
	        'connectionID'=>'db',
	        'itemTable'=>'bms_seguridad.authitem', // Tabla que contiene los elementos de autorizacion
        	'itemChildTable'=>'bms_seguridad.authitemchild', // Tabla que contiene los elementos padre-hijo
        	'assignmentTable'=>'bms_seguridad.authassignment', // Tabla que contiene la asignacion usuario-autorizacion o usuario-rol
        	'defaultRoles'=>array('guest'),
        	'showErrors'=>true,
        	'behaviors' => array(
				'auth' => array(
					'class' => 'auth.components.AuthBehavior',					
				),
			),

    	),	

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>YII_DEBUG ? null : 'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'biometabolicservice.servidor@gmail.com',
	),
);
