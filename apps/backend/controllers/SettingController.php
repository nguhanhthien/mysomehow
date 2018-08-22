<?php

namespace Mysomwhow\Backend\Controllers;

use Models\Setting;

class SettingController extends BaseController
{
    public function indexAction()
    {
        $setting = Setting::findFirst();
        $this->view->setVar('setting', $setting);

        if ($this->request->isPost()) {
            $params = $this->request->getPost();

            $setting->title = $params['title'];
            $setting->description = $params['description'];

            //logo and icon
            if ($this->request->hasFiles()) {
                foreach ($this->request->getUploadedFiles() as $file) {
                    // Luu file
                    if ($file->getKey() == 'web_icon') {
                        if ($file->getName() == '') {
                            $setting->web_icon = $setting->web_icon;
                        }else{
                            $file->moveTo('img/14/' . $file->getName());
                            $setting->web_icon = $file->getName();
                        }
                    }elseif ($file->getKey() == 'web_logo') {
                         if ($file->getName() == '') {
                            $setting->web_logo = $setting->web_logo;
                        }else{
                            $file->moveTo('img/14/' . $file->getName());
                            $setting->web_logo = $file->getName();
                        }
                    }
                }
            }

            // address and phone
            $setting->info = array();
            $len = count($params['address']);
            for ($i=0; $i < $len; $i++) { 
                array_push($setting->info, array(
                    'address' => $params['address'][$i],
                    'phone' => $params['phone'][$i],
                ));
            }
            // fb and instagram
            $setting->social = array(
                'facebook' => $params['facebook'],
                'instagram' => $params['instagram'],
            );

            $setting->created_at = time();
            $setting->updated_at = time();

            $setting->save();
            $this->flashSession->success('Cập nhật thành công.');
            $this->response->redirect('backend/setting');
        }
    }

}