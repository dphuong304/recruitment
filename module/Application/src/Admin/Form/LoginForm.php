<?php
namespace Admin\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

class LoginForm extends Form {
	public function __construct() {
		parent::__construct('loginForm');
		$this -> add(array(
			'name' => 'username',
			'type' => 'Text',
			'options' => array(
				'label' => 'Username',
				'label_attributes' => array(
					'class' => 'label',
				),
			),
			'attributes' => array(
				'tabindex' => 1, 'id' => 'username'
			),
		));
		$this -> add(array(
				'name' => 'password',
				'type' => 'Password',
				'options' => array(
					'label' => 'Password',
					'label_attributes' => array(
						'class' => 'label',
					),
				),
				'attributes' => array(
					'tabindex' => 2, 'id' => 'password'
				),
		));

		$this -> setAttributes(array(
				'method' => 'post',
				'class' => 'smart-form client-form',
				));
		$this -> setInputFilter($this -> _getInputFilter());
	}

	protected function _getInputFilter() {
		$inputFilter = new InputFilter();

		$inputFilter -> add(array(
				'name' => 'username',
				'required' => true,
				'filters' => array(
						array('name' => 'StringTrim'),
						array('name' => 'StripTags'),
						),

				'validators' => array(
						array(
								'name' => 'NotEmpty',
								'options' => array(
										'messages' => array(
												\Zend\Validator\NotEmpty::IS_EMPTY => 'Please enter your username!'
												),
										),
							)
						),
				));

		$inputFilter -> add(array(
					'name' => 'password',
					'required' => true,
					'validators' => array(
								array(
								'name' => 'NotEmpty',
								'options' => array(
										'messages' => array(
												\Zend\Validator\NotEmpty::IS_EMPTY => 'Please enter your password!'
												),
										),
							)
						)
				));

		return $inputFilter;

	}
}