<?php

namespace Mysomwhow\Backend\Controllers;

use Models\Orders;
use Helper\Pagination;

class OrdersController extends BaseController
{
    public function indexAction()
    {
        $orders = Orders::find();
        $this->view->setVar('orders', $orders);
    }

    public function detailsAction($id = null)
    {
    	if ($id) {
    		$orders = Orders::findById($id);
    		if ($orders) {
    			$this->view->setVar('orders', $orders);
                if ($this->request->isPost()) {
                    $progress = $this->request->getPost('progress');
                    switch ($progress) {
                        case 'confirm':
                            $orders->status = 'Đã xác nhận';
                            $orders->save();
                            break;
                        case 'deliver':
                            $orders->status = 'Đang giao';
                            $orders->save();
                            break;
                        case 'completed':
                            $orders->status = 'Hoàn thành';
                            $orders->save();
                            break;
                        default:
                            break;
                    }
                }
    		}
    	}
    }

    public function destroyAction($id = null)
    {
        if ($id) {
            $orders = Orders::findById($id);
            if ($orders) {
                $orders->status = 'Đã hủy';
                $orders->save();
                $this->response->redirect('backend/orders');
            }
        }
    }
}