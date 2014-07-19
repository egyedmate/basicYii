<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
// http://www.getyiistrap.com/site/started bootsrtap description

Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
Yii::setPathOfAlias('yiibooster', dirname(__FILE__).'/../extensions/yiibooster');
//Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap2');
Yii::setPathOfAlias('yiiwheels', dirname(__FILE__).'/../extensions/yiiwheels');

return array(
        'theme' => 'bootstrap',
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
        'preload' => array(
            'log',
            'bootstrap'
        ),
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                'bootstrap.helpers.TbHtml',
                'application.modules.user.models.*',
                'application.modules.user.components.*',
                'application.modules.rights.*',
                'application.modules.rights.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'gii',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
                        'generatorPaths'=>array(
                            'bootstrap.gii',
                        ),
		),
                'user'=>array(
                        'tableUsers' => 'users',
                        'tableProfiles' => 'profiles',
                        'tableProfileFields' => 'profiles_fields',
                             # encrypting method (php hash function)
                        'hash' => 'md5',

                        # send activation email
                        'sendActivationMail' => true,

                        # allow access for non-activated users
                        'loginNotActiv' => false,

                        # activate user on registration (only sendActivationMail = false)
                        'activeAfterRegister' => false,

                        # automatically login from registration
                        'autoLogin' => true,

                        # registration path
                        'registrationUrl' => array('/user/registration'),

                        # recovery password path
                        'recoveryUrl' => array('/user/recovery'),

                        # login form path
                        'loginUrl' => array('/user/login'),

                        # page after login
                        'returnUrl' => array('/user/profile'),

                        # page after logout
                        'returnLogoutUrl' => array('/user/login'),
                ),
                'rights'=>array(
                       'superuserName'=>'Admin', // Name of the role with super user privileges. 
                       'authenticatedName'=>'Authenticated',  // Name of the authenticated user role. 
                       'userIdColumn'=>'id', // Name of the user id column in the database. 
                       'userNameColumn'=>'username',  // Name of the user name column in the database. 
                       'enableBizRule'=>true,  // Whether to enable authorization item business rules. 
                       'enableBizRuleData'=>true,   // Whether to enable data for business rules. 
                       'displayDescription'=>true,  // Whether to use item description instead of name. 
                       'flashSuccessKey'=>'RightsSuccess', // Key to use for setting success flash messages. 
                       'flashErrorKey'=>'RightsError', // Key to use for setting error flash messages. 

                       'baseUrl'=>'/rights', // Base URL for Rights. Change if module is nested. 
                       'layout'=>'rights.views.layouts.main',  // Layout to use for displaying Rights. 
                       'appLayout'=>'application.views.layouts.main', // Application layout. 
                       'cssFile'=>'rights.css', // Style sheet file to use for Rights. 
                       'install'=>false,  // Whether to enable installer. 
                       'debug'=>false, 
                ),            
                'menubuilder' => array(
                        //'theme' => 'bootstrap', //comment for bluegrid theme (=default)
                        'checkInstall'=>false, //uncomment after first usage
                        //'cacheDuration'=> -1, //uncomment for disabling the menucaching
                        'languages' => array('en_us'),
                        //'supportedScenarios' => array('backend' => 'Backend', 'frontend' => 'Frontend', 'dashboard' => 'Dashboard'),
                        //set EMBDbAdapter to switch to mysql (checkInstall=>true on first run)
                        //'dataAdapterClass'=> 'EMBDbAdapter', //'EMBMongoDbAdapter',
                        //'dataFilterClass'=>'DataFilter',
                        //the available menus/lists for the preview
                        'previewMenus' => array(
                                'superfish'=>'Superfish',
                        )
                ),
	),
        'behaviors' => array(
            'language' => array(
                'class' => 'application.behaviors.LanguageConfigBehavior',
            ),
        ),
	// application components
	'components'=>array(
                'bootstrap'=>array(
                    'class'=>'bootstrap.components.TbApi',
                ),
                'yiiwheels' => array(
                    'class' => 'yiiwheels.YiiWheels',   
                ),
                'yiibooster' => array(
                    'class' => 'yiibooster.components.Booster',   
                ),
                'user'=>array(
                        'class'=>'RWebUser',
                        // enable cookie-based authentication
                        'allowAutoLogin'=>true,
                        'loginUrl'=>array('/user/login'),
                ),            
                'authManager'=>array(
                        'class'=>'RDbAuthManager',
                        'connectionID'=>'db',
                        'itemTable'=>'authitem',
                        'itemChildTable'=>'authitemchild',
                        'assignmentTable'=>'authassignment',
                        'rightsTable'=>'rights',
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
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
                'db' => array(
                    'connectionString' => 'pgsql:host=localhost;dbname=teszt;',
                    'emulatePrepare' => true,
                    'username' => 'postgres',
                    'password' => 'root',
                    'charset' => 'utf8',
                    
//                    	    'connectionString' => 'pgsql:host=effsystem.eu;dbname=hunline_teszt;',
//	    'emulatePrepare' => true,
//	    'username' => 'hunline',
//	    'password' => 'kalvaria410',
//	    'charset' => 'utf8',
                ),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
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
		'adminEmail'=>'webmaster@example.com',
	),
);