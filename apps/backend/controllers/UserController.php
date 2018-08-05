<?php

namespace Mysomwhow\Backend\Controllers;

use Phalcon\Mvc\Controller;
use Models\Users;

class UserController extends Controller
{
    public function indexAction()
    {
    	//$user = new Users();
    	$user = Users::find();
    	echo 'There are ', count($user), "\n";
    	
		die();
    }
}
