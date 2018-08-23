<?php
namespace Mysomwhow\Frontend\Controllers;

use Phalcon\Mvc\Controller;
use Models\Products;

class IndexController extends Controller
{

    public function indexAction()
    {
    	$products = Products::find();
    	$this->view->setVar('products', $products);
    }

    public function notfoundAction()
    {
    	
    }

}

