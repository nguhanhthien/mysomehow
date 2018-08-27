<?php

namespace Mysomwhow\Backend\Controllers;

use Models\Size;

class BlogsController extends BaseController
{
    public function indexAction()
    {

    }

    public function sizeAction()
    {
        $sizes = Size::find();
        $this->view->setVar('sizes', $sizes);
    }

    public function addSizeAction()
    {
        if ($this->request->isPost()) {
            $size = new Size();
            $params = $this->request->getPost();

            $size->_id = \Helper::getSlug(trim($params['title']));
            $size->title = $params['title'];
            
            if ($this->request->hasFiles()) {
                foreach ($this->request->getUploadedFiles() as $file) {
                    //save file
                    if ($file->getKey() == 'images') {
                        $file->moveTo('img/article/' . $file->getName());
                        $size->images = $file->getName();
                    }elseif ($file->getKey() == 'images_details') {
                        $file->moveTo('img/article/details/' . $file->getName());
                        $size->images_details = $file->getName();
                    }
                }
            }
            $product->create_at = time();
            $product->updated_at = time();

            $size->save();
            $this->flashSession->success('Thêm mới thành công.');
            $this->response->redirect('backend/blogs/size');
        }
    }
}