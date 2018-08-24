<?php
namespace Mysomwhow\Frontend\Controllers;

use Models\Products;
use Helper\Pagination;
use ShoppingCart;

class ProductsController extends BaseController
{

    public function indexAction()
    {
        //pagination product
        $totalItems = Products::count();

        // Get current page
        if ($this->request->get('page')) {
            $currentPage = $this->request->get('page');
        }else{
            $currentPage = 1;
        }

        $limit = 8;
        $pagination = Pagination::add($currentPage, $totalItems, $limit);

        // Get sort_by from url
        if ($this->request->get('sort_by')) {
            $sort_by = $this->request->get('sort_by');
        }else{
            $sort_by = null;
        }

        // check sort by
        switch ($sort_by) {
            case 'null':
                $input = null;
                break;
            case 'created-descending':
                $input = ['created_at' => -1];
                break;
            case 'best-selling':
                $input = ['sold' => -1];
                break;
            case 'price-ascending':
                $input = ['price' => 1];
                break;
            case 'price-descending':
                $input = ['price' => -1];
                break;
            case 'title-ascending':
                $input = ['_id' => 1];
                break;
            case 'title-descending':
                $input = ['_id' => -1];
                break;
            default:
                $input = null;
                break;
        }

        // find products for input
        $products = Products::find([
            'sort' => $input,
            'limit' => $limit,
            'skip' => ($currentPage - 1) * $limit,
        ]);
        $this->view->setVar('products', $products);
        $this->view->setVar('pages', $pagination);
        $this->view->setVar('sort_by', $sort_by);
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
                            $this->response->redirect('gio-hang');
                        }
                    }elseif (isset($_POST['buy'])) {
                        $this->response->redirect('gio-hang');
                    }
                }
            }else{
                echo "Không tìm thấy sản phẩm này";
                die();
            }
        }
    }
}

