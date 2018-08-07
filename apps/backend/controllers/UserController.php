<?php
namespace Mysomwhow\Backend\Controllers;

use Phalcon\Mvc\Controller;
use Models\Users;

class UserController extends BaseController
{   
    public function initialize()
    {
        parent::initialize();
    }

    public function indexAction()
    {
        echo "user";
    }
    
    public function testAction()
    {
        echo "test";die();
    }
}
