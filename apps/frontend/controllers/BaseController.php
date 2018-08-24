<?php
namespace Mysomwhow\Frontend\Controllers;

use Phalcon\Mvc\Controller;
use Models\Categories;

class BaseController extends Controller
{

    public function initialize()
    {
    	$categories = Categories::find();
        $this->view->setVar('categories', $categories);
    }

}

