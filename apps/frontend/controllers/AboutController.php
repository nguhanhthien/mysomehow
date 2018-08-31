<?php
namespace Mysomwhow\Frontend\Controllers;

use Models\Blogs;

class AboutController extends BaseController
{

    public function indexAction()
    {
    	$about = Blogs::findFirst([
            ['_id' => 'gioi-thieu']
        ]);
        
        $this->view->setVar('about', $about);
    }

}

