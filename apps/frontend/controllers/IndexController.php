<?php
namespace Mysomwhow\Frontend\Controllers;

use Models\Products;
use Helper\Pagination;

class IndexController extends BaseController
{
    public function indexAction()
    {
    	// new product
    	$new_products = Products::find([
    		'sort' => [
                'updated_at' => -1,
            ],
    		'limit' => 10,
    	]);
    	$this->view->setVar('new_products', $new_products);

		// sold product
    	$sold_products = Products::find([
    		'sort' => ['sold' => -1],
    		'limit' => 10,
    	]);
    	$this->view->setVar('sold_products', $sold_products);

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

        $products = Products::find([
            'sort' => $input,
            'limit' => $limit,
            'skip' => ($currentPage - 1) * $limit,
        ]);
        $this->view->setVar('products', $products);
        $this->view->setVar('pages', $pagination);
        $this->view->setVar('sort_by', $sort_by);
    }

    public function searchAction($key = null)
    {
        $products = Products::find([
            ['title' => ['$regex' => 'Á']],
        ]);
        echo "<pre>";
        var_dump($products);
        die();
    }

    public function notfoundAction()
    {
    	
    }
}

