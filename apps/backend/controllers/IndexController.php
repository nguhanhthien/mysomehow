<?php

namespace Mysomwhow\Backend\Controllers;

use Phalcon\Mvc\Controller;

class IndexController extends BaseController
{
    public function indexAction()
    {
        //return $this->response->forward('login');
    }

    public function notfoundAction()
    {
    	echo "404";die();
    }
}
