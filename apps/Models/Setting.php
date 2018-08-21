<?php 
namespace Models;

use Phalcon\Mvc\Collection;

class Setting extends Collection
{
	public $_id;
	public $title;
	public $description;
	public $web_icon;
	public $web_logo;
	public $info;
	public $social;
	public $created_at;
	public $updated_at;


    public function initialize()
    {
    	
    }

}