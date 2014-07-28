<?php
namespace Admin\Adapter;

use Zend\Authentication\Adapter\AbstractAdapter;
use Zend\Authentication\Adapter\Exception;
use Zend\Authentication\Result as AuthenticationResult;
use Zend\Debug\Debug;

use Doctrine\Common\Collections\Criteria;

class AuthenticationAdapter extends AbstractAdapter {

	/**
	 *
	 * @var \Doctrine\ORM\EntityManager
	 */
	protected $em = null;

	/**
	 *
	 * @param \Doctrine\ORM\EntityManager $entityManager
	 */
	public function __construct($entityManager) {
		$this -> em = $entityManager;
	}

	/**
	 *
	 * @param \Doctrine\ORM\EntityManager $em
	 * @return \Admin\Adapter\AuthenticationAdapter
	 */
	public function setEntityManager($em) {
		$this -> em = $em;
		return $this;
	}

	/**
	 *
	 * @return \Doctrine\ORM\EntityManager
	 */
	public function getEntityManager() {
		return $this -> em;
	}



	/**
	 * (non-PHPdoc)
	 * @return \Zend\Authentication\Result
	 */
	public function authenticate() {
		$username = $this -> getIdentity();
		$password = $this -> getCredential();

		try {
			$em = $this -> getEntityManager();
			$userEntityName = "Entity\WpUsers";

			// check admin information
			/* @var $user Entity\WpUsers */
			$user = $em -> getRepository($userEntityName) -> findOneBy(array(
					'userLogin' => $username,
			));
			if(!$user) {
				$result = array(
						'code' => AuthenticationResult::FAILURE_IDENTITY_NOT_FOUND,
						'identity' => null,
						'messages' => array('Incorrect Username!')
				);
				return $this -> createAuthenticationResult($result);
			}

			$checkPass = \Entity\WpUsers::hashPassword($user, $password);

			if(!$checkPass) {
				$result = array(
					'code' => AuthenticationResult::FAILURE_CREDENTIAL_INVALID,
					'identity' => null,
					'messages' => array('Incorrect Password!')
				);
				return $this -> createAuthenticationResult($result);
			}

			// more validations such as:  expired date can be written below ...


			$result = array(
					'code' => AuthenticationResult::SUCCESS,
					'identity' => $user,
					'messages' => array("Login successfully!"),
					);

			return $this -> createAuthenticationResult($result);
		}
		catch(\Exception $e) {
			$result = array(
				'code' => AuthenticationResult::FAILURE,
				'identity' => null,
				'messages' => array($e -> getMessage())
			);
			return $this -> createAuthenticationResult($result);
		}
	}

	/**
	 * Creates a Zend\Authentication\Result object from the information that has been collected
	 * during the authenticate() attempt.
	 *
	 * @return \Zend\Authentication\Result
	 */
	protected function createAuthenticationResult($result)
	{
		return new AuthenticationResult(
				$result['code'],
				$result['identity'],
				$result['messages']
		);
	}
}