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
					'class' => 'col-sm-5 no-padding-right',
				),
			),
			'attributes' => array(
				'class' => 'form-control', 'tabindex' => 1, 'id' => 'username', 'placeholder' => 'Username'
			),
		));
		$this -> add(array(
				'name' => 'password',
				'type' => 'Password',
				'options' => array(
					'label' => 'Password',
					'label_attributes' => array(
						'class' => 'col-sm-5 no-padding-right',
					),
				),
				'attributes' => array(
					'class' => 'form-control', 'tabindex' => 2, 'id' => 'password', 'placeholder' => 'Password'
				),
		));

		/* $this -> add(array(
		    'type' => 'DoctrineModule\Form\Element\ObjectSelect',
		    'name' => 'lang',
			'attributes' => array(
				'class' => 'col-xs-12 form-control', 'tabindex' => 5, 'id' => 'lang'
			),
		    'options' => array(
		    	'label' => 'Language',
	    		'label_attributes' => array(
    				'class' => 'col-sm-5 no-padding-right',
	    		),
		        'object_manager' => $objectManager,
				'display_empty_item' => true,
		    	'empty_item_label' => 'Select language...',
		        'target_class'   => 'Admin\Entity\KintaiLanguage',
		        'property'       => 'langTitle',
		        'is_method'      => true,
		        'find_method'    => array(
		            'name'   => 'findBy',
		            'params' => array(
		            	'criteria' => array(),
		                'orderBy'  => array('langTitle' => 'ASC'),
		            ),
		        ),
		    ),
		)); */

		$this -> setAttributes(array(
				'method' => 'post',
				'class' => 'form-horizontal',
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