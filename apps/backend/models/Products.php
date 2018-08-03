<?php

namespace Mysomwhow\Backend\Models;

use Phalcon\Mvc\Model;

class Products extends Model
{
	public static $name;

	public function findFirst()
	{
		$name = 'vinh';
		echo "findFist is true";
	}
}
