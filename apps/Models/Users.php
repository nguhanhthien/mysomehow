<?php 
namespace Models;

use Phalcon\Mvc\Collection;

class Users extends Collection
{
	public $_id;
	public $display_name;
	public $name;
	public $phone;
	public $email;
	public $address;
	public $password;
	public $source;
	public $created_at;
	public $updated_at;


    public function initialize()
    {
    	
    }

    public function getSource()
    {
        return 'users';
    }

}