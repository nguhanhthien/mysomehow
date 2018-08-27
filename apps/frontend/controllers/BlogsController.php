<?php
namespace Mysomwhow\Frontend\Controllers;

use Models\Size;

class BlogsController extends BaseController
{

    public function indexAction()
    {

    }

    public function sizeAction($id = null)
    {
        if ($id) {
            $size = Size::findFirst([
                ['_id' => $id], 
            ]);
            if ($size) {
                $this->view->setVar('size', $size);
            }
        }else{
            $sizes = Size::find();
            $this->view->setVar('sizes', $sizes);
        }
    }

}

