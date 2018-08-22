<?php
namespace Mysomwhow\Frontend\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use ShoppingCart;
use Models\Location;

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

		$provinces = Location::find([
			['type' => 'prov'],
			'sort' => ['noname' => 1],
		]);

		$this->view->setVar('provinces', $provinces);
		$this->view->setVar('cart', $this->cart);
	}

	public function districtAction($path = null)
	{
		$districts = Location::find([
			[
				'type' => 'dist',
				'path' => '/'.$path.'/',
			],
		]);
		foreach ($districts as $district) {
			echo '<option data-code="'.$district->_id.'" value="'.$district->ref_id.'" >'.$district->full.'</option>';
		}
		die();
	}
}

