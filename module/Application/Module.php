<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Debug\Debug;
use Zend\Session\SessionManager;
use Zend\Session\Container;
use Zend\Authentication\AuthenticationService;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();

        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener -> attach($eventManager);

//         $eventManager -> attach(MvcEvent::EVENT_DISPATCH, array($this, 'bootstrapSession'), 100);
//         $eventManager -> attach(MvcEvent::EVENT_DISPATCH, array($this, 'checkLogin'), 101);


        $eventManager->getSharedManager()->attach('Zend\Mvc\Controller\AbstractController', 'dispatch', array($this, 'selectLayout'), 100);
    }

    public function bootstrapSession(MvcEvent $e) {
    	$session = $e->getApplication() -> getServiceManager() -> get('session');
    	$session->start();
    }

    public function getServiceConfig() {
    	return array(
    			'factories' => array(
    					'session' => function ($sm) {
    						$config = $sm->get('config');
    						if (isset($config['session'])) {
    							$session = $config['session'];

    							$sessionConfig = null;
    							if (isset($session['config'])) {
    								$class = isset($session['config']['class'])  ? $session['config']['class'] : 'Zend\Session\Config\SessionConfig';
    								$options = isset($session['config']['options']) ? $session['config']['options'] : array();
    								$sessionConfig = new $class();
    								$sessionConfig->setOptions($options);
    							}

    							$sessionStorage = null;
    							if (isset($session['storage'])) {
    								$class = $session['storage'];
    								$sessionStorage = new $class();
    							}

    							$sessionSaveHandler = null;
    							if (isset($session['save_handler'])) {
    								// class should be fetched from service manager since it will require constructor arguments
    								$sessionSaveHandler = $sm->get($session['save_handler']);
    							}

    							$sessionManager = new SessionManager($sessionConfig, $sessionStorage, $sessionSaveHandler);

    							if (isset($session['validators'])) {
    								$chain = $sessionManager->getValidatorChain();
    								foreach ($session['validators'] as $validator) {
    									$validator = new $validator();
    									$chain->attach('session.validate', array($validator, 'isValid'));

    								}
    							}
    						} else {
    							$sessionManager = new SessionManager();
    						}
    						Container::setDefaultManager($sessionManager);
    						return $sessionManager;
    					}, // end 'session'

    					'Zend\Authentication\AuthenticationService' => function($sm) {
    						return new AuthenticationService();
    					},
    			),
    	);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function checkLogin(MvcEvent $e) {
    	/* @var $route \Zend\Mvc\Router\Http\RouteMatch */
    	$route = $e -> getRouteMatch();

    	$controller = $route -> getParam('controller');
    	$moduleNamespace = substr($controller, 0, strpos($controller, '\\'));

    	if($moduleNamespace == 'Admin') {
    		$sm = $e -> getApplication() -> getServiceManager();
    		/* @var $auth \Zend\Authentication\AuthenticationService */
    		$auth = $sm -> get('Zend\Authentication\AuthenticationService');


    		if($controller != 'Admin\Controller\Auth' && !$auth -> hasIdentity()){
    			$request = $e -> getRequest();
    			$response = $e -> getResponse(); /* @var $response \Zend\Stdlib\ResponseInterface */
    			if($request -> isXmlHttpRequest()) {
    				$ajax = \Zend\Serializer\Serializer::factory('Json') -> serialize(array(
    						'success' => false,
    						'needLogin' => true,
    						'message' => 'You have not logged in yet!',
    				));
    				$response -> setHeaders($response -> getHeaders() -> addHeaderLine('Content-type', 'application/json'));
    				$response -> setContent($ajax);
    				$response -> sendHeaders();
    				return $response;
    			}

    			$url = $e -> getRouter() -> assemble (array('controller' => 'auth', 'action' => 'index'), array ('name' => 'admin/default'));
    			$response -> setHeaders($response -> getHeaders() -> addHeaderLine ( 'Location', $url));
    			$response -> setStatusCode (302);
    			$response -> sendHeaders();
    			return $response;
    		}
    	}
    }

    public function selectLayout($e) {
    	$controller      = $e->getTarget();
    	$controllerClass = get_class($controller);
    	$moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
//     	$config          = $e->getApplication()->getServiceManager()->get('config');
    	if($moduleNamespace == 'Admin') {
    		$controller -> layout('layout/admin');
    	}
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ 	=> __DIR__ . '/src/' . __NAMESPACE__,
                	'Admin' 		=> __DIR__ . '/src/Admin',
                	'Entity'		=> __DIR__ . '/src/Entity',
                ),
            ),
        );
    }
}
