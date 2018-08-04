<?php

namespace Mysomwhow\Backend\Controllers;

use Phalcon\Mvc\Controller;
use Models\Users;

class UserController extends Controller
{
    public function indexAction()
    {
    	$user = new Users();
    	$user = Users::findById('5b65055fcb9ca910700008f5');
    	echo $user->name;
		die();
    }
}
