<?php 
namespace Models;

use Phalcon\Mvc\Collection;

class Order extends Collection
{
	public $_id;
	public $customer_name;
	public $customer_email;
	public $customer_phone;
	public $customer_address;
	public $product;
	public $product_price;
	public $total_shipping;
	public $total_price;
	public $created_at;
	public $updated_at;


    public function initialize()
    {
    	
    }

}