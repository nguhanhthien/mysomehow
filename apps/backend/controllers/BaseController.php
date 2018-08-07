<?php
namespace Mysomwhow\Backend\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Http\Request;
use Phalcon\Http\Response\Cookies;
use \Nhadat\Models\Admin;

class BaseController extends Controller
{

	protected $admin;

    public function initialize()
    {
    	$this->admin = $this->session->get('admin');

    	if(!$this->admin){
    		header('Location:'.$this->url->get('backend/login'));
    	}
    }

}