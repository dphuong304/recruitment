<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ), // end 'application'

            'admin' => array(
            		'type'    => 'Literal',
            		'options' => array(
            				'route'    => '/admin',
            				'defaults' => array(
            						'__NAMESPACE__' => 'Admin\Controller',
            						'controller'    => 'Index',
            						'action'        => 'index',
            				),
            		),
            		'may_terminate' => true,
            		'child_routes' => array(
            				'default' => array(
								'type'    => 'Segment',
								'options' => array(
									'route'    => '/[:controller[/:action]]',
									'constraints' => array(
										'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
										'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
									),
									'defaults' => array(
										'controller' => 'index',
										'action'	=> 'index',
									),
								),
								'may_terminate' => true,
								'child_routes' => array(
									'wildcard' => array(
										'type'    => 'Wildcard',
									), // end 'wilcard'
								), // end 'child_routes'
							), // end 'default'
            		),
            ), // end 'admin'
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
        	'navigation-admin' => 'Admin\Navigation\Service\AdminNavigationFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
//             'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
//         	'session' 		=> 'Zend\Session\SessionManager',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),

    'navigation' => array(
    	'admin' => require_once 'navigation.admin.config.php',
    ),


    'controllers' => array(
        'invokables' => array(
        	// Application
            'Application\Controller\Index' 	=> 'Application\Controller\IndexController',

            //Admin
            'Admin\Controller\Index' 		=> 'Admin\Controller\IndexController',
            'Admin\Controller\Product' 		=> 'Admin\Controller\ProductController',
            'Admin\Controller\Auth' 		=> 'Admin\Controller\AuthController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'layout/admin'			  => __DIR__ . '/../view/layout/admin.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),

    'view_helpers' => array(
    	'invokables' => array(
    		'pluginStyle' => 'Admin\View\Helper\PluginStyle',
    		'pluginScript' => 'Admin\View\Helper\PluginScript',
    	),
    ),

    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),

    // Doctrine config
    'doctrine' => array(
    		'driver' => array(
    				'Entity_driver' => array(
    						'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
    						'cache' => 'array',
    						'paths' => array(dirname(dirname(__FILE__)).'/src/Entity')
    				),
    				'orm_default' => array(
    						'drivers' => array(
    								'Entity' => 'Entity_driver'
    						)
    				)
    		), // end 'driver'
    ), // end doctrine
);
