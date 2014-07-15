<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Debug\Debug;
use Zend\Mvc\MvcEvent;

use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as AuthStorage;
use Admin\Adapter\AuthenticationAdapter as AuthAdapter;

use Doctrine\ORM\EntityManager;

class LogoBaseController extends AbstractActionController
{
/**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     *
     * @var \Zend\Authentication\AuthenticationService
     */
    protected $auth;

    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     *
     * @param \Zend\Authentication\AuthenticationService $auth
     */
    public function setAuthService($auth) {
    	$this -> auth = $auth;
    }

    /**
     *
     * @return \Zend\Authentication\AuthenticationService
     */
	public function getAuthService() {
		if($this -> auth === null) {
			$this -> auth = $this -> getServiceLocator() -> get('Zend\Authentication\AuthenticationService');
			$adapter = new AuthAdapter($this -> getEntityManager());
			$storage = new AuthStorage('AdminAuth');
			$this -> auth -> setAdapter($adapter) -> setStorage($storage);
		}

		return $this -> auth;
	}

    /**
     *
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    public function onDispatch(MvcEvent $e) {
    	parent::onDispatch($e);

    	$this -> _checkLogin($e);
    }

    protected function _checkLogin(MvcEvent $e) {
    	$route = $e -> getRouteMatch();
    	$controller = $route -> getParam('controller');

    	$auth = $this -> getAuthService();
    	$sm = $this -> getServiceLocator();

    	if($controller != 'Admin\Controller\Auth' && !$auth -> hasIdentity()){
    		$request = $e -> getRequest();
    		$response = $e -> getResponse(); /* @var $response \Zend\Stdlib\ResponseInterface */
    		if($request -> isXmlHttpRequest()) {
    			$ajax = \Zend\Serializer\Serializer::factory('Json') -> serialize(array(
    					'success' => false,
    					'needLogin' => true,
    					'message' => $sm -> get('translator') -> translate('You have not logged in yet!'),
    			));
    			$response -> setHeaders($response -> getHeaders() -> addHeaderLine('Content-type', 'application/json'));
    			$response -> setContent($ajax);
    			$response -> sendHeaders();
    			return $response;
    		}

    		$url = $e -> getRouter() -> assemble (array('controller' => 'auth', 'action' => 'login'), array ('name' => 'admin/default'));
    		$response -> setHeaders($response -> getHeaders() -> addHeaderLine ( 'Location', $url));
    		$response -> setStatusCode (302);
    		$response -> sendHeaders();
    		return $response;
    	}

    }
}
