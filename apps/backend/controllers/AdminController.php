<?php

namespace Mysomwhow\Backend\Controllers;

use Models\Admin;

class AdminController extends BaseController
{
    public function indexAction()
    {
    	$admins = Admin::find();
    	$this->view->setVar('admins',$admins);
    }

    public function updateAction()
    {
    	
    }

    public function logoutAction()
    {
    	if ($this->session->has('admin')) {
    		$this->session->remove('admin');
    		$this->response->redirect('backend/login');
    	}
    }
}