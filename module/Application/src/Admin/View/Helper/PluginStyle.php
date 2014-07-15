<?php
namespace Admin\View\Helper;

use Zend\View\Helper\AbstractHelper;

class PluginStyle extends AbstractHelper {

	protected $_paths = array();
	public function PluginStyle($paths = null) {
		return call_user_func_array(array($this, '__invoke'), func_get_args());
	}

	public function __invoke($paths = null) {
		if(empty($paths))
			return $this;

		if(is_string($paths))
			$paths = array($paths);

		$this -> _paths = $paths;
		return $this;
	}

	public function __call($method , $args) {
		if($method == 'add') {
			$this -> add($args[0]);
		}
	}

	public function add($path) {
		$this -> paths[] = $path;
		return $this;
	}

	public function __toString() {
		if(empty($this -> _paths))
			return '';
		$str = array();
		foreach($this -> _paths as $path) {
			$str[] = '<link rel="styleshhet" href="'.$path.'" />';
		}
		return implode(PHP_EOL, $str);
	}

} // end class