<?php

namespace Mysomwhow\Backend\Controllers;

use Phalcon\Mvc\Controller;
use Models\Users;

class UserController extends Controller
{
    public function indexAction()
    {
    	$users = Users::find([
    		[
                //'name' => 'vinhxp03@gmail.com',
    			'password' => 'admin12',
    		],
    		// 'sort' => ['created_at' > -1]
    	]);

    	//echo "<br/>".$users->name;
    	foreach ($users as $key => $value) {
    	   echo "<br/>".$value->name;
    	}
    	die();
    }
}
