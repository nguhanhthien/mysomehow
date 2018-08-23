<?php
namespace Mysomwhow\Frontend\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use ShoppingCart;
use Models\Location;
use Models\Order;
use Helper\CheckoutValidation;

class CheckoutController extends Controller
{
	public function initialize()
	{
		$this->cart = new ShoppingCart();
	}

    public function indexAction()
    {
    	// check have cart
    	if (!$this->cart->getContent()) {
    		$this->response->redirect('');
    	}

		$this->view->disableLevel(
			View::LEVEL_MAIN_LAYOUT
		);

		$provinces = Location::find([
			['type' => 'prov'],
			'sort' => ['noname' => 1],
		]);

		if ($this->request->isPost()) {
			// validation form
			$params 	= $this->request->getPost();
			$validation = new CheckoutValidation();
			$messages 	= $validation->validate($params);

			// check validate
			if (count($messages)) {
				foreach ($messages as $message) {
					$errors[$message->getField()] = $message->getMessage();
				}
				$this->view->setVar('params', $params);
				$this->view->setVar('errors', $errors);
			}else{
				// no error
				$order = new Order();

				$order->customer_name = $params['billing_name'];
				$order->customer_email = $params['billing_email'];
				$order->customer_phone = $params['billing_phone'];
				$order->customer_address = $params['billing_address'];

				$order->product = array();

				foreach ($this->cart->getContent() as $cart) {
					array_push($order->product, array(
						'id' => $cart['id'],
						'name' => $cart['name'],
						'price' => (int) $cart['price'],
						'quantity' => (int) $cart['qty'],
						'size' => $cart['size'],
						'total_price' => (int) $cart['total'],
					));
				}

				$order->total_price = $this->cart->getTotal();
				$order->created_at = time();
				$order->updated_at = time();

				// delete cart
				$this->cart->destroy();

				$order->save();
				$this->response->redirect('checkout/success');
			}
		}

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

	public function successAction($code = null)
	{
		// check have cart
    	/*if (!$this->cart->getContent()) {
    		$this->response->redirect('');
    	}*/
    	
    	$this->view->disableLevel(View::LEVEL_MAIN_LAYOUT);
	}
}

