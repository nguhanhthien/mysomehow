<?php
namespace Mysomwhow\Frontend\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use ShoppingCart;

class CheckoutController extends Controller
{
	public function initialize()
	{
		$this->cart = new ShoppingCart();
	}

    public function indexAction()
    {
		$this->view->disableLevel(
			View::LEVEL_MAIN_LAYOUT
		);

		$this->view->setVar('cart', $this->cart);
	}
}

