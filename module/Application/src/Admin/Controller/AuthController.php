<?php
namespace Admin\Controller;

use Admin\Controller\LogoBaseController;
use Zend\View\Model\ViewModel;
use Admin\Form\LoginForm;


/**
 * AuthController
 *
 * @author
 *
 * @version
 *
 */
class AuthController extends LogoBaseController {
	/**
	 * The default action - show the home page
	 */
	public function indexAction() {
		// TODO Auto-generated AuthController::indexAction() default action
		if($this -> getAuthService() -> hasIdentity()){
			$this -> redirect() -> toRoute('admin');
			return false;
		}

		$this -> redirect() -> toRoute('admin/default', array('controller' => 'auth', 'action' => 'login'));
	}

	public function loginAction() {
		$this -> layout('layout/admin-login');
		$form = new LoginForm();

		$view = new ViewModel();

		return $view -> setVariables(array(
				'form' => $form,
		));
	}

	public function loginPostAction() {
		$request = $this -> getRequest();
		if(!$request -> isPost()) {
			$this -> redirect() -> toRoute('admin/default', array('action' => 'index', 'controller' => 'auth'));
		}

		$form = new LoginForm();
		$form -> setData($request -> getPost());

		if(!$form -> isValid()) {
			$message = array_shift(array_shift($form -> getMessages()));
			$this -> flashMessenger() -> addErrorMessage($message);
			$this -> redirect() -> toRoute('admin/default', array('action' => 'login', 'controller' => 'auth'));
			return false;
		}

		$username = $form -> get('username') -> getValue();
		$password = $form -> get('password') -> getValue();

		// check login
		$auth = $this -> getAuthService();

		$auth -> getAdapter() -> setIdentity($username) -> setCredential($password);
		$result = $auth -> authenticate();

		if(!$result -> isValid()) {
			foreach($result -> getMessages() as $message)
				$this -> flashMessenger() -> addErrorMessage($message);

			$this -> redirect() -> toRoute('admin/default', array('controller' => 'auth', 'action' => 'login'));
			return false;
		}

		$this->getAuthService()->getStorage()->write($result -> getIdentity());
		$this -> redirect() -> toRoute('admin');
	}

	public function logoutAction() {
		$this -> getAuthService() -> clearIdentity();
		$this -> redirect() -> toRoute('admin/default', array('controller' => 'auth', 'action' => 'login'));
	}
}