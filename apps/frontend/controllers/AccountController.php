<?php
namespace Mysomwhow\Frontend\Controllers;

use Phalcon\Mvc\Controller;

class AccountController extends Controller
{

    public function indexAction()
    {
    	
    }

    public function logoutAction()
    {
        $this->session->remove("userName");
        return $this->response->redirect('');
    }
}

