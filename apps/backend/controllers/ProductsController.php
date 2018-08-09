<?php

namespace Mysomwhow\Backend\Controllers;

use Models\Products;
use Models\Categories;
use Helper\ProductsValidation;

class ProductsController extends BaseController
{
    public function initialize()
    {
        // lay thong tin san pham
        $products = Products::find();
        $this->view->setVar('products', $products);

        // lay thong tin danh muc
        $categories = Categories::find();
        $this->view->setVar('categories', $categories);
    }

    public function indexAction()
    {

    }

    public function addAction()
    {
        if ($this->request->isPost()) {
            $validation = new ProductsValidation;

            $messages = $validation->validate($_POST);

            // check validate
            if (count($messages)) {
                foreach ($messages as $message) {
                    $errors[$message->getField()] = $message->getMessage();
                } 
                $this->view->setVar('errors', $errors);
            }else{
                $product = new Products;

                // submit data from form
                $params = $this->request->getPost();

                // kiem tra gia khuyen mai
                if ($params['promo_price'] != 0) {
                    $params['promo_price'] = $params['sale_price'] * (100 - $params['promo_price'])/100;
                }
                
                // Check file upload
                if ($this->request->hasFiles()) {

                    foreach ($this->request->getUploadedFiles() as $file) {
                        // Luu file
                        $file->moveTo('img/test/' . $file->getName());
                        $product->images = $file->getName();
                    }
                }

                // import data to $product
                $product->_id = \Helper::getSlug(trim($params['title']));
                $product->title = $params['title'];
                $product->category = $params['category'];
                $product->price = array(
                    'in_price' => (int) $params['in_price'],
                    'sale_price' => (int) $params['sale_price'],
                    'promo_price' => (int) $params['promo_price'],
                );
                $product->total = $params['total'];
                $product->desc = $params['desc'];
                $product->created_at = time();
                $product->updated_at = time();

                $product->save();
                $this->flashSession->success('Thêm mới dữ liệu sản phẩm thành công.');
                $this->response->redirect('backend/products');
            }
        }
    }

    public function updateAction()
    {
    	
    }

    public function deleteAction($id = null)
    {
        if ($id) {
            $product = Products::findFirst([
                ['_id' => $id]
            ]);
            if ($product) {
                $product->delete();
                $this->flashSession->success('Xóa dữ liệu sản phẩm thành công.');
                $this->response->redirect('backend/products');
            }else{
                $this->flashSession->warning('Không tìm thấy sản phẩm này.');
                $this->response->redirect('backend/products');
            }
        }
    }
}