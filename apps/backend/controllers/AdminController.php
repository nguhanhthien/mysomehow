<?php

namespace Mysomwhow\Backend\Controllers;

use Models\Admin;

class AdminController extends BaseController
{
    public function indexAction()
    {
    	$admins = Admin::find();
    	$this->view->setVar('admins',$admins);
    }

    public function addAction()
    {
        
    }

    public function updateAction($id = null)
    {
    	if ($id) {
            $admins = Admin::findByID($id);
            if ($admins) {
                $this->view->setVar('admins',$admins);
                if ($this->request->isPost()) {
                    $params = $this->request->getPost();
                    $admins->display_name = $params['display_name'];
                    $admins->phone = $params['phone'];
                    $admins->email = $params['email'];
                    $admins->address = $params['address'];
                    $admins->password = $this->security->hash($params['new_password']);
                    $admins->updated_at = time();

                    $admins->save();
                    $this->flashSession->success('Cập nhật dữ liệu admin thành công.');
                    $this->response->redirect('backend/admin');
                }
            }else{
                $this->flashSession->warning('Không tìm thấy admin này.');
                $this->response->redirect('backend/admin');
            }
        }
    }

    public function logoutAction()
    {
    	if ($this->session->has('admin')) {
    		$this->session->remove('admin');
    		$this->response->redirect('backend/login');
    	}
    }
}