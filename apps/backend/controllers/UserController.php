<?php

namespace Mysomwhow\Backend\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Models;

class UserController extends Controller
{
    public function indexAction()
    {
    	echo "string"; die();
        //$user = Users::findById('5b65055fcb9ca910700008f5');
        //echo $user->name;
    }
}
