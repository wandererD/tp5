<?php
namespace app\admin\controller;

use app\admin\controller\Base as baseController;

class Index extends baseController
{
	public function _initialize()
	{
		parent::_initialize();
		// $this->request = Request::instance();
	}
	
    public function index() 
    { 
    	// echo $this->request->action();
    	return view();
    }
}
