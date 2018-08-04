<?php

namespace Mysomwhow\Backend\Controllers;

use Phalcon\Mvc\Controller;
use Models\Users;

class UserController extends Controller
{
    public function indexAction()
    {
    	$user = new Users();
    	$robots = Users::find();
		echo 'There are ', count($robots), "\n";
        //$user = Users::findById('5b65055fcb9ca910700008f5');
        //echo $user->name;
		/*$user->display_name = "Anh";
		$user->name = "MinhAnh";
		$user->phone = "123456654";
		$user->email = '';
		$user->address = '';
		$user->password = '';
		$user->source = '';
		$user->created_at = '';
		$user->updated_at = '';

		if ($user->save() == false) {
			echo "Failed to insert into database";
			foreach ($user->getMessage as $message) {
				echo $message.'\n';
			}
		}else{
			echo "It worked!";
		}*/
		die();
    }
}
