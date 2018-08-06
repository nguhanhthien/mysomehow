<?php
namespace Mysomwhow\Backend\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Http\Request;
use Phalcon\Http\Response\Cookies;

class BaseController extends Controller
{

	protected $admin;

    public function initialize()
    {
    	$this->admin = $this->session->get('admin');

    	if(!$this->admin){
    		//header('Location:'.$this->url->get('backend/login'));
    		$this->response->redirect('backend/login');
    	}

    	/*if ($this->admin && $this->router->getControllerName() == 'login') {
    		echo "stringd";die();
    		$this->response->redirect('backend');
    	}*/
    }

}