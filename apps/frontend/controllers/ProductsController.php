<?php
namespace Mysomwhow\Frontend\Controllers;

use Phalcon\Mvc\Controller;
use Models\Products;
use ShoppingCart;

class ProductsController extends Controller
{

    public function indexAction()
    {
        
    }

    public function newAction()
    {
        # code...
    }

    public function sellerAction()
    {
        # code...
    }

    public function showAction($id = null)
    {
        if ($id) {
            $product = Products::findFirst([
                ['_id' => $id],
            ]);
            // if find success
            if ($product) {
                $this->view->setVar('product', $product);
                if ($this->request->isPost()) {
                    if (isset($_POST['add'])) {
                        // create cart
                        $this->cart = new ShoppingCart();

                        $params = $this->request->getPost();

                        $product_cart = array(
                            'id' => $product->_id,
                            'name' => $product->title,
                            'price' => $product->price['promo_price'],
                            'qty' => $params['quantity'],
                            'color' => $params['color'],
                            'size' => $params['size'],
                            'img' => $product->images[0]['link'],
                        );

                        // add cart
                        if ($this->cart->add($product_cart) != false) {

                            $this->flashSession->success("Thêm sản phẩm vào giỏ hàng thành công!");
                            $this->response->redirect('cart');
                        }
                    }elseif (isset($_POST['buy'])) {
                        $this->response->redirect('cart');
                    }
                }
            }else{
                echo "Không tìm thấy sản phẩm này";
                die();
            }
        }
    }
}

